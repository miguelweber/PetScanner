<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'PetScanner - Plataforma de Adoção de Pets')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e'
                        },
                        secondary: {
                            50: '#fdf4ff',
                            100: '#fae8ff',
                            200: '#f5d0fe',
                            300: '#f0abfc',
                            400: '#e879f9',
                            500: '#d946ef',
                            600: '#c026d3',
                            700: '#a21caf',
                            800: '#86198f',
                            900: '#701a75'
                        },
                        accent: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b'
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'system-ui', 'sans-serif']
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                        'bounce-gentle': 'bounceGentle 2s infinite'
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(10px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' }
                        },
                        bounceGentle: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-5px)' }
                        }
                    }
                }
            }
        }
    </script>

    <!-- Custom Styles -->
    <style>
        * {
            font-family: 'Poppins', system-ui, sans-serif;
        }

        .btn-primary {
            @apply bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white px-6 py-3 rounded-2xl font-medium transition-all duration-300 hover:shadow-xl hover:scale-105 transform;
        }

        .btn-secondary {
            @apply bg-white hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-2xl font-medium transition-all duration-300 border border-gray-200 hover:border-gray-300 hover:shadow-lg;
        }

        .btn-accent {
            @apply bg-gradient-to-r from-accent-500 to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white px-6 py-3 rounded-2xl font-medium transition-all duration-300 hover:shadow-xl hover:scale-105 transform;
        }

        .card {
            @apply bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-gray-200 transform hover:-translate-y-1;
        }

        .input {
            @apply w-full px-4 py-3 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-primary-100 focus:border-primary-500 transition-all duration-300 bg-white;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #0ea5e9 0%, #d946ef 100%);
        }

        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.9);
        }

        .text-gradient {
            background: linear-gradient(135deg, #0ea5e9, #d946ef);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    @stack('styles')
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-primary-50 min-h-screen">
    <!-- Navigation -->
    <nav class="glass-effect border-b border-white/20 sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="w-12 h-12 gradient-bg rounded-2xl flex items-center justify-center transform group-hover:scale-110 transition-all duration-300 shadow-lg">
                            <i class="fas fa-paw text-white text-xl animate-bounce-gentle"></i>
                        </div>
                        <span class="text-2xl font-bold text-gradient">PetScanner</span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600 font-medium transition-all duration-300 hover:scale-105">
                        <i class="fas fa-home mr-2"></i>Início
                    </a>

                    @auth
                        <a href="{{ route('pets.create') }}" class="btn-primary">
                            <i class="fas fa-plus mr-2"></i>Anunciar Pet
                        </a>
                        <a href="{{ route('pets.my-pets') }}" class="text-gray-700 hover:text-primary-600 font-medium transition-all duration-300 hover:scale-105">
                            <i class="fas fa-heart mr-2"></i>Meus Pets
                        </a>

                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-primary-600 font-medium transition-all duration-300 bg-white/50 px-4 py-2 rounded-2xl hover:bg-white/80">
                                <div class="w-8 h-8 bg-gradient-to-r from-primary-400 to-secondary-400 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
                            </button>

                            <div class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 border border-gray-100">
                                <div class="py-3">
                                    <a href="{{ route('profile.show') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-all duration-200">
                                        <i class="fas fa-user mr-3 w-4"></i>Perfil
                                    </a>
                                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-all duration-200">
                                        <i class="fas fa-tachometer-alt mr-3 w-4"></i>Dashboard
                                    </a>
                                    @if(Auth::user()->is_admin)
                                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-red-600 hover:bg-red-50 transition-all duration-200">
                                            <i class="fas fa-shield-alt mr-3 w-4"></i>Admin
                                        </a>
                                    @endif
                                    <hr class="my-2 border-gray-100">
                                    <form method="POST" action="{{ route('logout') }}" class="block">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all duration-200">
                                            <i class="fas fa-sign-out-alt mr-3 w-4"></i>Sair
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-600 font-medium transition-all duration-300 hover:scale-105">
                            <i class="fas fa-sign-in-alt mr-2"></i>Entrar
                        </a>
                        <a href="{{ route('register') }}" class="btn-accent">
                            <i class="fas fa-user-plus mr-2"></i>Cadastrar
                        </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-gray-700 hover:text-primary-600 focus:outline-none bg-white/50 p-2 rounded-xl hover:bg-white/80 transition-all duration-300">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-white/95 backdrop-blur-md border-t border-white/20">
            <div class="px-4 pt-4 pb-6 space-y-2">
                <a href="{{ route('home') }}" class="flex items-center px-4 py-3 text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-xl font-medium transition-all duration-200">
                    <i class="fas fa-home mr-3 w-5"></i>Início
                </a>

                @auth
                    <a href="{{ route('pets.create') }}" class="flex items-center px-4 py-3 text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-xl font-medium transition-all duration-200">
                        <i class="fas fa-plus mr-3 w-5"></i>Anunciar Pet
                    </a>
                    <a href="{{ route('pets.my-pets') }}" class="flex items-center px-4 py-3 text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-xl font-medium transition-all duration-200">
                        <i class="fas fa-heart mr-3 w-5"></i>Meus Pets
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-3 text-gray-700 hover:text-red-600 hover:bg-red-50 rounded-xl font-medium transition-all duration-200">
                            <i class="fas fa-sign-out-alt mr-3 w-5"></i>Sair
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="flex items-center px-4 py-3 text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-xl font-medium transition-all duration-200">
                        <i class="fas fa-sign-in-alt mr-3 w-5"></i>Entrar
                    </a>
                    <a href="{{ route('register') }}" class="flex items-center px-4 py-3 text-gray-700 hover:text-accent-600 hover:bg-accent-50 rounded-xl font-medium transition-all duration-200">
                        <i class="fas fa-user-plus mr-3 w-5"></i>Cadastrar
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="fixed top-24 right-4 z-50 animate-slide-up" id="success-alert">
            <div class="bg-gradient-to-r from-accent-500 to-accent-600 text-white px-6 py-4 rounded-2xl shadow-2xl border border-accent-300 flex items-center space-x-3">
                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-check text-sm"></i>
                </div>
                <span class="font-medium">{{ session('success') }}</span>
                <button onclick="closeAlert('success-alert')" class="ml-4 text-white/80 hover:text-white transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="fixed top-24 right-4 z-50 animate-slide-up" id="error-alert">
            <div class="bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-4 rounded-2xl shadow-2xl border border-red-300 flex items-center space-x-3">
                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-sm"></i>
                </div>
                <span class="font-medium">{{ session('error') }}</span>
                <button onclick="closeAlert('error-alert')" class="ml-4 text-white/80 hover:text-white transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white mt-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-900/20 to-secondary-900/20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 gradient-bg rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-paw text-white text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold">PetScanner</span>
                    </div>
                    <p class="text-gray-300 mb-6 text-lg leading-relaxed">
                        A plataforma que conecta pets que precisam de um lar com pessoas que querem adotar.
                        Juntos, fazemos a diferença na vida dos animais.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 bg-white/10 hover:bg-white/20 rounded-2xl flex items-center justify-center text-gray-300 hover:text-white transition-all duration-300 hover:scale-110">
                            <i class="fab fa-facebook-f text-lg"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-white/10 hover:bg-white/20 rounded-2xl flex items-center justify-center text-gray-300 hover:text-white transition-all duration-300 hover:scale-110">
                            <i class="fab fa-instagram text-lg"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-white/10 hover:bg-white/20 rounded-2xl flex items-center justify-center text-gray-300 hover:text-white transition-all duration-300 hover:scale-110">
                            <i class="fab fa-twitter text-lg"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-white/10 hover:bg-white/20 rounded-2xl flex items-center justify-center text-gray-300 hover:text-white transition-all duration-300 hover:scale-110">
                            <i class="fab fa-whatsapp text-lg"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-semibold mb-6 text-white">Links Úteis</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Como Adotar</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Como Anunciar</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Dicas de Cuidados</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Contato</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-semibold mb-6 text-white">Legal</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('terms') }}" class="text-gray-300 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Termos de Uso</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-gray-300 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Política de Privacidade</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-gray-300 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">LGPD</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700/50 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-300 text-center md:text-left">
                        &copy; {{ date('Y') }} PetScanner. Todos os direitos reservados.
                    </p>
                    <div class="flex items-center space-x-2 mt-4 md:mt-0">
                        <span class="text-gray-400">Feito com</span>
                        <i class="fas fa-heart text-red-500 animate-pulse"></i>
                        <span class="text-gray-400">para os pets</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            const icon = this.querySelector('i');

            menu.classList.toggle('hidden');

            if (menu.classList.contains('hidden')) {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            } else {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            }
        });

        // Close alert function
        function closeAlert(alertId) {
            const alert = document.getElementById(alertId);
            if (alert) {
                alert.style.transform = 'translateX(100%)';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            }
        }

        // Auto-hide flash messages
        setTimeout(function() {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');

            if (successAlert) closeAlert('success-alert');
            if (errorAlert) closeAlert('error-alert');
        }, 5000);

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add loading states to buttons
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Carregando...';
                    submitBtn.disabled = true;

                    // Re-enable after 10 seconds as fallback
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 10000);
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
