<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Livewire Admin App' }}</title>
    @vite('resources/css/app.css')
</head>
<body>
    <main class="bg-gray-300">
        {{ $slot }}
    </main>
</body>
</html>