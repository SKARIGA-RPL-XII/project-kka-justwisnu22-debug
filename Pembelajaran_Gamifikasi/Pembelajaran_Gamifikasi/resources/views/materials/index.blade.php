<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar - AKU DEV</title>
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    @include('components.navbar')

    <div class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="text-4xl font-bitter font-bold text-center mb-4">Pilih Kategori Belajar</h1>
        <p class="text-center text-gray-600 mb-12">Mulai perjalanan belajarmu dari kategori yang kamu minati</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($categories as $category)
            <a href="{{ route('materials.category', $category->id) }}" 
               class="group bg-white rounded-xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <div class="text-center">
                    <div class="w-20 h-20 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center text-4xl">
                        @if($category->name == 'Front End Web') 🎨
                        @elseif($category->name == 'Back End Web') ⚙️
                        @elseif($category->name == 'UI/UX') 🎯
                        @elseif($category->name == 'Android') 📱
                        @else 📚
                        @endif
                    </div>
                    <h3 class="text-xl font-bitter font-bold mb-2">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-600 mb-4">{{ $category->levels->count() }} Tingkatan</p>
                    
                    @auth
                        @if(isset($category->progress_percentage))
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div class="bg-blue-600 h-2 rounded-full transition-all" style="width: {{ $category->progress_percentage }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500">{{ $category->progress_percentage }}% Selesai</p>
                        @endif
                    @endauth
                    
                    <div class="mt-4 text-blue-600 font-semibold group-hover:text-blue-700">
                        Mulai Belajar →
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</body>
</html>
