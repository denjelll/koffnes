<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @stack('styles')
        @vite(['resources/css/app.css', 'resources/js/bootstrap.js'])
        <title>{{ $title ?? 'Page Title' }}</title>
        @livewireStyles
    </head>
    <body>
        {{ $slot }}
        @livewireScripts
        @stack('scripts')
    </body>
</html>
