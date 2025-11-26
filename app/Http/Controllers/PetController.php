<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\PetPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        // Detectar localização por IP se não houver filtro
        $userCity = null;
        $userState = null;
        $userRegion = null;

        if (!$request->filled('city')) {
            try {
                $ip = $request->ip() === '127.0.0.1' ? '' : $request->ip();
                $response = file_get_contents("http://ip-api.com/json/{$ip}?fields=city,regionName,region");
                $data = json_decode($response, true);
                if ($data && isset($data['city'])) {
                    $userCity = $data['city'];
                    $userState = $data['regionName'] ?? null;
                    $userRegion = $data['region'] ?? null;
                }
            } catch (\Exception $e) {
                // Ignorar erro de geolocalização
            }
        }

        $query = Pet::active()->with(['user', 'photos'])->whereHas('user', function($q) {
            $q->where('email', '!=', 'admin@petscanner.com');
        });

        // Priorizar pets da cidade do usuário
        if ($userCity && !$request->filled('city')) {
            $query->orderByRaw("CASE WHEN city LIKE '%{$userCity}%' THEN 0 ELSE 1 END");
        }

        if ($request->filled('city')) {
            $query->byCity($request->city);
        }

        if ($request->filled('species')) {
            $query->bySpecies($request->species);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('breed', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $pets = $query->latest()->paginate(12);
        $species = Pet::distinct()->pluck('species');
        $cities = Pet::distinct()->pluck('city');

        return view('pets.index', compact('pets', 'species', 'cities', 'userCity', 'userState', 'userRegion'));
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'photos' => 'nullable|array|max:5',
            'photos.*' => 'file|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
            'phone_accepts_calls' => 'boolean',
            'phone_accepts_whatsapp' => 'boolean',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['phone_accepts_calls'] = $request->has('phone_accepts_calls');
        $validated['phone_accepts_whatsapp'] = $request->has('phone_accepts_whatsapp');
        unset($validated['photos']);

        $pet = Pet::create($validated);

        // Handle photo uploads
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                if ($photo->isValid()) {
                    $path = $photo->store('pets', 'public');

                    // Copy to public directory for Windows compatibility
                    $sourcePath = storage_path('app/public/' . $path);
                    $publicPath = public_path('storage/' . $path);
                    if (!file_exists(dirname($publicPath))) {
                        mkdir(dirname($publicPath), 0755, true);
                    }
                    copy($sourcePath, $publicPath);

                    PetPhoto::create([
                        'pet_id' => $pet->id,
                        'path' => $path,
                        'order' => $index + 1
                    ]);
                }
            }
        }

        return redirect()->route('pets.show', $pet)->with('success', 'Pet cadastrado com sucesso!');
    }

    public function show(Pet $pet)
    {
        $pet->load('photos');
        return view('pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        $this->authorize('update', $pet);
        $pet->load('photos');
        return view('pets.edit', compact('pet'));
    }

    public function update(Request $request, Pet $pet)
    {
        $this->authorize('update', $pet);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'photos' => 'nullable|array|max:5',
            'photos.*' => 'file|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
            'phone_accepts_calls' => 'boolean',
            'phone_accepts_whatsapp' => 'boolean',
        ]);

        // Handle new photo uploads
        if ($request->hasFile('photos')) {
            $currentPhotoCount = $pet->photos()->count();
            foreach ($request->file('photos') as $index => $photo) {
                if ($photo->isValid()) {
                    $path = $photo->store('pets', 'public');

                    // Copy to public directory for Windows compatibility
                    $sourcePath = storage_path('app/public/' . $path);
                    $publicPath = public_path('storage/' . $path);
                    if (!file_exists(dirname($publicPath))) {
                        mkdir(dirname($publicPath), 0755, true);
                    }
                    copy($sourcePath, $publicPath);

                    PetPhoto::create([
                        'pet_id' => $pet->id,
                        'path' => $path,
                        'order' => $currentPhotoCount + $index + 1
                    ]);
                }
            }
        }

        $validated['phone_accepts_calls'] = $request->has('phone_accepts_calls');
        $validated['phone_accepts_whatsapp'] = $request->has('phone_accepts_whatsapp');
        unset($validated['photos']);

        $pet->update($validated);

        return redirect()->route('pets.show', $pet)->with('success', 'Pet atualizado com sucesso!');
    }

    public function destroy(Pet $pet)
    {
        $this->authorize('delete', $pet);

        foreach ($pet->photos as $photo) {
            Storage::disk('public')->delete($photo->path);
            $photo->delete();
        }

        $pet->delete();

        return redirect()->route('pets.index')->with('success', 'Pet removido com sucesso!');
    }

    public function myPets()
    {
        $pets = Auth::user()->pets()->with('photos')->latest()->paginate(10);
        return view('pets.my-pets', compact('pets'));
    }
}
