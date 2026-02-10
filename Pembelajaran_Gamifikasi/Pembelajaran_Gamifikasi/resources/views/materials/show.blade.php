<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $level->title }} - AKU DEV</title>
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    @include('components.navbar')

    <div class="max-w-4xl mx-auto px-4 py-12">
        <a href="{{ route('materials.category', $level->category_id) }}" class="text-blue-600 hover:text-blue-700 mb-6 inline-block">
            ← Kembali ke {{ $level->category->name }}
        </a>

        <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
            <h1 class="text-3xl font-bitter font-bold mb-2">{{ $level->title }}</h1>
            <span class="inline-block px-3 py-1 rounded-full text-sm
                {{ $level->difficulty->name === 'Dasar' ? 'bg-green-100 text-green-700' : '' }}
                {{ $level->difficulty->name === 'Pemula' ? 'bg-blue-100 text-blue-700' : '' }}
                {{ $level->difficulty->name === 'Menengah' ? 'bg-yellow-100 text-yellow-700' : '' }}
                {{ $level->difficulty->name === 'Mahir' ? 'bg-red-100 text-red-700' : '' }}">
                {{ $level->difficulty->name }}
            </span>

            @if($material)
            <div class="prose max-w-none mt-6">
                {!! $material->content !!}
            </div>
            @else
            <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <p class="text-yellow-800">Materi untuk level ini belum tersedia.</p>
            </div>
            @endif
        </div>

        @if($quiz)
        <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-6 text-center">
            <h2 class="text-2xl font-bitter font-bold mb-2">📝 Quiz</h2>
            <p class="text-gray-600 mb-4">Uji pemahamanmu dengan mengerjakan quiz</p>
            <a href="{{ route('quiz.show', [$level->category_id, $level->id]) }}" 
               class="inline-block px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                Mengerjakan Quiz →
            </a>
        </div>
        @else
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 text-center">
            <p class="text-gray-500">Quiz untuk level ini belum tersedia.</p>
        </div>
        @endif
    </div>
</body>
</html>