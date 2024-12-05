<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="{{ asset('storage/asset/gambar/icon.png') }}">
        @stack('styles')
        @livewireStyles
        @vite(['resources/css/app.css'])
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>
        {{ $slot }}
        @livewireScripts
        @stack('scripts')
    </body>
</html>
