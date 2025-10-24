@extends('layouts.app')

@section('title', 'Meus Pets - PetScanner')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Meus Pets</h1>
            <p class="text-gray-600">Gerencie seus anúncios de adoção</p>
        </div>
        
        <a href="{{ route('pets.create') }}" 
           class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-colors font-semibold inline-flex items-center">
            <i class="fas fa-plus mr-2"></i>Novo Anúncio
        </a>
    </div>

    @if($pets->count() > 0)
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-heart text-purple-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Total de Pets</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $pets->total() }}</p>
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
                        <p class="text-2xl font-bold text-gray-800">{{ $pets->where('is_active', true)->count() }}</p>
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
                        <p class="text-2xl font-bold text-gray-800">{{ $pets->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pets List -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Seus Anúncios</h2>
            </div>
            
            <div class="divide-y divide-gray-200">
                @foreach($pets as $pet)
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center space-x-4">
                            <!-- Pet Image -->
                            <div class="flex-shrink-0">
                                @if($pet->photos->count() > 0)
                                    <img src="{{ url('storage/' . $pet->photos->first()->path) }}" alt="{{ $pet->name }}" 
                                         class="w-16 h-16 object-cover rounded-lg">
                                @else
                                    <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-pink-400 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-paw text-white text-lg"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Pet Info -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center space-x-2 mb-1">
                                    <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $pet->name }}</h3>
                                    <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs font-medium">
                                        {{ ucfirst($pet->species) }}
                                    </span>
                                    @if($pet->is_active)
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                                            <i class="fas fa-eye mr-1"></i>Ativo
                                        </span>
                                    @else
                                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs font-medium">
                                            <i class="fas fa-eye-slash mr-1"></i>Inativo
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="flex items-center space-x-4 text-sm text-gray-600">
                                    @if($pet->breed)
                                        <span><i class="fas fa-tag mr-1"></i>{{ $pet->breed }}</span>
                                    @endif
                                    <span><i class="fas fa-map-marker-alt mr-1"></i>{{ $pet->city }}, {{ $pet->state }}</span>
                                    <span><i class="fas fa-calendar mr-1"></i>{{ $pet->created_at->format('d/m/Y') }}</span>
                                </div>
                                
                                <div class="flex items-center space-x-2 mt-2 text-sm text-gray-500">
                                    @if($pet->phone_accepts_calls)
                                        <span class="flex items-center">
                                            <i class="fas fa-phone text-green-500 mr-1"></i>Ligações
                                        </span>
                                    @endif
                                    @if($pet->phone_accepts_whatsapp)
                                        <span class="flex items-center">
                                            <i class="fab fa-whatsapp text-green-500 mr-1"></i>WhatsApp
                                        </span>
                                    @endif
                                    <span>{{ $pet->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('pets.show', $pet) }}" 
                                   class="bg-blue-100 text-blue-700 p-2 rounded-lg hover:bg-blue-200 transition-colors"
                                   title="Ver detalhes">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <a href="{{ route('pets.edit', $pet) }}" 
                                   class="bg-yellow-100 text-yellow-700 p-2 rounded-lg hover:bg-yellow-200 transition-colors"
                                   title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form method="POST" action="{{ route('pets.destroy', $pet) }}" class="inline" 
                                      onsubmit="return confirm('Tem certeza que deseja excluir {{ $pet->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-100 text-red-700 p-2 rounded-lg hover:bg-red-200 transition-colors"
                                            title="Excluir">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            {{ $pets->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-heart text-purple-600 text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Você ainda não cadastrou nenhum pet</h3>
            <p class="text-gray-600 mb-8">
                Comece agora mesmo e ajude um pet a encontrar um novo lar!
            </p>
            
            <a href="{{ route('pets.create') }}" 
               class="bg-purple-600 text-white px-8 py-4 rounded-lg hover:bg-purple-700 transition-colors font-semibold inline-flex items-center">
                <i class="fas fa-plus mr-3"></i>Cadastrar Primeiro Pet
            </a>
        </div>
    @endif
</div>

<!-- Quick Actions Modal -->
<div id="quick-actions-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Ações Rápidas</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="space-y-3">
                <button class="w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-eye-slash mr-3 text-gray-500"></i>
                    Desativar anúncio
                </button>
                <button class="w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-share mr-3 text-blue-500"></i>
                    Compartilhar anúncio
                </button>
                <button class="w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-chart-line mr-3 text-green-500"></i>
                    Ver estatísticas
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openModal() {
        document.getElementById('quick-actions-modal').classList.remove('hidden');
    }
    
    function closeModal() {
        document.getElementById('quick-actions-modal').classList.add('hidden');
    }
    
    // Close modal when clicking outside
    document.getElementById('quick-actions-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endpush
@endsection