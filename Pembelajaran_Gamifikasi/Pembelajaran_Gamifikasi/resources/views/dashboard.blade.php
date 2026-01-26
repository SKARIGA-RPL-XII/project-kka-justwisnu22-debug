<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - AKU DEV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    @include('components.navbar')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bitter font-bold mb-6">Dashboard</h1>
                    <p class="text-lg mb-4">Selamat datang, {{ Auth::user()->name }}!</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <div class="bg-blue-500 text-white p-6 rounded-lg">
                            <h3 class="text-xl font-semibold mb-2">Quest Completed</h3>
                            <p class="text-3xl font-bold">0</p>
                        </div>
                        <div class="bg-green-500 text-white p-6 rounded-lg">
                            <h3 class="text-xl font-semibold mb-2">Total XP</h3>
                            <p class="text-3xl font-bold">0</p>
                        </div>
                        <div class="bg-purple-500 text-white p-6 rounded-lg">
                            <h3 class="text-xl font-semibold mb-2">Level</h3>
                            <p class="text-3xl font-bold">1</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>