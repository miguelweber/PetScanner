@extends('layouts.app')

@section('title', 'Conversa - PetScanner')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b">
            <h2 class="text-xl font-semibold">Conversa sobre {{ $pet->name }}</h2>
        </div>
        
        <div class="h-96 overflow-y-auto p-6 space-y-4">
            @foreach($messages as $message)
                <div class="flex {{ $message->sender_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg {{ $message->sender_id == Auth::id() ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                        <p class="text-sm">{{ $message->message }}</p>
                        <p class="text-xs mt-1 opacity-75">{{ $message->created_at->format('H:i') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        
        <form method="POST" action="{{ route('chat.store', $pet) }}" class="p-6 border-t">
            @csrf
            <div class="flex space-x-4">
                <input type="text" name="message" placeholder="Digite sua mensagem..." 
                       class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500" required>
                <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700">
                    Enviar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection