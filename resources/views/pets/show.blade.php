@extends('layouts.app')

@section('title', $pet->name . ' - PetScanner')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Enhanced Breadcrumb -->
    <nav class="flex mb-12" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="flex items-center text-gray-600 hover:text-primary-600 transition-all duration-300 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-2xl hover:bg-white border border-gray-200 hover:border-primary-200">
                    <i class="fas fa-home mr-2"></i>Início
                </a>
            </li>
            <li class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 mx-3"></i>
                <span class="text-gray-700 font-medium bg-primary-50 px-4 py-2 rounded-2xl border border-primary-200">{{ $pet->name }}</span>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
        <!-- Enhanced Pet Images -->
        <div class="space-y-6">
            @if($pet->photos->count() > 0)
                <!-- Main Image with enhanced styling -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-3xl blur-xl opacity-20 group-hover:opacity-30 transition-all duration-500"></div>
                    <img id="main-image" src="/storage/{{ $pet->photos->first()->path }}" alt="{{ $pet->name }}" 
                         class="relative w-full h-[500px] object-cover rounded-3xl shadow-2xl border-4 border-white group-hover:scale-[1.02] transition-all duration-500"
                         onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjNmNGY2Ii8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIyMCIgZmlsbD0iIzk5YTNhZiIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkltYWdlbSBuw6NvIGVuY29udHJhZGE8L3RleHQ+PC9zdmc+'">
                    
                    <div class="absolute top-6 left-6">
                        <span class="glass-effect text-gray-700 px-6 py-3 rounded-2xl text-lg font-bold border border-white/20 shadow-lg">
                            {{ ucfirst($pet->species) }}
                        </span>
                    </div>
                    
                    <div class="absolute top-6 right-6">
                        <button class="w-14 h-14 glass-effect rounded-2xl flex items-center justify-center text-gray-600 hover:text-red-500 transition-all duration-300 border border-white/20 shadow-lg hover:scale-110" onclick="toggleFavorite({{ $pet->id }})">
                            <i class="fas fa-heart text-xl"></i>
                        </button>
                    </div>
                    
                    <!-- Image counter -->
                    @if($pet->photos->count() > 1)
                        <div class="absolute bottom-6 right-6">
                            <span class="glass-effect text-gray-700 px-4 py-2 rounded-2xl text-sm font-medium border border-white/20">
                                <i class="fas fa-images mr-2"></i><span id="current-image">1</span>/{{ $pet->photos->count() }}
                            </span>
                        </div>
                    @endif
                </div>
                
                <!-- Enhanced Thumbnail Gallery -->
                @if($pet->photos->count() > 1)
                    <div class="grid grid-cols-5 gap-3">
                        @foreach($pet->photos as $index => $photo)
                            <div class="relative group cursor-pointer" onclick="changeMainImage('/storage/{{ $photo->path }}', {{ $index + 1 }})">
                                <img src="/storage/{{ $photo->path }}" alt="{{ $pet->name }}" 
                                     class="w-full h-20 object-cover rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border-2 border-transparent hover:border-primary-300 {{ $loop->first ? 'ring-2 ring-primary-500' : '' }}"
                                     onerror="this.style.display='none'">
                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-all duration-300 rounded-2xl"></div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-3xl blur-xl opacity-20"></div>
                    <div class="relative w-full h-[500px] bg-gradient-to-br from-primary-100 to-secondary-100 rounded-3xl flex items-center justify-center shadow-2xl border-4 border-white">
                        <i class="fas fa-paw text-primary-400 text-8xl animate-pulse"></i>
                    </div>
                    
                    <div class="absolute top-6 left-6">
                        <span class="glass-effect text-gray-700 px-6 py-3 rounded-2xl text-lg font-bold border border-white/20">
                            {{ ucfirst($pet->species) }}
                        </span>
                    </div>
                </div>
            @endif
            
            <!-- Enhanced Share buttons -->
            <div class="card p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-share-alt mr-3 text-primary-500"></i>Compartilhar este pet
                </h4>
                <div class="flex items-center space-x-3">
                    <button onclick="shareOnFacebook()" class="flex-1 bg-blue-600 text-white py-3 px-4 rounded-2xl hover:bg-blue-700 transition-all duration-300 font-medium hover:scale-105 transform">
                        <i class="fab fa-facebook-f mr-2"></i>Facebook
                    </button>
                    <button onclick="shareOnTwitter()" class="flex-1 bg-blue-400 text-white py-3 px-4 rounded-2xl hover:bg-blue-500 transition-all duration-300 font-medium hover:scale-105 transform">
                        <i class="fab fa-twitter mr-2"></i>Twitter
                    </button>
                    <button onclick="shareOnWhatsApp()" class="flex-1 bg-green-600 text-white py-3 px-4 rounded-2xl hover:bg-green-700 transition-all duration-300 font-medium hover:scale-105 transform">
                        <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                    </button>
                    <button onclick="copyLink()" class="w-12 h-12 bg-gray-600 text-white rounded-2xl hover:bg-gray-700 transition-all duration-300 flex items-center justify-center hover:scale-105 transform" title="Copiar link">
                        <i class="fas fa-link"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Enhanced Pet Details -->
        <div class="space-y-8">
            <!-- Pet Header -->
            <div class="card p-8">
                <h1 class="text-5xl font-bold text-gray-800 mb-4">{{ $pet->name }}</h1>
                <div class="flex flex-wrap items-center gap-6 text-gray-600">
                    <div class="flex items-center bg-primary-50 px-4 py-2 rounded-2xl">
                        <i class="fas fa-map-marker-alt mr-3 text-primary-600"></i>
                        <span class="font-medium">{{ $pet->city }}, {{ $pet->state }}</span>
                    </div>
                    <div class="flex items-center bg-accent-50 px-4 py-2 rounded-2xl">
                        <i class="fas fa-clock mr-3 text-accent-600"></i>
                        <span class="font-medium">{{ $pet->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="flex items-center bg-secondary-50 px-4 py-2 rounded-2xl">
                        <i class="fas fa-eye mr-3 text-secondary-600"></i>
                        <span class="font-medium">{{ rand(50, 500) }} visualizações</span>
                    </div>
                </div>
            </div>

            <!-- Enhanced Pet Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="card p-6 hover-lift">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-paw text-white text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium uppercase tracking-wide">Espécie</p>
                            <p class="text-2xl font-bold text-gray-800">{{ ucfirst($pet->species) }}</p>
                        </div>
                    </div>
                </div>

                @if($pet->breed)
                <div class="card p-6 hover-lift">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-secondary-500 to-secondary-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-tag text-white text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium uppercase tracking-wide">Raça</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $pet->breed }}</p>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Additional info cards -->
                <div class="card p-6 hover-lift">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-accent-500 to-accent-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-calendar-alt text-white text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium uppercase tracking-wide">Disponível desde</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $pet->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="card p-6 hover-lift">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-star text-white text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium uppercase tracking-wide">Status</p>
                            <p class="text-2xl font-bold text-accent-600">Disponível</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Description -->
            @if($pet->description)
            <div class="card p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-heart mr-3 text-red-500"></i>
                    Sobre {{ $pet->name }}
                </h3>
                <div class="prose prose-lg max-w-none">
                    <p class="text-gray-700 leading-relaxed text-lg">{{ $pet->description }}</p>
                </div>
            </div>
            @endif

            <!-- Enhanced Contact Information -->
            <div class="card p-8 border-2 border-primary-200 bg-gradient-to-br from-primary-50 to-white">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-r from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center mr-4">
                        <i class="fas fa-user-circle text-white text-xl"></i>
                    </div>
                    Informações de Contato
                </h3>
                
                <div class="space-y-6">
                    <div class="flex items-center space-x-4 bg-white/80 backdrop-blur-sm p-4 rounded-2xl border border-white/50">
                        <div class="w-12 h-12 bg-primary-100 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-envelope text-primary-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-500 font-medium">E-mail</p>
                            <p class="text-lg font-semibold text-gray-800">{{ $pet->contact_email }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4 bg-white/80 backdrop-blur-sm p-4 rounded-2xl border border-white/50">
                        <div class="w-12 h-12 bg-accent-100 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-phone text-accent-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-500 font-medium">Telefone</p>
                            <p class="text-lg font-semibold text-gray-800">{{ $pet->contact_phone }}</p>
                        </div>
                        <div class="flex space-x-2">
                            @if($pet->phone_accepts_calls)
                                <span class="bg-accent-100 text-accent-800 px-3 py-1 rounded-full text-sm font-medium border border-accent-200">
                                    <i class="fas fa-phone mr-1"></i>Ligações
                                </span>
                            @endif
                            @if($pet->phone_accepts_whatsapp)
                                <span class="bg-accent-100 text-accent-800 px-3 py-1 rounded-full text-sm font-medium border border-accent-200">
                                    <i class="fab fa-whatsapp mr-1"></i>WhatsApp
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Enhanced Contact Buttons -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
                    <a href="mailto:{{ $pet->contact_email }}" 
                       class="btn-primary text-center text-lg py-4 hover:scale-105 transform">
                        <i class="fas fa-envelope mr-3"></i>Enviar E-mail
                    </a>
                    
                    @if($pet->phone_accepts_whatsapp)
                        <a href="{{ $pet->whatsapp_url }}" target="_blank"
                           class="btn-accent text-center text-lg py-4 hover:scale-105 transform">
                            <i class="fab fa-whatsapp mr-3"></i>WhatsApp
                        </a>
                    @elseif($pet->phone_accepts_calls)
                        <a href="tel:{{ $pet->contact_phone }}" 
                           class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-4 rounded-2xl font-medium transition-all duration-300 hover:shadow-xl hover:scale-105 transform text-center text-lg">
                            <i class="fas fa-phone mr-3"></i>Ligar
                        </a>
                    @endif
                </div>
                
                <!-- Contact Tips -->
                <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-2xl">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-lightbulb text-yellow-600 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-yellow-800 mb-1">Dica importante:</h4>
                            <p class="text-yellow-700 text-sm">Sempre converse com o responsável antes de visitar o pet. Pergunte sobre histórico de saúde, vacinação e comportamento.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Owner Actions -->
            @auth
                @if(Auth::id() === $pet->user_id)
                    <div class="card p-6 border-2 border-yellow-200 bg-gradient-to-br from-yellow-50 to-white">
                        <h4 class="text-xl font-bold text-yellow-800 mb-4 flex items-center">
                            <i class="fas fa-cog mr-3"></i>Gerenciar Anúncio
                        </h4>
                        <p class="text-yellow-700 mb-6">Este é seu anúncio. Você pode editá-lo ou removê-lo a qualquer momento.</p>
                        <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                            <a href="{{ route('pets.edit', $pet) }}" 
                               class="flex-1 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white px-6 py-3 rounded-2xl font-medium transition-all duration-300 hover:shadow-xl hover:scale-105 transform text-center">
                                <i class="fas fa-edit mr-2"></i>Editar Anúncio
                            </a>
                            <form method="POST" action="{{ route('pets.destroy', $pet) }}" class="flex-1" 
                                  onsubmit="return confirm('Tem certeza que deseja excluir este anúncio? Esta ação não pode ser desfeita.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-6 py-3 rounded-2xl font-medium transition-all duration-300 hover:shadow-xl hover:scale-105 transform">
                                    <i class="fas fa-trash mr-2"></i>Excluir Anúncio
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    <!-- Enhanced Similar Pets -->
    <div class="mt-20">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Outros pets em {{ $pet->city }}</h2>
            <p class="text-xl text-gray-600">Conheça outros amiguinhos que também precisam de um lar</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $similarPets = App\Models\Pet::active()
                    ->with('photos')
                    ->where('id', '!=', $pet->id)
                    ->where('city', $pet->city)
                    ->limit(4)
                    ->get();
            @endphp
            
            @forelse($similarPets as $similarPet)
                <div class="card overflow-hidden hover-lift group">
                    <div class="relative overflow-hidden">
                        @if($similarPet->photos->count() > 0)
                            <img src="/storage/{{ $similarPet->photos->first()->path }}" alt="{{ $similarPet->name }}" 
                                 class="w-full h-48 object-cover group-hover:scale-110 transition-all duration-500"
                                 onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjNmNGY2Ii8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzk5YTNhZiIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkltYWdlbSBuw6NvIGVuY29udHJhZGE8L3RleHQ+PC9zdmc+'">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-primary-100 to-secondary-100 flex items-center justify-center">
                                <i class="fas fa-paw text-primary-400 text-3xl animate-pulse"></i>
                            </div>
                        @endif
                        
                        <div class="absolute top-3 left-3">
                            <span class="glass-effect text-gray-700 px-3 py-1 rounded-2xl text-sm font-semibold border border-white/20">
                                {{ ucfirst($similarPet->species) }}
                            </span>
                        </div>
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-primary-600 transition-colors">{{ $similarPet->name }}</h3>
                        @if($similarPet->breed)
                            <p class="text-gray-600 mb-4 flex items-center">
                                <i class="fas fa-tag mr-2 text-gray-400"></i>{{ $similarPet->breed }}
                            </p>
                        @endif
                        <a href="{{ route('pets.show', $similarPet) }}" 
                           class="btn-primary w-full text-center">
                            <i class="fas fa-eye mr-2"></i>Ver detalhes
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full card p-12 text-center">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Nenhum outro pet encontrado</h3>
                    <p class="text-gray-500">Não há outros pets disponíveis nesta cidade no momento.</p>
                </div>
            @endforelse
        </div>
        
        <!-- View all pets button -->
        <div class="text-center mt-12">
            <a href="{{ route('home', ['city' => $pet->city]) }}" class="btn-secondary text-lg px-8 py-4">
                <i class="fas fa-search mr-3"></i>Ver todos os pets em {{ $pet->city }}
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function changeMainImage(src, imageNumber) {
        const mainImage = document.getElementById('main-image');
        const currentImageSpan = document.getElementById('current-image');
        const thumbnails = document.querySelectorAll('.grid img');
        
        // Update main image
        mainImage.src = src;
        
        // Update image counter
        if (currentImageSpan) {
            currentImageSpan.textContent = imageNumber;
        }
        
        // Update thumbnail selection
        thumbnails.forEach((thumb, index) => {
            if (index === imageNumber - 1) {
                thumb.classList.add('ring-2', 'ring-primary-500');
                thumb.classList.remove('border-transparent');
            } else {
                thumb.classList.remove('ring-2', 'ring-primary-500');
                thumb.classList.add('border-transparent');
            }
        });
    }
    
    // Share functions
    function shareOnFacebook() {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent('Conheça {{ $pet->name }} - Disponível para adoção!');
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}&quote=${title}`, '_blank', 'width=600,height=400');
    }
    
    function shareOnTwitter() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent('Conheça {{ $pet->name }}, um {{ $pet->species }} disponível para adoção em {{ $pet->city }}! 🐾');
        window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank', 'width=600,height=400');
    }
    
    function shareOnWhatsApp() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent('Olha que fofo! {{ $pet->name }} está disponível para adoção em {{ $pet->city }}. Que tal dar um lar para este amiguinho? 🐾');
        window.open(`https://wa.me/?text=${text}%20${url}`, '_blank');
    }
    
    function copyLink() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            // Show success message
            const button = event.target.closest('button');
            const originalIcon = button.innerHTML;
            button.innerHTML = '<i class="fas fa-check"></i>';
            button.classList.add('bg-green-600');
            button.classList.remove('bg-gray-600');
            
            setTimeout(() => {
                button.innerHTML = originalIcon;
                button.classList.remove('bg-green-600');
                button.classList.add('bg-gray-600');
            }, 2000);
        });
    }
    
    // Favorite functionality (placeholder)
    function toggleFavorite(petId) {
        const button = event.target.closest('button');
        const icon = button.querySelector('i');
        
        if (icon.classList.contains('text-red-500')) {
            icon.classList.remove('text-red-500');
            icon.classList.add('text-gray-600');
        } else {
            icon.classList.add('text-red-500');
            icon.classList.remove('text-gray-600');
        }
    }
    
    // Image gallery keyboard navigation
    document.addEventListener('keydown', function(e) {
        const thumbnails = document.querySelectorAll('.grid img');
        const currentActive = document.querySelector('.grid img.ring-2');
        
        if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
            e.preventDefault();
            
            let currentIndex = Array.from(thumbnails).indexOf(currentActive);
            let newIndex;
            
            if (e.key === 'ArrowLeft') {
                newIndex = currentIndex > 0 ? currentIndex - 1 : thumbnails.length - 1;
            } else {
                newIndex = currentIndex < thumbnails.length - 1 ? currentIndex + 1 : 0;
            }
            
            thumbnails[newIndex].click();
        }
    });
</script>
@endpush
@endsection