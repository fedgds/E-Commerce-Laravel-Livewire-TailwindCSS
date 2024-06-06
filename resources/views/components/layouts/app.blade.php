<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'ShopWise' }}</title>
        <link rel="icon" href="/img/title.png" type="image/png">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-rose-100 dark:bg-slate-700">
        @livewire('section.navbar')
        <main>
            {{ $slot }}
        </main>
        @livewire('section.footer')
        
        @livewireScripts
        
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <x-livewire-alert::scripts />
    </body>
</html>
