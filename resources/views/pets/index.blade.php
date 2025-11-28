@extends('layouts.app')

@section('title', 'PetScanner - Encontre seu novo melhor amigo')

@section('content')
<!-- Hero Section -->
<div class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background with animated gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-primary-50 via-white to-secondary-50">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-500/10 via-transparent to-secondary-500/10"></div>
    </div>

    <!-- Floating elements -->
    <div class="absolute top-20 left-10 w-20 h-20 bg-primary-200/30 rounded-full animate-float"></div>
    <div class="absolute top-40 right-20 w-16 h-16 bg-secondary-200/30 rounded-full animate-float" style="animation-delay: 1s;"></div>
    <div class="absolute bottom-40 left-20 w-12 h-12 bg-accent-200/30 rounded-full animate-float" style="animation-delay: 2s;"></div>
    <div class="absolute bottom-20 right-10 w-24 h-24 bg-primary-200/20 rounded-full animate-float" style="animation-delay: 0.5s;"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20">
        <div class="animate-fade-in">
            <h1 class="text-6xl md:text-8xl font-bold mb-8 leading-tight">
                Encontre seu novo <br>
                <span class="text-gradient animate-pulse">melhor amigo</span>
            </h1>
            <p class="text-2xl md:text-3xl mb-12 text-gray-600 max-w-4xl mx-auto leading-relaxed">
                Conectamos pets que precisam de um lar com famílias que querem amar ❤️
            </p>

            @if(isset($userCity) && $userCity)
                <div class="inline-flex items-center bg-white/80 backdrop-blur-sm px-6 py-3 rounded-2xl shadow-lg mb-12 border border-primary-200 animate-pulse-gentle">
                    <div class="w-8 h-8 bg-gradient-to-r from-primary-500 to-accent-500 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-map-marker-alt text-white text-sm"></i>
                    </div>
                    <span class="text-lg font-medium text-gray-700">
                        Pets localizados na sua região:
                        <span class="font-bold text-primary-600">{{ $userCity }}</span>
                        @if(isset($userState) && $userState)
                            <span class="text-gray-500">, {{ $userState }}</span>
                        @endif
                    </span>
                </div>
            @endif
        </div>

        <!-- Enhanced Search Form -->
        <div class="max-w-6xl mx-auto animate-slide-up">
            <form method="GET" action="{{ route('home') }}" class="glass-effect rounded-3xl p-8 shadow-2xl border border-white/20">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" placeholder="Nome, raça ou descrição..."
                               value="{{ request('search') }}"
                               class="input pl-12 bg-white/80 backdrop-blur-sm">
                    </div>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-paw text-gray-400"></i>
                        </div>
                        <select name="species" class="input pl-12 bg-white/80 backdrop-blur-sm">
                            <option value="">Todas as espécies</option>
                            @foreach($species as $specie)
                                <option value="{{ $specie }}" {{ request('species') == $specie ? 'selected' : '' }}>
                                    {{ ucfirst($specie) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-map-marker-alt text-gray-400"></i>
                        </div>
                        <select name="city" class="input pl-12 bg-white/80 backdrop-blur-sm">
                            <option value="">Todas as cidades</option>
                            @foreach($cities as $city)
                                <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                                    {{ $city }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <button type="submit" class="btn-primary w-full h-full text-lg font-semibold">
                            <i class="fas fa-search mr-3"></i>Buscar Pets
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Quick Actions -->
        <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6 mt-12">
            @auth
                <a href="{{ route('pets.create') }}" class="btn-accent text-lg px-8 py-4">
                    <i class="fas fa-plus mr-3"></i>Anunciar Pet
                </a>
            @else
                <a href="{{ route('register') }}" class="btn-accent text-lg px-8 py-4">
                    <i class="fas fa-user-plus mr-3"></i>Criar Conta Grátis
                </a>
            @endauth
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div class="w-6 h-10 border-2 border-gray-400 rounded-full flex justify-center">
            <div class="w-1 h-3 bg-gray-400 rounded-full mt-2 animate-pulse"></div>
        </div>
    </div>
</div>

<!-- Pets Grid -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    @if($pets->count() > 0)
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-12 space-y-4 lg:space-y-0">
            <div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-2">
                    @if(request()->hasAny(['search', 'species', 'city']))
                        Resultados da busca
                    @else
                        Pets disponíveis
                    @endif
                </h2>
                <p class="text-xl text-gray-600">
                    {{ $pets->total() }} pets encontrados esperando por um lar
                </p>
            </div>

            <div class="flex items-center space-x-4">
                <span class="text-gray-600 font-medium">Ordenar por:</span>
                <select class="input w-auto min-w-[160px]" onchange="sortPets(this.value)">
                    <option value="recent">Mais recentes</option>
                    <option value="oldest">Mais antigos</option>
                    <option value="name-asc">Nome A-Z</option>
                    <option value="name-desc">Nome Z-A</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="pets-grid">
            @foreach($pets as $pet)
                <div class="card overflow-hidden group hover-lift" data-pet-name="{{ $pet->name }}" data-pet-date="{{ $pet->created_at->timestamp }}">
                    <div class="relative overflow-hidden">
                        @if($pet->photos->count() > 0)
                            <img src="/storage/{{ $pet->photos->first()->path }}" alt="{{ $pet->name }}"
                                 class="w-full h-64 object-cover group-hover:scale-110 transition-all duration-500"
                                 loading="lazy"
                                 onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjNmNGY2Ii8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzk5YTNhZiIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkltYWdlbSBuw6NvIGVuY29udHJhZGE8L3RleHQ+PC9zdmc+'">
                        @else
                            <div class="w-full h-64 bg-gradient-to-br from-primary-100 to-secondary-100 flex items-center justify-center">
                                <i class="fas fa-paw text-primary-400 text-5xl animate-pulse"></i>
                            </div>
                        @endif

                        <div class="absolute top-4 left-4">
                            <span class="glass-effect text-gray-700 px-4 py-2 rounded-2xl text-sm font-semibold border border-white/20">
                                {{ ucfirst($pet->species) }}
                            </span>
                        </div>

                        <div class="absolute top-4 right-4">
                            <button class="w-10 h-10 glass-effect rounded-full flex items-center justify-center text-gray-600 hover:text-red-500 transition-all duration-300 border border-white/20" onclick="toggleFavorite({{ $pet->id }})">
                                <i class="fas fa-heart text-sm"></i>
                            </button>
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors">{{ $pet->name }}</h3>

                        <div class="space-y-3 mb-6">
                            @if($pet->breed)
                                <div class="flex items-center text-gray-600">
                                    <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-tag text-primary-600 text-xs"></i>
                                    </div>
                                    <span class="font-medium">{{ $pet->breed }}</span>
                                </div>
                            @endif

                            <div class="flex items-center text-gray-600">
                                <div class="w-8 h-8 bg-accent-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-map-marker-alt text-accent-600 text-xs"></i>
                                </div>
                                <span class="font-medium">{{ $pet->city }}, {{ $pet->state }}</span>
                            </div>
                        </div>

                        @if($pet->description)
                            <p class="text-gray-700 mb-6 line-clamp-3 leading-relaxed">
                                {{ Str::limit($pet->description, 120) }}
                            </p>
                        @endif

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center space-x-2">
                                @if($pet->phone_accepts_calls)
                                    <div class="w-8 h-8 bg-accent-100 rounded-full flex items-center justify-center" title="Aceita ligações">
                                        <i class="fas fa-phone text-accent-600 text-xs"></i>
                                    </div>
                                @endif
                                @if($pet->phone_accepts_whatsapp)
                                    <div class="w-8 h-8 bg-accent-100 rounded-full flex items-center justify-center" title="Aceita WhatsApp">
                                        <i class="fab fa-whatsapp text-accent-600 text-xs"></i>
                                    </div>
                                @endif
                                <span class="text-sm text-gray-500 ml-2">{{ $pet->created_at->diffForHumans() }}</span>
                            </div>

                            <a href="{{ route('pets.show', $pet) }}"
                               class="btn-primary text-sm px-6 py-2">
                                <i class="fas fa-eye mr-2"></i>Ver detalhes
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Enhanced Pagination -->
        <div class="mt-16 flex justify-center">
            <div class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100">
                {{ $pets->links() }}
            </div>
        </div>
    @else
        <!-- Enhanced Empty State -->
        <div class="text-center py-20">
            <div class="w-32 h-32 bg-gradient-to-br from-primary-100 to-secondary-100 rounded-full flex items-center justify-center mx-auto mb-8">
                <i class="fas fa-search text-primary-500 text-4xl"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-800 mb-4">Nenhum pet encontrado</h3>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                @if(request()->hasAny(['search', 'species', 'city']))
                    Não encontramos pets com os filtros selecionados. Tente ajustar sua busca ou
                    <a href="{{ route('home') }}" class="text-primary-600 hover:text-primary-700 font-semibold">ver todos os pets</a>
                @else
                    Seja o primeiro a cadastrar um pet para adoção e ajude a salvar uma vida!
                @endif
            </p>

            @auth
                <a href="{{ route('pets.create') }}" class="btn-primary text-lg px-8 py-4">
                    <i class="fas fa-plus mr-3"></i>Cadastrar Pet
                </a>
            @else
                <a href="{{ route('register') }}" class="btn-accent text-lg px-8 py-4">
                    <i class="fas fa-user-plus mr-3"></i>Criar Conta Grátis
                </a>
            @endauth
        </div>
    @endif
</div>

<!-- Enhanced CTA Section -->
<div class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-primary-600 via-secondary-600 to-accent-600"></div>
    <div class="absolute inset-0 bg-black/20"></div>

    <!-- Animated background elements -->
    <div class="absolute top-10 left-10 w-32 h-32 bg-white/10 rounded-full animate-float"></div>
    <div class="absolute bottom-10 right-10 w-24 h-24 bg-white/10 rounded-full animate-float" style="animation-delay: 1s;"></div>
    <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-white/5 rounded-full animate-float" style="animation-delay: 2s;"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
        <div class="animate-fade-in">
            <h2 class="text-4xl md:text-6xl font-bold mb-8 text-white leading-tight">
                Tem um pet que precisa <br>
                <span class="text-yellow-300">de um lar?</span>
            </h2>
            <p class="text-2xl mb-12 text-white/90 max-w-3xl mx-auto leading-relaxed">
                Cadastre gratuitamente e ajude a encontrar uma família amorosa.
                É rápido, fácil e pode salvar uma vida! 🐾
            </p>
        </div>

        @auth
            <div class="space-y-6">
                <a href="{{ route('pets.create') }}"
                   class="inline-flex items-center bg-white text-primary-600 px-12 py-6 rounded-3xl hover:bg-gray-100 transition-all duration-300 font-bold text-xl shadow-2xl hover:scale-105 transform">
                    <i class="fas fa-plus mr-4 text-2xl"></i>Cadastrar Pet Agora
                </a>
                <p class="text-white/80 text-lg">100% gratuito • Sem taxas • Sem comissões</p>
            </div>
        @else
            <div class="space-y-8">
                <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center bg-white text-primary-600 px-12 py-6 rounded-3xl hover:bg-gray-100 transition-all duration-300 font-bold text-xl shadow-2xl hover:scale-105 transform">
                        <i class="fas fa-user-plus mr-4 text-2xl"></i>Criar Conta Grátis
                    </a>
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center border-3 border-white text-white px-12 py-6 rounded-3xl hover:bg-white hover:text-primary-600 transition-all duration-300 font-bold text-xl hover:scale-105 transform">
                        <i class="fas fa-sign-in-alt mr-4 text-2xl"></i>Já tenho conta
                    </a>
                </div>
                <div class="flex items-center justify-center space-x-8 text-white/80">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2 text-accent-300"></i>
                        <span>100% Gratuito</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-shield-alt mr-2 text-accent-300"></i>
                        <span>Seguro</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-heart mr-2 text-accent-300"></i>
                        <span>Fácil de usar</span>
                    </div>
                </div>
            </div>
        @endauth
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Counter animation
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

    // Trigger counter animation when stats section is visible
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                observer.unobserve(entry.target);
            }
        });
    });

    const statsSection = document.getElementById('stats');
    if (statsSection) {
        observer.observe(statsSection);
    }

    // Smooth scroll to stats
    function scrollToStats() {
        document.getElementById('stats').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }

    // Sort pets functionality
    function sortPets(sortBy) {
        const grid = document.getElementById('pets-grid');
        const pets = Array.from(grid.children);

        pets.sort((a, b) => {
            switch(sortBy) {
                case 'name-asc':
                    return a.dataset.petName.localeCompare(b.dataset.petName);
                case 'name-desc':
                    return b.dataset.petName.localeCompare(a.dataset.petName);
                case 'oldest':
                    return parseInt(a.dataset.petDate) - parseInt(b.dataset.petDate);
                case 'recent':
                default:
                    return parseInt(b.dataset.petDate) - parseInt(a.dataset.petDate);
            }
        });

        // Re-append sorted elements
        pets.forEach(pet => grid.appendChild(pet));
    }

    // Favorite functionality (placeholder)
    function toggleFavorite(petId) {
        // This would typically make an AJAX call to save/remove favorite
        console.log('Toggle favorite for pet:', petId);
        // For now, just toggle the heart color
        event.target.classList.toggle('text-red-500');
    }

    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
</script>
@endpush

