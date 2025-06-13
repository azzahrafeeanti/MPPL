<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'TapakAsa' }}</title>

        {{-- Include your CSS and JS files here --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Include any additional styles--}}
        @livewireStyles

    </head>
    
    <body>
        {{-- Main Content goes here --}}
        {{ $slot }}
        @livewireScripts
    </body>
</html>
