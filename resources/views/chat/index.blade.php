@extends('layouts.app')

@section('title', 'Conversas - PetScanner')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Suas Conversas</h1>
        <p class="text-gray-600">Converse com interessados em adoção</p>
    </div>

    @if($chats->count() > 0)
        <div class="bg-white rounded-lg shadow-md divide-y">
            @foreach($chats as $chatGroup)
                @php $lastChat = $chatGroup->first(); @endphp
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center space-x-4">
                        @if($lastChat->pet->photos->count() > 0)
                            <img src="{{ url('storage/' . $lastChat->pet->photos->first()->path) }}" 
                                 class="w-16 h-16 object-cover rounded-lg">
                        @else
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-pink-400 rounded-lg flex items-center justify-center">
                                <i class="fas fa-paw text-white"></i>
                            </div>
                        @endif
                        
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">{{ $lastChat->pet->name }}</h3>
                            <p class="text-sm text-gray-600">
                                Conversa com {{ $lastChat->sender_id == Auth::id() ? $lastChat->receiver->name : $lastChat->sender->name }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1">{{ Str::limit($lastChat->message, 50) }}</p>
                        </div>
                        
                        <div class="text-right">
                            <p class="text-xs text-gray-500">{{ $lastChat->created_at->diffForHumans() }}</p>
                            <a href="{{ route('chat.show', [$lastChat->pet->id, $lastChat->sender_id == Auth::id() ? $lastChat->receiver_id : $lastChat->sender_id]) }}" 
                               class="mt-2 inline-block bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors text-sm">
                                Ver Conversa
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16">
            <i class="fas fa-comments text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Nenhuma conversa ainda</h3>
            <p class="text-gray-600">Suas conversas sobre pets aparecerão aqui</p>
        </div>
    @endif
</div>
@endsection