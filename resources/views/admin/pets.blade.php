@extends('layouts.app')

@section('title', 'Gerenciar Pets - Admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800">
                        Gerenciar Pets
                    </h1>
                    <p class="text-gray-600 mt-2">Modere e gerencie todos os pets da plataforma</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" 
                   class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-xl hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i>Voltar
                </a>
            </div>
        </div>

        <!-- Pets Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($pets as $pet)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-2 hover:shadow-2xl transition-all duration-300">
                    <!-- Pet Image -->
                    <div class="relative h-48">
                        @if($pet->photos->count() > 0)
                            <img src="{{ url('storage/' . $pet->photos->first()->path) }}" alt="{{ $pet->name }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center">
                                <i class="fas fa-paw text-white text-4xl"></i>
                            </div>
                        @endif
                        
                        <!-- Status Badge -->
                        <div class="absolute top-4 left-4">
                            @if($pet->is_active)
                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                    <i class="fas fa-eye mr-1"></i>Ativo
                                </span>
                            @else
                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                    <i class="fas fa-eye-slash mr-1"></i>Inativo
                                </span>
                            @endif
                        </div>
                        
                        <!-- Species Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="bg-purple-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                {{ ucfirst($pet->species) }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Pet Info -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $pet->name }}</h3>
                                @if($pet->breed)
                                    <p class="text-gray-600 text-sm">
                                        <i class="fas fa-tag mr-1"></i>{{ $pet->breed }}
                                    </p>
                                @endif
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500">{{ $pet->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-2 mb-4">
                            <p class="text-gray-600 text-sm flex items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-purple-500"></i>
                                {{ $pet->city }}, {{ $pet->state }}
                            </p>
                            <p class="text-gray-600 text-sm flex items-center">
                                <i class="fas fa-user mr-2 text-purple-500"></i>
                                {{ $pet->user->name }}
                            </p>
                        </div>
                        
                        @if($pet->description)
                            <p class="text-gray-700 text-sm mb-4 line-clamp-2">
                                {{ Str::limit($pet->description, 80) }}
                            </p>
                        @endif
                        
                        <!-- Action Buttons -->
                        <div class="flex space-x-2">
                            <a href="{{ route('pets.show', $pet) }}" 
                               class="flex-1 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors text-center text-sm font-semibold">
                                <i class="fas fa-eye mr-1"></i>Ver
                            </a>
                            
                            <form method="POST" action="{{ route('admin.pets.toggle', $pet) }}" class="flex-1">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="w-full {{ $pet->is_active ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600' }} text-white px-4 py-2 rounded-lg transition-colors text-sm font-semibold">
                                    <i class="fas fa-{{ $pet->is_active ? 'eye-slash' : 'eye' }} mr-1"></i>
                                    {{ $pet->is_active ? 'Desativar' : 'Ativar' }}
                                </button>
                            </form>
                            
                            <form method="POST" action="{{ route('admin.pets.delete', $pet) }}" 
                                  onsubmit="return confirm('Tem certeza que deseja excluir {{ $pet->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors text-sm font-semibold">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($pets->hasPages())
            <div class="mt-12 flex justify-center">
                <div class="bg-white rounded-2xl shadow-lg p-4">
                    {{ $pets->links() }}
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection