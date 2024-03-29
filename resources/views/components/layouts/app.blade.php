<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Bajara Bookstore Test' }}</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        <div class="bg-gray-300">
            @livewire('navigation')
            <div >
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
