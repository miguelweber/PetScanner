@extends('layouts.app')

@section('title', 'Meu Perfil - PetScanner')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Meu Perfil</h1>
            <p class="text-gray-600">Gerencie suas informações pessoais</p>
        </div>
        <a href="{{ route('profile.edit') }}" 
           class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-colors font-semibold">
            <i class="fas fa-edit mr-2"></i>Editar Perfil
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Profile Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Info -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Informações Básicas</h2>
                
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full flex items-center justify-center">
                            <span class="text-white text-2xl font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">{{ Auth::user()->name }}</h3>
                            <p class="text-gray-600">{{ Auth::user()->email }}</p>
                            <p class="text-sm text-gray-500">Membro desde {{ Auth::user()->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Stats -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Estatísticas da Conta</h2>
                
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="text-center p-4 bg-purple-50 rounded-lg">
                        <div class="text-2xl font-bold text-purple-600">{{ Auth::user()->pets()->count() }}</div>
                        <div class="text-sm text-gray-600">Pets Cadastrados</div>
                    </div>
                    <div class="text-center p-4 bg-green-50 rounded-lg">
                        <div class="text-2xl font-bold text-green-600">{{ Auth::user()->pets()->where('is_active', true)->count() }}</div>
                        <div class="text-sm text-gray-600">Pets Ativos</div>
                    </div>
                    <div class="text-center p-4 bg-blue-50 rounded-lg">
                        <div class="text-2xl font-bold text-blue-600">{{ Auth::user()->pets()->whereMonth('created_at', now()->month)->count() }}</div>
                        <div class="text-sm text-gray-600">Este Mês</div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Atividade Recente</h2>
                
                @php
                    $recentPets = Auth::user()->pets()->latest()->take(3)->get();
                @endphp
                
                @if($recentPets->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentPets as $pet)
                            <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg">
                                @if($pet->photo)
                                    <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->name }}" 
                                         class="w-12 h-12 object-cover rounded-lg">
                                @else
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-pink-400 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-paw text-white"></i>
                                    </div>
                                @endif
                                
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800">{{ $pet->name }}</h4>
                                    <p class="text-sm text-gray-600">Cadastrado {{ $pet->created_at->diffForHumans() }}</p>
                                </div>
                                
                                <a href="{{ route('pets.show', $pet) }}" 
                                   class="text-purple-600 hover:text-purple-700">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-heart text-gray-300 text-4xl mb-4"></i>
                        <p class="text-gray-500">Nenhuma atividade recente</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Ações</h3>
                <div class="space-y-3">
                    <a href="{{ route('dashboard') }}" 
                       class="w-full flex items-center px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                        <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
                    </a>
                    <a href="{{ route('pets.create') }}" 
                       class="w-full flex items-center px-4 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="fas fa-plus mr-3"></i>Novo Pet
                    </a>
                    <a href="{{ route('pets.my-pets') }}" 
                       class="w-full flex items-center px-4 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="fas fa-list mr-3"></i>Meus Pets
                    </a>
                </div>
            </div>

            <!-- Account Security -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Segurança</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Última alteração de senha</span>
                        <span class="text-sm text-gray-800">Nunca</span>
                    </div>
                    <button onclick="document.getElementById('password-modal').classList.remove('hidden')"
                            class="w-full flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        <i class="fas fa-key mr-3"></i>Alterar Senha
                    </button>
                </div>
            </div>

            <!-- Help -->
            <div class="bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg p-6 text-white">
                <h3 class="text-lg font-semibold mb-2">Precisa de Ajuda?</h3>
                <p class="text-sm text-blue-100 mb-4">
                    Entre em contato conosco se tiver dúvidas sobre como usar a plataforma.
                </p>
                <button class="w-full bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg transition-colors">
                    <i class="fas fa-envelope mr-2"></i>Contato
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Password Change Modal -->
<div id="password-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Alterar Senha</h3>
                <button onclick="document.getElementById('password-modal').classList.add('hidden')" 
                        class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form method="POST" action="{{ route('profile.password') }}">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Senha Atual</label>
                        <input type="password" name="current_password" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nova Senha</label>
                        <input type="password" name="password" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirmar Nova Senha</label>
                        <input type="password" name="password_confirmation" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>
                
                <div class="flex space-x-3 mt-6">
                    <button type="button" 
                            onclick="document.getElementById('password-modal').classList.add('hidden')"
                            class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="flex-1 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                        Alterar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection