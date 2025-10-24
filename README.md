# 🐾 PetScanner - Plataforma de Adoção de Pets

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-red.svg" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue.svg" alt="PHP Version">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-cyan.svg" alt="TailwindCSS">
  <img src="https://img.shields.io/badge/Status-Production%20Ready-green.svg" alt="Status">
</p>

## Sobre o Projeto

O **PetScanner** é uma plataforma moderna e intuitiva para conectar pets que precisam de um lar com famílias que desejam adotar. Desenvolvida com Laravel, a plataforma oferece uma experiência única tanto para quem quer adotar quanto para quem precisa encontrar um lar para seu pet.

## Autores
Turma **3B2**

- Miguel Weber      (12300632@aluno.cotemig.com.br) [Portfólio](https://github.com/miguelweber)
- Matheus Arcanjo   (22300759@aluno.cotemig.com.br)
- Maria Luiza Penna (22300384@aluno.cotemig.com.br)
- Maria Clara       (22301135@aluno.cotemig.com.br)
- Júlia Marcussi  (22301097@aluno.cotemig.com.br)
- Lucas Gabriel   (22301232@aluno.cotemig.com.br)

## Características Principais

### Funcionalidades
- **Sistema de autenticação** completo com registro e login
- **Upload múltiplo de fotos** para cada pet (até 5 imagens)
- **Geolocalização automática** via IP para priorizar pets locais
- **Sistema de busca avançada** por espécie, cidade e palavras-chave
- **Painel administrativo** para moderação de conteúdo
- **Perfis de usuário** com gerenciamento de pets
- **Sistema de contato** via email e WhatsApp
- **Galeria de fotos** com navegação por teclado

### 🛡️ Segurança e Privacidade
- **Validação robusta** de dados
- **Proteção CSRF** em todos os formulários
- **Sanitização de uploads** de imagem
- **Conformidade com LGPD** através de funcionalidades de edição/exclusão
- **Controle de acesso** baseado em roles

## 🚀 Tecnologias Utilizadas

- **Backend**: Laravel
- **Frontend**: TailwindCSS + JavaScript Vanilla
- **Database**: SQLite (desenvolvimento) / MySQL (produção)
- **Fontes**: Poppins (Google Fonts)
- **Icones**: Font Awesome 6.5
- **Processamento de imagens**: Intervention Image
- **Geolocalização**: IP-API.com

## 🎯 Páginas Principais

### 🏠 Homepage
- **Hero section** com busca avançada
- **Grid de pets** com cards modernos
- **Estatísticas animadas** da plataforma
- **Call-to-action** para cadastro

### 🐕 Detalhes do Pet
- **Galeria de fotos** com thumbnails
- **Informações completas** do pet
- **Botões de contato** (email/WhatsApp)
- **Pets similares** na mesma cidade
- **Compartilhamento social**

### 📝 Cadastro de Pet
- **Formulário em etapas** com indicador de progresso
- **Upload drag-and-drop** de múltiplas fotos
- **Validação em tempo real**
- **Salvamento automático** em localStorage

### 🔐 Autenticação
- **Login/Registro** com design moderno
- **Validação de senha** com indicador de força
- **Opções de login social** (preparado para Google/Facebook)
- **Recuperação de senha**

### 👑 Painel Admin
- **Dashboard** com estatísticas em tempo real
- **Gerenciamento de pets** com ações em lote
- **Controles de moderação**
- **Configurações do sistema**

## Instalação e Configuração

1. **Instale as dependências**
```bash
git
composer
php
php-sqlite3
```

2. **Clone o repositório**
```bash
git clone https://github.com/miguelweber/PetScanner.git
cd PetScanner
```

3. **Configure o ambiente**
```bash
./setup
```

4. **Inicie o servidor**
```bash
./run
```

--
Desenvolvido com ❤️ para ajudar pets a encontrarem um lar.

