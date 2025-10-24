@extends('layouts.app')

@section('title', 'Entrar - PetScanner')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 via-white to-secondary-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Background elements -->
    <div class="absolute top-20 left-10 w-32 h-32 bg-primary-200/20 rounded-full animate-float"></div>
    <div class="absolute bottom-20 right-10 w-24 h-24 bg-secondary-200/20 rounded-full animate-float" style="animation-delay: 1s;"></div>
    <div class="absolute top-1/2 right-1/4 w-16 h-16 bg-accent-200/20 rounded-full animate-float" style="animation-delay: 2s;"></div>
    
    <div class="max-w-md w-full space-y-8 relative z-10">
        <div class="text-center animate-fade-in">
            <div class="flex justify-center mb-8">
                <div class="w-20 h-20 gradient-bg rounded-3xl flex items-center justify-center shadow-2xl animate-bounce-gentle">
                    <i class="fas fa-paw text-white text-3xl"></i>
                </div>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Bem-vindo de volta!
            </h2>
            <p class="text-lg text-gray-600 mb-2">
                Entre na sua conta para continuar
            </p>
            <p class="text-gray-500">
                Não tem uma conta?
                <a href="{{ route('register') }}" class="font-semibold text-primary-600 hover:text-primary-700 transition-colors">
                    Cadastre-se gratuitamente
                </a>
            </p>
        </div>
        
        <form class="card p-8 space-y-8 animate-slide-up" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="space-y-6">
                <div class="space-y-2">
                    <label for="email" class="block text-lg font-semibold text-gray-700">
                        E-mail
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                               value="{{ old('email') }}"
                               class="input pl-12 text-lg @error('email') border-red-500 ring-red-200 @enderror" 
                               placeholder="seu@email.com">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>
                
                <div class="space-y-2">
                    <label for="password" class="block text-lg font-semibold text-gray-700">
                        Senha
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                               class="input pl-12 pr-12 text-lg @error('password') border-red-500 ring-red-200 @enderror" 
                               placeholder="Sua senha">
                        <button type="button" onclick="togglePassword()" 
                                class="absolute inset-y-0 right-0 pr-4 flex items-center hover:text-primary-600 transition-colors">
                            <i id="password-icon" class="fas fa-eye text-gray-400"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center cursor-pointer">
                    <input id="remember" name="remember" type="checkbox" 
                           class="h-5 w-5 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                    <span class="ml-3 text-gray-700 font-medium">Lembrar de mim</span>
                </label>

                <a href="#" class="font-semibold text-primary-600 hover:text-primary-700 transition-colors">
                    Esqueceu sua senha?
                </a>
            </div>

            <button type="submit" id="login-btn"
                    class="btn-primary w-full text-lg py-4 relative overflow-hidden">
                <span class="relative z-10 flex items-center justify-center">
                    <i class="fas fa-sign-in-alt mr-3"></i>
                    Entrar na minha conta
                </span>
            </button>
        </form>
        
        <!-- Enhanced Social Login -->
        <div class="space-y-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="px-6 bg-white text-gray-500 font-medium">Ou continue com</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <button class="card p-4 hover:bg-red-50 hover:border-red-200 transition-all duration-300 group">
                    <div class="flex items-center justify-center space-x-3">
                        <i class="fab fa-google text-red-500 text-xl group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium text-gray-700">Google</span>
                    </div>
                </button>

                <button class="card p-4 hover:bg-blue-50 hover:border-blue-200 transition-all duration-300 group">
                    <div class="flex items-center justify-center space-x-3">
                        <i class="fab fa-facebook-f text-blue-600 text-xl group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium text-gray-700">Facebook</span>
                    </div>
                </button>
            </div>
        </div>
        
        <!-- Additional info -->
        <div class="text-center">
            <div class="inline-flex items-center bg-primary-50 border border-primary-200 rounded-2xl px-6 py-3 text-primary-700">
                <i class="fas fa-shield-alt mr-3 text-primary-600"></i>
                <span class="font-medium">Seus dados estão seguros conosco</span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const passwordIcon = document.getElementById('password-icon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    }
    
    // Enhanced form handling
    document.querySelector('form').addEventListener('submit', function() {
        const loginBtn = document.getElementById('login-btn');
        const originalContent = loginBtn.innerHTML;
        
        loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Entrando...';
        loginBtn.disabled = true;
        
        // Re-enable after 10 seconds as fallback
        setTimeout(() => {
            loginBtn.innerHTML = originalContent;
            loginBtn.disabled = false;
        }, 10000);
    });
    
    // Auto-focus on first input
    document.getElementById('email').focus();
    
    // Enter key navigation
    document.getElementById('email').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            document.getElementById('password').focus();
        }
    });
</script>
@endpush
@endsection