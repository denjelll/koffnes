<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @stack('styles')
        @vite(['resources/css/app.css'])
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>
        {{ $slot }}
        @livewireScripts
        @vite(['resources/js/bootstrap.js'])
        @stack('scripts')
    </body>
</html>
