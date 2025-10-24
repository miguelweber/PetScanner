@extends('layouts.app')

@section('title', 'Painel Admin - PetScanner')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-50 via-white to-orange-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Enhanced Header -->
        <div class="card p-12 mb-12 bg-gradient-to-r from-red-500 to-orange-500 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-32 translate-x-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full translate-y-24 -translate-x-24"></div>
            <div class="relative text-center">
                <div class="w-20 h-20 bg-white/20 rounded-3xl flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-shield-alt text-white text-3xl"></i>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold mb-6">
                    Painel de Administração
                </h1>
                <p class="text-xl text-white/90 max-w-2xl mx-auto">Gerencie a plataforma PetScanner com controle total e segurança</p>
                <div class="flex items-center justify-center mt-6 space-x-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold">{{ Auth::user()->name }}</div>
                        <div class="text-white/80">Administrador</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <div class="card p-8 bg-gradient-to-br from-primary-500 to-primary-600 text-white hover-lift relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -translate-y-12 translate-x-12"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-16 h-16 bg-white/20 rounded-3xl flex items-center justify-center">
                            <i class="fas fa-paw text-2xl"></i>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold counter" data-target="{{ $totalPets }}">0</div>
                        </div>
                    </div>
                    <div>
                        <p class="text-primary-100 font-medium">Total de Pets</p>
                        <p class="text-white/80 text-sm">Todos os pets cadastrados</p>
                    </div>
                </div>
            </div>
            
            <div class="card p-8 bg-gradient-to-br from-accent-500 to-accent-600 text-white hover-lift relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -translate-y-12 translate-x-12"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-16 h-16 bg-white/20 rounded-3xl flex items-center justify-center">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold counter" data-target="{{ $totalUsers }}">0</div>
                        </div>
                    </div>
                    <div>
                        <p class="text-accent-100 font-medium">Usuários</p>
                        <p class="text-white/80 text-sm">Usuários registrados</p>
                    </div>
                </div>
            </div>
            
            <div class="card p-8 bg-gradient-to-br from-secondary-500 to-secondary-600 text-white hover-lift relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -translate-y-12 translate-x-12"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-16 h-16 bg-white/20 rounded-3xl flex items-center justify-center">
                            <i class="fas fa-eye text-2xl"></i>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold counter" data-target="{{ $activePets }}">0</div>
                        </div>
                    </div>
                    <div>
                        <p class="text-secondary-100 font-medium">Pets Ativos</p>
                        <p class="text-white/80 text-sm">Disponíveis para adoção</p>
                    </div>
                </div>
            </div>
            
            <div class="card p-8 bg-gradient-to-br from-yellow-500 to-orange-500 text-white hover-lift relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -translate-y-12 translate-x-12"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-16 h-16 bg-white/20 rounded-3xl flex items-center justify-center">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold counter" data-target="{{ $pendingPets }}">0</div>
                        </div>
                    </div>
                    <div>
                        <p class="text-yellow-100 font-medium">Pendentes</p>
                        <p class="text-white/80 text-sm">Aguardando aprovação</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Quick Actions -->
        <div class="card p-12">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Ações Rápidas</h2>
                <p class="text-xl text-gray-600">Gerencie a plataforma com facilidade</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <a href="{{ route('admin.pets') }}" 
                   class="group card p-10 bg-gradient-to-br from-red-500 to-red-600 text-white hover-lift text-center relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16"></div>
                    <div class="relative">
                        <div class="w-20 h-20 bg-white/20 rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-paw text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">Gerenciar Pets</h3>
                        <p class="text-red-100 leading-relaxed">Moderar, aprovar e controlar todos os pets da plataforma</p>
                        <div class="mt-6 inline-flex items-center text-white/80">
                            <span class="mr-2">Acessar painel</span>
                            <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('home') }}" 
                   class="group card p-10 bg-gradient-to-br from-primary-500 to-primary-600 text-white hover-lift text-center relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16"></div>
                    <div class="relative">
                        <div class="w-20 h-20 bg-white/20 rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-home text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">Ver Site</h3>
                        <p class="text-primary-100 leading-relaxed">Visualizar a plataforma como um usuário comum</p>
                        <div class="mt-6 inline-flex items-center text-white/80">
                            <span class="mr-2">Ir para o site</span>
                            <i class="fas fa-external-link-alt group-hover:translate-x-2 transition-transform"></i>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('pets.create') }}" 
                   class="group card p-10 bg-gradient-to-br from-accent-500 to-accent-600 text-white hover-lift text-center relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16"></div>
                    <div class="relative">
                        <div class="w-20 h-20 bg-white/20 rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-plus text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">Novo Pet</h3>
                        <p class="text-accent-100 leading-relaxed">Cadastrar um novo pet para adoção na plataforma</p>
                        <div class="mt-6 inline-flex items-center text-white/80">
                            <span class="mr-2">Cadastrar agora</span>
                            <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
        <!-- Additional Admin Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
            <div class="card p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-chart-line mr-3 text-primary-600"></i>
                    Atividade Recente
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-accent-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-plus text-accent-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Novo pet cadastrado</p>
                                <p class="text-sm text-gray-500">Há 2 horas</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-primary-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Novo usuário registrado</p>
                                <p class="text-sm text-gray-500">Há 4 horas</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-secondary-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-heart text-secondary-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Pet adotado com sucesso</p>
                                <p class="text-sm text-gray-500">Há 1 dia</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-cog mr-3 text-secondary-600"></i>
                    Configurações do Sistema
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                        <div>
                            <p class="font-medium text-gray-800">Moderação automática</p>
                            <p class="text-sm text-gray-500">Aprovar pets automaticamente</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                        <div>
                            <p class="font-medium text-gray-800">Notificações por email</p>
                            <p class="text-sm text-gray-500">Receber alertas importantes</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                        <div>
                            <p class="font-medium text-gray-800">Modo manutenção</p>
                            <p class="text-sm text-gray-500">Desabilitar acesso público</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Counter animation for stats
    function animateCounters() {
        const counters = document.querySelectorAll('.counter');
        const speed = 200;
        
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const inc = target / speed;
            
            if (count < target) {
                counter.innerText = Math.ceil(count + inc);
                setTimeout(() => animateCounters(), 1);
            } else {
                counter.innerText = target;
            }
        });
    }
    
    // Start animation when page loads
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(animateCounters, 500);
    });
</script>
@endpush
@endsection