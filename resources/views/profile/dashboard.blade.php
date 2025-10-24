@extends('layouts.app')

@section('title', 'Dashboard - PetScanner')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-600">Bem-vindo de volta, {{ $user->name }}!</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-heart text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Total de Pets</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalPets }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-eye text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Pets Ativos</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $activePets }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Este Mês</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $thisMonthPets }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-chart-line text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Visualizações</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalPets * 15 }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Pets -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800">Seus Pets Recentes</h2>
                    <a href="{{ route('pets.my-pets') }}" class="text-purple-600 hover:text-purple-700 text-sm font-medium">
                        Ver todos →
                    </a>
                </div>
                
                @if($pets->count() > 0)
                    <div class="divide-y divide-gray-200">
                        @foreach($pets as $pet)
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        @if($pet->photos->count() > 0)
                                            <img src="{{ url('storage/' . $pet->photos->first()->path) }}" alt="{{ $pet->name }}" 
                                                 class="w-12 h-12 object-cover rounded-lg">
                                        @else
                                            <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-pink-400 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-paw text-white"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center space-x-2">
                                            <h3 class="font-semibold text-gray-800">{{ $pet->name }}</h3>
                                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs">
                                                {{ ucfirst($pet->species) }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600">{{ $pet->city }}, {{ $pet->state }}</p>
                                    </div>
                                    
                                    <div class="flex space-x-2">
                                        <a href="{{ route('pets.show', $pet) }}" 
                                           class="text-blue-600 hover:text-blue-700">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('pets.edit', $pet) }}" 
                                           class="text-yellow-600 hover:text-yellow-700">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-8 text-center">
                        <i class="fas fa-heart text-gray-300 text-4xl mb-4"></i>
                        <p class="text-gray-500">Você ainda não cadastrou nenhum pet</p>
                        <a href="{{ route('pets.create') }}" 
                           class="mt-4 inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                            <i class="fas fa-plus mr-2"></i>Cadastrar Pet
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions & Profile -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Ações Rápidas</h3>
                <div class="space-y-3">
                    <a href="{{ route('pets.create') }}" 
                       class="w-full flex items-center px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                        <i class="fas fa-plus mr-3"></i>Cadastrar Pet
                    </a>
                    <a href="{{ route('pets.my-pets') }}" 
                       class="w-full flex items-center px-4 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="fas fa-list mr-3"></i>Gerenciar Pets
                    </a>
                    <a href="{{ route('profile.edit') }}" 
                       class="w-full flex items-center px-4 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="fas fa-user-edit mr-3"></i>Editar Perfil
                    </a>
                </div>
            </div>

            <!-- Profile Summary -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Seu Perfil</h3>
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full flex items-center justify-center">
                        <span class="text-white text-xl font-bold">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">{{ $user->name }}</h4>
                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                        <p class="text-xs text-gray-500">Membro desde {{ $user->created_at->format('M Y') }}</p>
                    </div>
                </div>
                <a href="{{ route('profile.show') }}" 
                   class="w-full flex items-center justify-center px-4 py-2 border border-purple-600 text-purple-600 rounded-lg hover:bg-purple-50 transition-colors">
                    Ver Perfil Completo
                </a>
            </div>

            <!-- Tips -->
            <div class="bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg p-6 text-white">
                <h3 class="text-lg font-semibold mb-2">💡 Dica</h3>
                <p class="text-sm text-purple-100">
                    Pets com fotos têm 3x mais chances de serem adotados! Adicione fotos de qualidade aos seus anúncios.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection