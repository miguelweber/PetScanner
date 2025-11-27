@extends('layouts.app')

@section('title', 'Termos de Uso - PetScanner')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    
    <h1 class="text-4xl font-bold text-gradient mb-10">Termos de Uso do Sistema PetScanner</h1>

    <div class="bg-white/70 shadow-xl rounded-3xl p-8 leading-relaxed text-gray-800 space-y-6 border border-gray-100">

        <p>
            Este Termo de Uso (“Termo”) é um acordo legal entre você, o(a) usuário(a) 
            do sistema “PetScaner”, e os desenvolvedores do Projeto “PetScaner”, um 
            sistema destinado a cadastrar, organizar e acompanhar dados de animais 
            de estimação e seus tutores.
        </p>

        <p>
            Ao acessar ou utilizar o “PetScaner”, você manifesta sua concordância integral 
            com este Termo de Uso, com a Política de Privacidade e com a Lei Geral de 
            Proteção de Dados Pessoais (LGPD – Lei nº 13.709/2018).
        </p>

        <h2 class="text-2xl font-semibold text-primary-700">CLÁUSULA PRIMEIRA – Condições Gerais de Uso</h2>
        <p>
            O “PetScaner” é destinado a cadastrar informações de animais de estimação 
            e seus tutores, visando facilitar identificação, acompanhamento de saúde 
            e apoio em casos de perda ou emergência.
        </p>

        <h2 class="text-2xl font-semibold text-primary-700">CLÁUSULA SEGUNDA – Coleta e Uso de Dados Pessoais</h2>
        <ul class="list-disc pl-6 space-y-1">
            <li><strong>Dados do tutor:</strong> nome, CPF, telefone, e-mail, endereço.</li>
            <li><strong>Dados do animal:</strong> nome, espécie, raça, idade, sexo, histórico de saúde e vacinas.</li>
            <li><strong>Localização:</strong> endereço ou geolocalização opcional.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-primary-700">CLÁUSULA TERCEIRA – Finalidade da Coleta</h2>
        <ul class="list-disc pl-6 space-y-1">
            <li>Identificação dos animais e seus tutores;</li>
            <li>Auxílio em emergências ou perda do animal;</li>
            <li>Acompanhamento veterinário;</li>
            <li>Segurança e bem-estar dos animais.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-primary-700">CLÁUSULA QUARTA – Vedações do Uso</h2>
        <ul class="list-disc pl-6 space-y-1">
            <li>Inserir informações falsas;</li>
            <li>Carregar conteúdo ilegal ou ofensivo;</li>
            <li>Violar direitos autorais ou de terceiros.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-primary-700">CLÁUSULA SEXTA – Proteção dos Dados</h2>
        <ul class="list-disc pl-6 space-y-1">
            <li>Criptografia de arquivos;</li>
            <li>Banco de dados seguro com autenticação robusta;</li>
            <li>Planos de segurança e resposta a incidentes.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-primary-700">CLÁUSULA SÉTIMA – Compartilhamento de Dados</h2>
        <p>
            Os dados não serão compartilhados, exceto por obrigação legal, 
            ordem judicial ou suporte técnico necessário.
        </p>

        <h2 class="text-2xl font-semibold text-primary-700">CLÁUSULA OITAVA – Direitos do Usuário</h2>
        <ul class="list-disc pl-6 space-y-1">
            <li>Solicitar informações sobre o tratamento dos dados;</li>
            <li>Revogar consentimento;</li>
            <li>Solicitar exclusão da conta.</li>
        </ul>

        <p><strong>Contato:</strong> webercarvalhaes@gmail.com</p>

        <h2 class="text-2xl font-semibold text-primary-700">CLÁUSULA NONA – Encarregado de Dados (DPO)</h2>
        <p>
            Miguel Weber – DPO/Encarregado de Proteção de Dados.
        </p>

        <h2 class="text-2xl font-semibold text-primary-700">CLÁUSULA DÉCIMA QUINTA – Consentimento de Geolocalização</h2>
        <p>
            O(a) usuário(a) autoriza o uso opcional da geolocalização exclusivamente para:
        </p>
        <ul class="list-disc pl-6 space-y-1">
            <li>Auxílio em casos de perda ou resgate do animal;</li>
            <li>Identificação da última localização conhecida.</li>
        </ul>

        <p>
            O consentimento pode ser revogado a qualquer momento.
        </p>

    </div>

    <div class="mt-10 text-center">
        <a href="{{ route('home') }}" class="btn-primary">
            <i class="fas fa-arrow-left mr-2"></i>Voltar para a página inicial
        </a>
    </div>

</div>
@endsection
