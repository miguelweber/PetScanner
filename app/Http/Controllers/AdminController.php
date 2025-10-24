<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->is_admin) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $totalPets = Pet::count();
        $totalUsers = User::count();
        $activePets = Pet::where('is_active', true)->count();
        $pendingPets = Pet::where('is_active', false)->count();

        return view('admin.dashboard', compact('totalPets', 'totalUsers', 'activePets', 'pendingPets'));
    }

    public function pets()
    {
        $pets = Pet::with(['user', 'photos'])->latest()->paginate(20);
        return view('admin.pets', compact('pets'));
    }

    public function togglePet(Pet $pet)
    {
        $pet->update(['is_active' => !$pet->is_active]);
        return back()->with('success', 'Status do pet atualizado!');
    }

    public function deletePet(Pet $pet)
    {
        foreach ($pet->photos as $photo) {
            \Storage::disk('public')->delete($photo->path);
            $photo->delete();
        }
        $pet->delete();
        return back()->with('success', 'Pet removido!');
    }
}