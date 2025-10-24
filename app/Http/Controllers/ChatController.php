<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $chats = Chat::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->with(['pet', 'sender', 'receiver'])
            ->latest()
            ->get()
            ->groupBy(function($chat) {
                return $chat->pet_id . '-' . ($chat->sender_id == Auth::id() ? $chat->receiver_id : $chat->sender_id);
            });

        return view('chat.index', compact('chats'));
    }

    public function show(Pet $pet, $userId)
    {
        $messages = Chat::where('pet_id', $pet->id)
            ->where(function($q) use ($userId) {
                $q->where(function($q) use ($userId) {
                    $q->where('sender_id', Auth::id())->where('receiver_id', $userId);
                })->orWhere(function($q) use ($userId) {
                    $q->where('sender_id', $userId)->where('receiver_id', Auth::id());
                });
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at')
            ->get();

        Chat::where('pet_id', $pet->id)
            ->where('sender_id', $userId)
            ->where('receiver_id', Auth::id())
            ->update(['is_read' => true]);

        return view('chat.show', compact('pet', 'messages', 'userId'));
    }

    public function store(Request $request, Pet $pet)
    {
        $request->validate(['message' => 'required|string|max:1000']);

        Chat::create([
            'pet_id' => $pet->id,
            'sender_id' => Auth::id(),
            'receiver_id' => $pet->user_id,
            'message' => $request->message
        ]);

        return back();
    }
}