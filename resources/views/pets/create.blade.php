@extends('layouts.app')

@section('title', 'Cadastrar Pet - PetScanner')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 via-white to-secondary-50 py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Enhanced Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-3xl shadow-2xl mb-6">
                <i class="fas fa-heart text-white text-3xl"></i>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-6 leading-tight">
                Cadastrar Pet para <span class="text-gradient">Adoção</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Preencha as informações abaixo para ajudar seu pet a encontrar um novo lar cheio de amor 🐾
            </p>
            
            <!-- Progress indicator -->
            <div class="flex items-center justify-center space-x-4 mt-8">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-primary-500 rounded-full flex items-center justify-center text-white text-sm font-bold">1</div>
                    <span class="ml-2 text-gray-600 font-medium">Informações do Pet</span>
                </div>
                <div class="w-8 h-1 bg-gray-200 rounded-full"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 text-sm font-bold">2</div>
                    <span class="ml-2 text-gray-500 font-medium">Localização</span>
                </div>
                <div class="w-8 h-1 bg-gray-200 rounded-full"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 text-sm font-bold">3</div>
                    <span class="ml-2 text-gray-500 font-medium">Contato</span>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('pets.store') }}" enctype="multipart/form-data" class="space-y-12" id="pet-form">
            @csrf
            
            <!-- Enhanced Pet Information -->
            <div class="card p-8 animate-fade-in">
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 bg-gradient-to-r from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center mr-4">
                        <i class="fas fa-paw text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Informações do Pet</h2>
                        <p class="text-gray-600">Conte-nos sobre seu amiguinho</p>
                    </div>
                </div>
            
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Enhanced Name -->
                    <div class="space-y-2">
                        <label for="name" class="block text-lg font-semibold text-gray-700">
                            Nome do Pet <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-heart text-gray-400"></i>
                            </div>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                   class="input pl-12 text-lg @error('name') border-red-500 ring-red-200 @enderror"
                                   placeholder="Ex: Buddy, Luna, Max...">
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Enhanced Species -->
                    <div class="space-y-2">
                        <label for="species" class="block text-lg font-semibold text-gray-700">
                            Espécie <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-paw text-gray-400"></i>
                            </div>
                            <select id="species" name="species" required
                                    class="input pl-12 text-lg @error('species') border-red-500 ring-red-200 @enderror">
                                <option value="">Selecione a espécie</option>
                                <option value="cachorro" {{ old('species') == 'cachorro' ? 'selected' : '' }}>🐕 Cachorro</option>
                                <option value="gato" {{ old('species') == 'gato' ? 'selected' : '' }}>🐱 Gato</option>
                                <option value="coelho" {{ old('species') == 'coelho' ? 'selected' : '' }}>🐰 Coelho</option>
                                <option value="hamster" {{ old('species') == 'hamster' ? 'selected' : '' }}>🐹 Hamster</option>
                                <option value="passaro" {{ old('species') == 'passaro' ? 'selected' : '' }}>🐦 Pássaro</option>
                                <option value="outro" {{ old('species') == 'outro' ? 'selected' : '' }}>🐾 Outro</option>
                            </select>
                        </div>
                        @error('species')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Enhanced Breed -->
                    <div class="md:col-span-2 space-y-2">
                        <label for="breed" class="block text-lg font-semibold text-gray-700">
                            Raça <span class="text-gray-400">(opcional)</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-tag text-gray-400"></i>
                            </div>
                            <input type="text" id="breed" name="breed" value="{{ old('breed') }}"
                                   class="input pl-12 text-lg @error('breed') border-red-500 ring-red-200 @enderror"
                                   placeholder="Ex: Labrador, Persa, SRD (Sem Raça Definida)...">
                        </div>
                        @error('breed')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Enhanced Photos -->
                    <div class="md:col-span-2 space-y-4">
                        <label for="photos" class="block text-lg font-semibold text-gray-700">
                            Fotos do Pet <span class="text-gray-400">(máximo 5)</span>
                        </label>
                        <div class="relative">
                            <input id="photos" name="photos[]" type="file" class="hidden" accept="image/*" multiple>
                            <div id="photo-upload-area" class="border-2 border-dashed border-gray-300 rounded-3xl p-8 text-center hover:border-primary-400 hover:bg-primary-50/50 transition-all duration-300 cursor-pointer group" onclick="document.getElementById('photos').click()">
                                <div id="upload-content">
                                    <div class="w-20 h-20 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                                        <i class="fas fa-camera text-white text-2xl"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Adicione fotos do seu pet</h3>
                                    <p class="text-gray-500 mb-6">Clique aqui ou arraste as imagens para fazer upload</p>
                                    <div class="inline-flex items-center bg-white border border-gray-200 rounded-2xl px-6 py-3 text-gray-600 hover:bg-gray-50 transition-colors">
                                        <i class="fas fa-upload mr-2"></i>
                                        <span class="font-medium">Escolher arquivos</span>
                                    </div>
                                    <p class="text-sm text-gray-400 mt-4">JPEG, JPG, PNG, GIF, WEBP até 2MB cada</p>
                                </div>
                                <div id="photos-preview" class="hidden grid grid-cols-2 md:grid-cols-3 gap-4 mt-6"></div>
                            </div>
                        </div>
                        @error('photos')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                        @error('photos.*')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Enhanced Description -->
                    <div class="md:col-span-2 space-y-2">
                        <label for="description" class="block text-lg font-semibold text-gray-700">
                            Descrição <span class="text-gray-400">(opcional)</span>
                        </label>
                        <div class="relative">
                            <textarea id="description" name="description" rows="6"
                                      class="input text-lg resize-none @error('description') border-red-500 ring-red-200 @enderror"
                                      placeholder="Conte um pouco sobre a personalidade, cuidados especiais, histórico do pet... Quanto mais informações, melhor!">{{ old('description') }}</textarea>
                            <div class="absolute bottom-3 right-3 text-sm text-gray-400" id="char-count">0/500</div>
                        </div>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Enhanced Location -->
            <div class="card p-8 animate-fade-in">
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 bg-gradient-to-r from-accent-500 to-accent-600 rounded-2xl flex items-center justify-center mr-4">
                        <i class="fas fa-map-marker-alt text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Localização</h2>
                        <p class="text-gray-600">Onde o pet está localizado?</p>
                    </div>
                </div>
            
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Enhanced City -->
                    <div class="space-y-2">
                        <label for="city" class="block text-lg font-semibold text-gray-700">
                            Cidade <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-city text-gray-400"></i>
                            </div>
                            <input type="text" id="city" name="city" value="{{ old('city') }}" required
                                   class="input pl-12 text-lg @error('city') border-red-500 ring-red-200 @enderror"
                                   placeholder="Ex: São Paulo, Rio de Janeiro...">
                        </div>
                        @error('city')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Enhanced State -->
                    <div class="space-y-2">
                        <label for="state" class="block text-lg font-semibold text-gray-700">
                            Estado <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-map text-gray-400"></i>
                            </div>
                            <select id="state" name="state" required
                                    class="input pl-12 text-lg @error('state') border-red-500 ring-red-200 @enderror">
                                <option value="">Selecione o estado</option>
                                <option value="AC" {{ old('state') == 'AC' ? 'selected' : '' }}>Acre</option>
                                <option value="AL" {{ old('state') == 'AL' ? 'selected' : '' }}>Alagoas</option>
                                <option value="AP" {{ old('state') == 'AP' ? 'selected' : '' }}>Amapá</option>
                                <option value="AM" {{ old('state') == 'AM' ? 'selected' : '' }}>Amazonas</option>
                                <option value="BA" {{ old('state') == 'BA' ? 'selected' : '' }}>Bahia</option>
                                <option value="CE" {{ old('state') == 'CE' ? 'selected' : '' }}>Ceará</option>
                                <option value="DF" {{ old('state') == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                                <option value="ES" {{ old('state') == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                                <option value="GO" {{ old('state') == 'GO' ? 'selected' : '' }}>Goiás</option>
                                <option value="MA" {{ old('state') == 'MA' ? 'selected' : '' }}>Maranhão</option>
                                <option value="MT" {{ old('state') == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                                <option value="MS" {{ old('state') == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                                <option value="MG" {{ old('state') == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                                <option value="PA" {{ old('state') == 'PA' ? 'selected' : '' }}>Pará</option>
                                <option value="PB" {{ old('state') == 'PB' ? 'selected' : '' }}>Paraíba</option>
                                <option value="PR" {{ old('state') == 'PR' ? 'selected' : '' }}>Paraná</option>
                                <option value="PE" {{ old('state') == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                                <option value="PI" {{ old('state') == 'PI' ? 'selected' : '' }}>Piauí</option>
                                <option value="RJ" {{ old('state') == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                                <option value="RN" {{ old('state') == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                                <option value="RS" {{ old('state') == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                                <option value="RO" {{ old('state') == 'RO' ? 'selected' : '' }}>Rondônia</option>
                                <option value="RR" {{ old('state') == 'RR' ? 'selected' : '' }}>Roraima</option>
                                <option value="SC" {{ old('state') == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                                <option value="SP" {{ old('state') == 'SP' ? 'selected' : '' }}>São Paulo</option>
                                <option value="SE" {{ old('state') == 'SE' ? 'selected' : '' }}>Sergipe</option>
                                <option value="TO" {{ old('state') == 'TO' ? 'selected' : '' }}>Tocantins</option>
                            </select>
                        </div>
                        @error('state')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Enhanced Contact Information -->
            <div class="card p-8 animate-fade-in">
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 bg-gradient-to-r from-secondary-500 to-secondary-600 rounded-2xl flex items-center justify-center mr-4">
                        <i class="fas fa-phone text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Informações de Contato</h2>
                        <p class="text-gray-600">Como os interessados podem entrar em contato?</p>
                    </div>
                </div>
            
                <div class="space-y-8">
                    <!-- Enhanced Email -->
                    <div class="space-y-2">
                        <label for="contact_email" class="block text-lg font-semibold text-gray-700">
                            E-mail para Contato <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', Auth::user()->email) }}" required
                                   class="input pl-12 text-lg @error('contact_email') border-red-500 ring-red-200 @enderror"
                                   placeholder="seu@email.com">
                        </div>
                        @error('contact_email')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Enhanced Phone -->
                    <div class="space-y-2">
                        <label for="contact_phone" class="block text-lg font-semibold text-gray-700">
                            Telefone/WhatsApp <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                            <input type="tel" id="contact_phone" name="contact_phone" value="{{ old('contact_phone') }}" required
                                   class="input pl-12 text-lg @error('contact_phone') border-red-500 ring-red-200 @enderror"
                                   placeholder="(11) 99999-9999">
                        </div>
                        @error('contact_phone')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Enhanced Contact Preferences -->
                    <div class="space-y-4">
                        <label class="block text-lg font-semibold text-gray-700 mb-4">
                            Como prefere ser contatado?
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="card p-4 cursor-pointer hover:bg-primary-50 transition-all duration-300 border-2 border-transparent hover:border-primary-200">
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" name="phone_accepts_calls" value="1" 
                                           {{ old('phone_accepts_calls') ? 'checked' : 'checked' }}
                                           class="h-5 w-5 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-green-100 rounded-2xl flex items-center justify-center mr-3">
                                            <i class="fas fa-phone text-green-600"></i>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-800">Ligações telefônicas</span>
                                            <p class="text-sm text-gray-500">Aceito receber ligações</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            <label class="card p-4 cursor-pointer hover:bg-accent-50 transition-all duration-300 border-2 border-transparent hover:border-accent-200">
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" name="phone_accepts_whatsapp" value="1" 
                                           {{ old('phone_accepts_whatsapp') ? 'checked' : 'checked' }}
                                           class="h-5 w-5 text-accent-600 focus:ring-accent-500 border-gray-300 rounded">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-green-100 rounded-2xl flex items-center justify-center mr-3">
                                            <i class="fab fa-whatsapp text-green-600"></i>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-800">WhatsApp</span>
                                            <p class="text-sm text-gray-500">Aceito mensagens no WhatsApp</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Submit Buttons -->
            <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0 pt-8">
                <a href="{{ route('home') }}" 
                   class="btn-secondary text-lg px-8 py-4 w-full sm:w-auto">
                    <i class="fas fa-arrow-left mr-3"></i>Cancelar
                </a>
                
                <button type="submit" id="submit-btn"
                        class="btn-primary text-lg px-12 py-4 w-full sm:w-auto">
                    <i class="fas fa-heart mr-3"></i>Cadastrar Pet
                </button>
            </div>
        </form>
        
        <!-- Success message area -->
        <div class="text-center mt-12">
            <div class="inline-flex items-center bg-green-50 border border-green-200 rounded-2xl px-6 py-3 text-green-700">
                <i class="fas fa-shield-alt mr-3 text-green-600"></i>
                <span class="font-medium">Seus dados estão seguros conosco</span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Enhanced photos preview with drag and drop
    const photoInput = document.getElementById('photos');
    const uploadArea = document.getElementById('photo-upload-area');
    const uploadContent = document.getElementById('upload-content');
    const preview = document.getElementById('photos-preview');
    
    // Drag and drop functionality
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.classList.add('border-primary-500', 'bg-primary-100');
    });
    
    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('border-primary-500', 'bg-primary-100');
    });
    
    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('border-primary-500', 'bg-primary-100');
        
        const files = e.dataTransfer.files;
        const dt = new DataTransfer();
        for (let i = 0; i < files.length; i++) {
            dt.items.add(files[i]);
        }
        photoInput.files = dt.files;
        handlePhotoPreview(files);
    });
    
    photoInput.addEventListener('change', function(e) {
        console.log('Files selected:', e.target.files.length);
        handlePhotoPreview(e.target.files);
    });
    
    function handlePhotoPreview(files) {
        console.log('Handling photo preview for', files.length, 'files');
        preview.innerHTML = '';
        
        if (files.length > 0) {
            uploadContent.classList.add('hidden');
            preview.classList.remove('hidden');
            
            // Show file names for debugging
            const fileList = document.createElement('div');
            fileList.className = 'mb-4 text-sm text-gray-600';
            fileList.innerHTML = `<strong>Arquivos selecionados (${files.length}):</strong><br>`;
            Array.from(files).forEach((file, index) => {
                fileList.innerHTML += `${index + 1}. ${file.name} (${(file.size / 1024).toFixed(1)}KB)<br>`;
            });
            preview.appendChild(fileList);
            
            Array.from(files).slice(0, 5).forEach((file, index) => {
                console.log('Processing file', index + 1, ':', file.name, file.size, 'bytes');
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative group';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-32 object-cover rounded-2xl shadow-lg">
                        <div class="absolute top-2 left-2 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full text-xs font-medium text-gray-700">
                            ${index + 1}
                        </div>
                    `;
                    preview.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
            
            if (files.length >= 5) {
                const maxMessage = document.createElement('div');
                maxMessage.className = 'col-span-full text-center text-sm text-gray-500 mt-2';
                maxMessage.textContent = 'Máximo de 5 fotos atingido';
                preview.appendChild(maxMessage);
            }
        } else {
            uploadContent.classList.remove('hidden');
            preview.classList.add('hidden');
        }
    }
    

    
    // Enhanced phone mask
    document.getElementById('contact_phone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        
        if (value.length <= 11) {
            value = value.replace(/(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
        } else {
            value = value.substring(0, 11);
            value = value.replace(/(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
        }
        
        e.target.value = value;
    });
    
    // Character counter for description
    const descriptionTextarea = document.getElementById('description');
    const charCount = document.getElementById('char-count');
    
    descriptionTextarea.addEventListener('input', function() {
        const count = this.value.length;
        charCount.textContent = `${count}/500`;
        
        if (count > 400) {
            charCount.classList.add('text-red-500');
        } else {
            charCount.classList.remove('text-red-500');
        }
        
        if (count >= 500) {
            this.value = this.value.substring(0, 500);
            charCount.textContent = '500/500';
        }
    });
    
    // Form validation and progress
    const form = document.getElementById('pet-form');
    const submitBtn = document.getElementById('submit-btn');
    
    form.addEventListener('submit', function(e) {
        console.log('Form submitted with', photoInput.files.length, 'photos');
        
        // Show loading state
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Cadastrando...';
        submitBtn.disabled = true;
        
        // Basic validation
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('border-red-500');
            } else {
                field.classList.remove('border-red-500');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            submitBtn.innerHTML = '<i class="fas fa-heart mr-3"></i>Cadastrar Pet';
            submitBtn.disabled = false;
            
            // Show error message
            alert('Por favor, preencha todos os campos obrigatórios.');
        }
    });
    
    // Auto-save draft (localStorage)
    const formInputs = form.querySelectorAll('input, select, textarea');
    
    formInputs.forEach(input => {
        // Load saved data
        const savedValue = localStorage.getItem(`pet_form_${input.name}`);
        if (savedValue && !input.value) {
            input.value = savedValue;
        }
        
        // Save on change
        input.addEventListener('change', function() {
            localStorage.setItem(`pet_form_${this.name}`, this.value);
        });
    });
    
    // Clear draft on successful submit
    form.addEventListener('submit', function() {
        setTimeout(() => {
            formInputs.forEach(input => {
                localStorage.removeItem(`pet_form_${input.name}`);
            });
        }, 1000);
    });
</script>
@endpush
@endsection