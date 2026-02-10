<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} - AKU DEV</title>
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    @include('components.navbar')

    <div class="max-w-5xl mx-auto px-4 py-12">
        <a href="{{ route('materials.index') }}" class="text-blue-600 hover:text-blue-700 mb-6 inline-block">
            ← Kembali ke Kategori
        </a>

        <h1 class="text-4xl font-bitter font-bold mb-2">{{ $category->name }}</h1>
        <p class="text-gray-600 mb-8">Ikuti langkah-langkah pembelajaran secara berurutan</p>

        <div class="space-y-4">
            @foreach($category->levels as $level)
            @php
                $status = $userProgress[$level->id] ?? 'locked';
                $isLocked = $status === 'locked';
            @endphp
            
            <div class="bg-white rounded-xl shadow-md p-6 {{ $isLocked ? 'opacity-60' : '' }}">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-2xl
                            {{ $status === 'completed' ? 'bg-green-100' : ($status === 'ongoing' ? 'bg-blue-100' : 'bg-gray-100') }}">
                            @if($status === 'completed') ✅
                            @elseif($status === 'ongoing') 📖
                            @else 🔒
                            @endif
                        </div>
                        
                        <div class="flex-1">
                            <h3 class="text-xl font-bitter font-bold">{{ $level->title }}</h3>
                            <div class="flex items-center gap-3 mt-1">
                                <span class="text-sm px-3 py-1 rounded-full
                                    {{ $level->difficulty->name === 'Dasar' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $level->difficulty->name === 'Pemula' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $level->difficulty->name === 'Menengah' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $level->difficulty->name === 'Mahir' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ $level->difficulty->name }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    @if($status === 'completed') Selesai
                                    @elseif($status === 'ongoing') Sedang Belajar
                                    @else Terkunci
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    @if(!$isLocked)
                    <a href="{{ route('materials.show', [$category->id, $level->id]) }}" 
                       class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        {{ $status === 'completed' ? 'Lihat Lagi' : 'Mulai' }}
                    </a>
                    @else
                    <button disabled class="px-6 py-3 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">
                        Terkunci
                    </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>
