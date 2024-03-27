<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bajara Bookstore Test</title>

        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-300">

        <nav class="font-sans flex flex-col text-center sm:flex-row sm:text-left sm:justify-between py-4 px-6 bg-white shadow sm:items-baseline w-full">
        <div class="mb-2 sm:mb-0">
            <a href="/" class="text-2xl no-underline text-grey-darkest hover:text-blue-dark" wire:navigate>Home</a>
        </div>
        <div>
            <a href="/login" class="text-lg no-underline text-grey-darkest hover:text-blue-dark ml-2" wire:navigate>Login</a>
            <a href="/register" class="text-lg no-underline text-grey-darkest hover:text-blue-dark ml-2" wire:navigate>Register</a>
        </div>
        </nav>
        <h1 class="text-3xl font-bold underline">
            Bajara Book Store
        </h1>
    </body>
</html>
