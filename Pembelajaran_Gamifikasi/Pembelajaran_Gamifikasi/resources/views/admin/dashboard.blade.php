<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - AKU DEV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <nav class="bg-blue-600 text-white p-4">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold">Admin Panel</h1>
            <div class="flex items-center gap-4">
                <span>{{ Auth::user()->username }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 px-3 py-1 rounded">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="flex">
        <aside class="w-64 bg-white shadow-md min-h-screen">
            <nav class="p-4">
                <ul class="space-y-2">
                    <li><a href="{{ route('admin.dashboard') }}" class="block p-2 hover:bg-gray-100 rounded">Dashboard</a></li>
                    <li><a href="{{ route('admin.quiz.index') }}" class="block p-2 hover:bg-gray-100 rounded">Quiz</a></li>
                    <li><a href="{{ route('admin.materials.index') }}" class="block p-2 hover:bg-gray-100 rounded">Materi</a></li>
                    <li><a href="{{ route('admin.badges.index') }}" class="block p-2 hover:bg-gray-100 rounded">Badge</a></li>
                </ul>
            </nav>
        </aside>

        <main class="flex-1 p-6">
            <h2 class="text-2xl font-bold mb-6">Dashboard Admin</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Total Quiz</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $quizCount ?? 0 }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Total Materi</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $materialCount ?? 0 }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Total Badge</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ $badgeCount ?? 0 }}</p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>