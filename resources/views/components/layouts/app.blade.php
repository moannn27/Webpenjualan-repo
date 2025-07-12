<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Platinum Computer' }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/preline@1.0.0/dist/preline.min.css">
         <script src="https://cdn.jsdelivr.net/npm/preline@1.0.0/dist/preline.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-slate-200 dark:bg-slate-700">
        @livewire('partials.navbar')
        <main>
        {{ $slot }}
        </main>
        @livewire('partials.footer')
        @livewireScripts
    </body>

</html>
