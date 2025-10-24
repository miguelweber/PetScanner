@extends('layouts.app')

@section('title', 'Editar ' . $pet->name . ' - PetScanner')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Editar {{ $pet->name }}</h1>
        <p class="text-gray-600">Atualize as informações do seu pet</p>
    </div>

    <form method="POST" action="{{ route('pets.update', $pet) }}" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')
        
        <!-- Pet Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-paw mr-2 text-purple-600"></i>
                Informações do Pet
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nome do Pet <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $pet->name) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('name') border-red-500 @enderror"
                           placeholder="Ex: Buddy, Luna, Max...">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Species -->
                <div>
                    <label for="species" class="block text-sm font-medium text-gray-700 mb-2">
                        Espécie <span class="text-red-500">*</span>
                    </label>
                    <select id="species" name="species" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('species') border-red-500 @enderror">
                        <option value="">Selecione a espécie</option>
                        <option value="cachorro" {{ old('species', $pet->species) == 'cachorro' ? 'selected' : '' }}>Cachorro</option>
                        <option value="gato" {{ old('species', $pet->species) == 'gato' ? 'selected' : '' }}>Gato</option>
                        <option value="coelho" {{ old('species', $pet->species) == 'coelho' ? 'selected' : '' }}>Coelho</option>
                        <option value="hamster" {{ old('species', $pet->species) == 'hamster' ? 'selected' : '' }}>Hamster</option>
                        <option value="passaro" {{ old('species', $pet->species) == 'passaro' ? 'selected' : '' }}>Pássaro</option>
                        <option value="outro" {{ old('species', $pet->species) == 'outro' ? 'selected' : '' }}>Outro</option>
                    </select>
                    @error('species')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Breed -->
                <div class="md:col-span-2">
                    <label for="breed" class="block text-sm font-medium text-gray-700 mb-2">
                        Raça (opcional)
                    </label>
                    <input type="text" id="breed" name="breed" value="{{ old('breed', $pet->breed) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('breed') border-red-500 @enderror"
                           placeholder="Ex: Labrador, Persa, SRD (Sem Raça Definida)...">
                    @error('breed')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Photo -->
                <div class="md:col-span-2">
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">
                        Foto do Pet
                    </label>
                    
                    @if($pet->photo)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Foto atual:</p>
                            <img src="{{ url('storage/' . $pet->photo) }}" alt="{{ $pet->name }}" 
                                 class="h-32 w-32 object-cover rounded-lg">
                        </div>
                    @endif
                    
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-purple-400 transition-colors">
                        <div class="space-y-1 text-center">
                            <div id="photo-preview" class="hidden mb-4">
                                <img id="preview-image" class="mx-auto h-32 w-32 object-cover rounded-lg">
                            </div>
                            <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-3"></i>
                            <div class="flex text-sm text-gray-600">
                                <label for="photo" class="relative cursor-pointer bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-purple-500">
                                    <span>{{ $pet->photo ? 'Alterar foto' : 'Clique para fazer upload' }}</span>
                                    <input id="photo" name="photo" type="file" class="sr-only" accept="image/*">
                                </label>
                                <p class="pl-1">ou arraste e solte</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF até 2MB</p>
                        </div>
                    </div>
                    @error('photo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Descrição
                    </label>
                    <textarea id="description" name="description" rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('description') border-red-500 @enderror"
                              placeholder="Conte um pouco sobre a personalidade, cuidados especiais, histórico do pet...">{{ old('description', $pet->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Location -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-map-marker-alt mr-2 text-purple-600"></i>
                Localização
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- City -->
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                        Cidade <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="city" name="city" value="{{ old('city', $pet->city) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('city') border-red-500 @enderror"
                           placeholder="Ex: São Paulo, Rio de Janeiro...">
                    @error('city')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- State -->
                <div>
                    <label for="state" class="block text-sm font-medium text-gray-700 mb-2">
                        Estado <span class="text-red-500">*</span>
                    </label>
                    <select id="state" name="state" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('state') border-red-500 @enderror">
                        <option value="">Selecione o estado</option>
                        <option value="AC" {{ old('state', $pet->state) == 'AC' ? 'selected' : '' }}>Acre</option>
                        <option value="AL" {{ old('state', $pet->state) == 'AL' ? 'selected' : '' }}>Alagoas</option>
                        <option value="AP" {{ old('state', $pet->state) == 'AP' ? 'selected' : '' }}>Amapá</option>
                        <option value="AM" {{ old('state', $pet->state) == 'AM' ? 'selected' : '' }}>Amazonas</option>
                        <option value="BA" {{ old('state', $pet->state) == 'BA' ? 'selected' : '' }}>Bahia</option>
                        <option value="CE" {{ old('state', $pet->state) == 'CE' ? 'selected' : '' }}>Ceará</option>
                        <option value="DF" {{ old('state', $pet->state) == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                        <option value="ES" {{ old('state', $pet->state) == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                        <option value="GO" {{ old('state', $pet->state) == 'GO' ? 'selected' : '' }}>Goiás</option>
                        <option value="MA" {{ old('state', $pet->state) == 'MA' ? 'selected' : '' }}>Maranhão</option>
                        <option value="MT" {{ old('state', $pet->state) == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                        <option value="MS" {{ old('state', $pet->state) == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                        <option value="MG" {{ old('state', $pet->state) == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                        <option value="PA" {{ old('state', $pet->state) == 'PA' ? 'selected' : '' }}>Pará</option>
                        <option value="PB" {{ old('state', $pet->state) == 'PB' ? 'selected' : '' }}>Paraíba</option>
                        <option value="PR" {{ old('state', $pet->state) == 'PR' ? 'selected' : '' }}>Paraná</option>
                        <option value="PE" {{ old('state', $pet->state) == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                        <option value="PI" {{ old('state', $pet->state) == 'PI' ? 'selected' : '' }}>Piauí</option>
                        <option value="RJ" {{ old('state', $pet->state) == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                        <option value="RN" {{ old('state', $pet->state) == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                        <option value="RS" {{ old('state', $pet->state) == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                        <option value="RO" {{ old('state', $pet->state) == 'RO' ? 'selected' : '' }}>Rondônia</option>
                        <option value="RR" {{ old('state', $pet->state) == 'RR' ? 'selected' : '' }}>Roraima</option>
                        <option value="SC" {{ old('state', $pet->state) == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                        <option value="SP" {{ old('state', $pet->state) == 'SP' ? 'selected' : '' }}>São Paulo</option>
                        <option value="SE" {{ old('state', $pet->state) == 'SE' ? 'selected' : '' }}>Sergipe</option>
                        <option value="TO" {{ old('state', $pet->state) == 'TO' ? 'selected' : '' }}>Tocantins</option>
                    </select>
                    @error('state')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-phone mr-2 text-purple-600"></i>
                Informações de Contato
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Email -->
                <div class="md:col-span-2">
                    <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">
                        E-mail para Contato <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', $pet->contact_email) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('contact_email') border-red-500 @enderror"
                           placeholder="seu@email.com">
                    @error('contact_email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="md:col-span-2">
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">
                        Telefone/WhatsApp <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $pet->contact_phone) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('contact_phone') border-red-500 @enderror"
                           placeholder="(11) 99999-9999">
                    @error('contact_phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contact Preferences -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        Como prefere ser contatado?
                    </label>
                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="phone_accepts_calls" value="1" 
                                   {{ old('phone_accepts_calls', $pet->phone_accepts_calls) ? 'checked' : '' }}
                                   class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                            <span class="ml-2 text-sm text-gray-700">
                                <i class="fas fa-phone mr-2 text-green-500"></i>
                                Aceito ligações telefônicas
                            </span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="phone_accepts_whatsapp" value="1" 
                                   {{ old('phone_accepts_whatsapp', $pet->phone_accepts_whatsapp) ? 'checked' : '' }}
                                   class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                            <span class="ml-2 text-sm text-gray-700">
                                <i class="fab fa-whatsapp mr-2 text-green-500"></i>
                                Aceito mensagens no WhatsApp
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-between items-center">
            <a href="{{ route('pets.show', $pet) }}" 
               class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 transition-colors font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Cancelar
            </a>
            
            <button type="submit" 
                    class="bg-purple-600 text-white px-8 py-3 rounded-lg hover:bg-purple-700 transition-colors font-semibold">
                <i class="fas fa-save mr-2"></i>Salvar Alterações
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Photo preview
    document.getElementById('photo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
                document.getElementById('photo-preview').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    // Phone mask
    document.getElementById('contact_phone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        value = value.replace(/(\d{2})(\d)/, '($1) $2');
        value = value.replace(/(\d{5})(\d)/, '$1-$2');
        e.target.value = value;
    });
</script>
@endpush
@endsection