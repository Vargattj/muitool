<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.partials.meta')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-white min-h-screen">
    @include('layouts.partials.header')

    <main id="main-content">
        @yield('content')
    </main>


    @include('layouts.partials.footer')

<script>
function toggleLanguageMenu() {
    const menu = document.getElementById('language-menu');
    const arrow = document.getElementById('language-arrow');
    
    if (menu.classList.contains('hidden')) {
        menu.classList.remove('hidden');
        arrow.classList.add('rotate-180');
    } else {
        menu.classList.add('hidden');
        arrow.classList.remove('rotate-180');
    }
}

// Fechar o menu ao clicar fora
document.addEventListener('click', function(event) {
    const selector = document.getElementById('language-selector');
    const button = document.getElementById('language-button');
    const menu = document.getElementById('language-menu');
    
    if (selector && !selector.contains(event.target) && !menu.classList.contains('hidden')) {
        menu.classList.add('hidden');
        document.getElementById('language-arrow').classList.remove('rotate-180');
    }
});
</script>
</body>
</html>
