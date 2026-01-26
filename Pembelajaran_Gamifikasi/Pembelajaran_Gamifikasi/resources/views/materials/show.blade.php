<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $material->title }} - AKU DEV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    @include('components.navbar')

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('materials.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                    ← Kembali ke Daftar Materi
                </a>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="text-center mb-8">
                    <h1 class="text-3xl md:text-4xl font-bitter font-bold text-gray-900">{{ $material->title }}</h1>
                </div>

                <div class="prose prose-lg max-w-none text-gray-700">
                    {!! $material->content !!}
                </div>
            </div>
        </div>
    </div>
</body>

</html>