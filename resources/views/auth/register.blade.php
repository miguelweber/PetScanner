@extends('layouts.app')

@section('title', 'Criar Conta - PetScanner')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-secondary-50 via-white to-accent-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Background elements -->
    <div class="absolute top-10 right-10 w-40 h-40 bg-secondary-200/20 rounded-full animate-float"></div>
    <div class="absolute bottom-10 left-10 w-32 h-32 bg-accent-200/20 rounded-full animate-float" style="animation-delay: 1.5s;"></div>
    <div class="absolute top-1/3 left-1/4 w-20 h-20 bg-primary-200/20 rounded-full animate-float" style="animation-delay: 0.5s;"></div>
    
    <div class="max-w-lg w-full space-y-8 relative z-10">
        <div class="text-center animate-fade-in">
            <div class="flex justify-center mb-8">
                <div class="w-20 h-20 gradient-bg rounded-3xl flex items-center justify-center shadow-2xl animate-bounce-gentle">
                    <i class="fas fa-paw text-white text-3xl"></i>
                </div>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Junte-se a nós!
            </h2>
            <p class="text-lg text-gray-600 mb-2">
                Crie sua conta e ajude a salvar vidas
            </p>
            <p class="text-gray-500">
                Já tem uma conta?
                <a href="{{ route('login') }}" class="font-semibold text-secondary-600 hover:text-secondary-700 transition-colors">
                    Faça login aqui
                </a>
            </p>
        </div>
        
        <form class="card p-8 space-y-8 animate-slide-up" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="space-y-6">
                <div class="space-y-2">
                    <label for="name" class="block text-lg font-semibold text-gray-700">
                        Nome completo
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input id="name" name="name" type="text" autocomplete="name" required 
                               value="{{ old('name') }}"
                               class="input pl-12 text-lg @error('name') border-red-500 ring-red-200 @enderror" 
                               placeholder="Seu nome completo">
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>
                
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
                        <input id="password" name="password" type="password" autocomplete="new-password" required 
                               class="input pl-12 pr-12 text-lg @error('password') border-red-500 ring-red-200 @enderror" 
                               placeholder="Mínimo 8 caracteres">
                        <button type="button" onclick="togglePassword('password')" 
                                class="absolute inset-y-0 right-0 pr-4 flex items-center hover:text-secondary-600 transition-colors">
                            <i id="password-icon" class="fas fa-eye text-gray-400"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                    
                    <!-- Enhanced Password Strength Indicator -->
                    <div class="mt-4 p-4 bg-gray-50 rounded-2xl">
                        <div class="flex space-x-1 mb-2">
                            <div id="strength-1" class="h-2 flex-1 bg-gray-200 rounded-full transition-all duration-300"></div>
                            <div id="strength-2" class="h-2 flex-1 bg-gray-200 rounded-full transition-all duration-300"></div>
                            <div id="strength-3" class="h-2 flex-1 bg-gray-200 rounded-full transition-all duration-300"></div>
                            <div id="strength-4" class="h-2 flex-1 bg-gray-200 rounded-full transition-all duration-300"></div>
                        </div>
                        <p id="strength-text" class="text-sm text-gray-600 font-medium">Digite uma senha</p>
                        <div class="mt-2 text-xs text-gray-500 space-y-1">
                            <div class="flex items-center" id="req-length">
                                <i class="fas fa-circle text-gray-300 mr-2 text-xs"></i>
                                <span>Mínimo 8 caracteres</span>
                            </div>
                            <div class="flex items-center" id="req-lower">
                                <i class="fas fa-circle text-gray-300 mr-2 text-xs"></i>
                                <span>Letra minúscula</span>
                            </div>
                            <div class="flex items-center" id="req-upper">
                                <i class="fas fa-circle text-gray-300 mr-2 text-xs"></i>
                                <span>Letra maiúscula</span>
                            </div>
                            <div class="flex items-center" id="req-number">
                                <i class="fas fa-circle text-gray-300 mr-2 text-xs"></i>
                                <span>Número</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-lg font-semibold text-gray-700">
                        Confirmar senha
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-shield-alt text-gray-400"></i>
                        </div>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                               class="input pl-12 pr-12 text-lg @error('password_confirmation') border-red-500 ring-red-200 @enderror" 
                               placeholder="Digite a senha novamente">
                        <button type="button" onclick="togglePassword('password_confirmation')" 
                                class="absolute inset-y-0 right-0 pr-4 flex items-center hover:text-secondary-600 transition-colors">
                            <i id="password_confirmation-icon" class="fas fa-eye text-gray-400"></i>
                        </button>
                    </div>
                    <div id="password-match" class="mt-2 text-sm hidden">
                        <div class="flex items-center text-green-600">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>Senhas coincidem</span>
                        </div>
                    </div>
                    <div id="password-no-match" class="mt-2 text-sm hidden">
                        <div class="flex items-center text-red-600">
                            <i class="fas fa-times-circle mr-2"></i>
                            <span>Senhas não coincidem</span>
                        </div>
                    </div>
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <div class="card p-4 bg-gray-50 border-gray-200">
                <label class="flex items-start cursor-pointer">
                    <input id="terms" name="terms" type="checkbox" required
                           class="h-5 w-5 text-secondary-600 focus:ring-secondary-500 border-gray-300 rounded mt-1 mr-3">
                    <div class="text-gray-700">
                        <span class="font-medium">Eu concordo com os</span>
                        <a href="#" class="text-secondary-600 hover:text-secondary-700 font-semibold mx-1">Termos de Uso</a>
                        <span>e</span>
                        <a href="#" class="text-secondary-600 hover:text-secondary-700 font-semibold mx-1">Política de Privacidade</a>
                        <p class="text-sm text-gray-500 mt-1">Ao criar uma conta, você concorda em receber e-mails sobre pets disponíveis para adoção.</p>
                    </div>
                </label>
            </div>

            <button type="submit" id="register-btn"
                    class="btn-accent w-full text-lg py-4 relative overflow-hidden">
                <span class="relative z-10 flex items-center justify-center">
                    <i class="fas fa-user-plus mr-3"></i>
                    Criar minha conta gratuita
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
                    <span class="px-6 bg-white text-gray-500 font-medium">Ou cadastre-se com</span>
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
        
        <!-- Benefits section -->
        <div class="card p-6 bg-gradient-to-r from-accent-50 to-primary-50 border-accent-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center">Por que se cadastrar?</h3>
            <div class="space-y-3">
                <div class="flex items-center text-gray-700">
                    <i class="fas fa-heart text-accent-600 mr-3"></i>
                    <span>Ajude pets a encontrarem um lar</span>
                </div>
                <div class="flex items-center text-gray-700">
                    <i class="fas fa-shield-alt text-primary-600 mr-3"></i>
                    <span>Plataforma 100% segura e gratuita</span>
                </div>
                <div class="flex items-center text-gray-700">
                    <i class="fas fa-bell text-secondary-600 mr-3"></i>
                    <span>Receba notificações de novos pets</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function togglePassword(fieldId) {
        const passwordInput = document.getElementById(fieldId);
        const passwordIcon = document.getElementById(fieldId + '-icon');
        
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
    
    // Enhanced password strength checker
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    
    passwordInput.addEventListener('input', function(e) {
        const password = e.target.value;
        const strength = checkPasswordStrength(password);
        updateStrengthIndicator(strength, password);
        checkPasswordMatch();
    });
    
    confirmInput.addEventListener('input', checkPasswordMatch);
    
    function checkPasswordStrength(password) {
        let strength = 0;
        const requirements = {
            length: password.length >= 8,
            lower: /[a-z]/.test(password),
            upper: /[A-Z]/.test(password),
            number: /[0-9]/.test(password)
        };
        
        // Update requirement indicators
        updateRequirement('req-length', requirements.length);
        updateRequirement('req-lower', requirements.lower);
        updateRequirement('req-upper', requirements.upper);
        updateRequirement('req-number', requirements.number);
        
        // Calculate strength
        Object.values(requirements).forEach(met => {
            if (met) strength++;
        });
        
        return strength;
    }
    
    function updateRequirement(id, met) {
        const element = document.getElementById(id);
        const icon = element.querySelector('i');
        
        if (met) {
            icon.className = 'fas fa-check-circle text-green-500 mr-2 text-xs';
            element.classList.add('text-green-600');
            element.classList.remove('text-gray-500');
        } else {
            icon.className = 'fas fa-circle text-gray-300 mr-2 text-xs';
            element.classList.remove('text-green-600');
            element.classList.add('text-gray-500');
        }
    }
    
    function updateStrengthIndicator(strength, password) {
        const indicators = ['strength-1', 'strength-2', 'strength-3', 'strength-4'];
        const colors = ['bg-red-500', 'bg-yellow-500', 'bg-blue-500', 'bg-green-500'];
        const texts = ['Muito fraca', 'Fraca', 'Média', 'Forte'];
        
        // Reset all indicators
        indicators.forEach(id => {
            const element = document.getElementById(id);
            element.className = 'h-2 flex-1 bg-gray-200 rounded-full transition-all duration-300';
        });
        
        // Update active indicators
        if (password.length > 0) {
            for (let i = 0; i < strength; i++) {
                const element = document.getElementById(indicators[i]);
                element.className = `h-2 flex-1 ${colors[Math.min(strength - 1, 3)]} rounded-full transition-all duration-300`;
            }
            
            // Update text
            document.getElementById('strength-text').textContent = texts[Math.min(strength - 1, 3)] || 'Muito fraca';
        } else {
            document.getElementById('strength-text').textContent = 'Digite uma senha';
        }
    }
    
    function checkPasswordMatch() {
        const password = passwordInput.value;
        const confirm = confirmInput.value;
        const matchDiv = document.getElementById('password-match');
        const noMatchDiv = document.getElementById('password-no-match');
        
        if (confirm.length > 0) {
            if (password === confirm) {
                matchDiv.classList.remove('hidden');
                noMatchDiv.classList.add('hidden');
                confirmInput.classList.remove('border-red-500');
                confirmInput.classList.add('border-green-500');
            } else {
                matchDiv.classList.add('hidden');
                noMatchDiv.classList.remove('hidden');
                confirmInput.classList.add('border-red-500');
                confirmInput.classList.remove('border-green-500');
            }
        } else {
            matchDiv.classList.add('hidden');
            noMatchDiv.classList.add('hidden');
            confirmInput.classList.remove('border-red-500', 'border-green-500');
        }
    }
    
    // Enhanced form handling
    document.querySelector('form').addEventListener('submit', function() {
        const registerBtn = document.getElementById('register-btn');
        const originalContent = registerBtn.innerHTML;
        
        registerBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Criando conta...';
        registerBtn.disabled = true;
        
        // Re-enable after 10 seconds as fallback
        setTimeout(() => {
            registerBtn.innerHTML = originalContent;
            registerBtn.disabled = false;
        }, 10000);
    });
    
    // Auto-focus on first input
    document.getElementById('name').focus();
</script>
@endpush
@endsection