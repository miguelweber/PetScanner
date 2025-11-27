@extends('layouts.app')

@section('title', 'Política de Privacidade – PetScanner')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">

    <h1 class="text-4xl font-bold text-gradient mb-8">Política de Privacidade</h1>

    <div class="bg-white/80 shadow-xl rounded-3xl p-8 leading-relaxed text-gray-800 space-y-8 border border-gray-100">

        <p>
            Esta Política de Privacidade explica como o <strong>PetScanner</strong> coleta, utiliza, 
            trata e protege os dados pessoais de seus usuários, em conformidade com a 
            <strong>Lei Geral de Proteção de Dados Pessoais (LGPD – Lei nº 13.709/2018)</strong>.
        </p>

        <h2 class="text-2xl font-semibold text-primary-700">1. Dados Coletados</h2>

        <p>O PetScanner coleta apenas os dados necessários para funcionamento da plataforma:</p>

        <h3 class="text-lg font-semibold">1.1. Dados de Cadastro do Usuário</h3>
        <ul class="list-disc pl-6 space-y-1">
            <li>Nome completo</li>
            <li>E-mail</li>
            <li>Senha (criptografada)</li>
            <li>Telefone (opcional)</li>
        </ul>

        <h3 class="text-lg font-semibold">1.2. Dados dos Pets</h3>
        <ul class="list-disc pl-6 space-y-1">
            <li>Nome, espécie, raça, idade e sexo;</li>
            <li>Características físicas e observações;</li>
            <li>Até 5 fotos por pet;</li>
            <li><strong>Localização aproximada do pet anunciando (armazenada)</strong> — utilizada para que outros usuários encontrem pets próximos.</li>
        </ul>

        <h3 class="text-lg font-semibold">1.3. Dados de Geolocalização do Usuário</h3>
        <p>
            Durante a navegação, o PetScanner pode solicitar permissão para acessar sua 
            geolocalização com a finalidade de <strong>mostrar pets próximos a você</strong>.  
        </p>
        <p class="font-semibold text-primary-700">
            ✔️ Esta localização NÃO é armazenada <br>
            ✔️ É usada apenas enquanto você navega no site
        </p>

        <h2 class="text-2xl font-semibold text-primary-700">2. Finalidades do Tratamento dos Dados</h2>
        <ul class="list-disc pl-6 space-y-1">
            <li>Criar e gerenciar sua conta no sistema;</li>
            <li>Exibir pets próximos ao usuário via geolocalização temporária;</li>
            <li>Divulgar pets anunciados com sua localização aproximada;</li>
            <li>Garantir segurança e prevenção contra fraudes;</li>
            <li>Enviar notificações relevantes (opcional);</li>
            <li>Melhorar a experiência do usuário na plataforma.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-primary-700">3. Bases Legais (LGPD)</h2>
        <p>O tratamento é realizado com base nos seguintes fundamentos legais:</p>
        <ul class="list-disc pl-6 space-y-1">
            <li><strong>Consentimento</strong> – geolocalização para pets próximos;</li>
            <li><strong>Execução de contrato</strong> – uso da plataforma e anúncios de pets;</li>
            <li><strong>Legítimo interesse</strong> – segurança, prevenção a fraudes e melhorias;</li>
            <li><strong>Cumprimento de obrigação legal</strong> – quando aplicável.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-primary-700">4. Compartilhamento de Dados</h2>
        <p>
            O PetScanner <strong>não vende, compartilha ou repassa</strong> dados pessoais a terceiros, 
            exceto nos seguintes casos:
        </p>
        <ul class="list-disc pl-6 space-y-1">
            <li>Obrigação legal ou ordem judicial;</li>
            <li>Suporte técnico necessário ao funcionamento do sistema;</li>
            <li>Parceiros estritamente necessários (ex: serviços de hospedagem).</li>
        </ul>

        <h2 class="text-2xl font-semibold text-primary-700">5. Armazenamento e Segurança</h2>
        <p>Adotamos medidas de segurança como:</p>
        <ul class="list-disc pl-6 space-y-1">
            <li>Criptografia de senhas;</li>
            <li>Banco de dados com acesso restrito;</li>
            <li>HTTPS e comunicação segura;</li>
            <li>Políticas de segurança da informação.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-primary-700">6. Retenção dos Dados</h2>
        <ul class="list-disc pl-6 space-y-1">
            <li>Dados de cadastro: enquanto a conta estiver ativa;</li>
            <li>Dados de pets anunciados: enquanto o anúncio estiver publicado;</li>
            <li>Logs de segurança: por tempo limitado e necessário;</li>
            <li><strong>Geolocalização temporária do usuário: não armazenada</strong>.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-primary-700">7. Direitos do Usuário</h2>
        <p>De acordo com a LGPD, você pode:</p>
        <ul class="list-disc pl-6 space-y-1">
            <li>Solicitar acesso aos seus dados;</li>
            <li>Solicitar correção de dados incompletos;</li>
            <li>Revogar consentimento;</li>
            <li>Pedir exclusão de sua conta;</li>
            <li>Solicitar portabilidade dos dados;</li>
            <li>Obter informações sobre compartilhamento.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-primary-700">8. DPO / Encarregado de Dados</h2>
        <p>
            O responsável pelo tratamento de dados no PetScanner é:  
            <strong>Miguel Weber – DPO</strong><br>
            Contato: <a href="mailto:webercarvalhaes@gmail.com" class="text-primary-600 underline">webercarvalhaes@gmail.com</a>
        </p>

        <h2 class="text-2xl font-semibold text-primary-700">9. Cookies</h2>
        <p>
            O PetScanner utiliza cookies essenciais para funcionamento do sistema e
            cookies de sessão para manter o login ativo.  
            Não utilizamos cookies de publicidade.
        </p>

        <h2 class="text-2xl font-semibold text-primary-700">10. Atualizações desta Política</h2>
        <p>
            Esta Política de Privacidade poderá ser atualizada periodicamente. A última 
            atualização será sempre indicada nesta página.
        </p>

        <p class="text-gray-600 text-sm">
            Última atualização: {{ date('d/m/Y') }}
        </p>

    </div>

    <div class="mt-10 text-center">
        <a href="{{ route('home') }}" class="btn-primary">
            <i class="fas fa-arrow-left mr-2"></i>Voltar para a página inicial
        </a>
    </div>

</div>
@endsection
