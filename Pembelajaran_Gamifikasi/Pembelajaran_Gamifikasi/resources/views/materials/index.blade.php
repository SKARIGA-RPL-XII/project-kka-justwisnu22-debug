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

    <!-- Banner -->
    <section>
        <div class="relative top-[-20px] z-0 h-[400px] bg-cover bg-center bg-no-repeat"
            style="background-image: url('/images/baner.jpg');">
            <div class="absolute inset-0 bg-[#03112F]/60 flex flex-col items-center justify-center">
                <h1 class="text-5xl font-lumanosimo text-white mb-3">Belajar</h1>
                <p class="text-white/80 font-montserrat text-lg">Mulai perjalanan belajarmu dari kategori yang kamu minati</p>
            </div>
        </div>
    </section>
    <div class="relative top-[-65px] w-full h-[45px]" style="background-image: url('/images/pemisah.png')"></div>

    <div class="max-w-7xl mx-auto py-12">
        <h1 class="text-4xl font-bitter font-bold text-center mb-4">Pilih Kategori Belajar</h1>
        <p class="text-center text-gray-600 mb-12">Mulai perjalanan belajarmu dari kategori yang kamu minati</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
            <a href="{{ route('materials.category', $category->id) }}"
                class="group bg-white rounded-xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <div class="text-center">
                    <div class="w-20 h-20 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center overflow-hidden">
                        <img src="{{ $category->foto_kategori ? route('category.photo', $category->id) : asset('images/no_image.jpg') }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
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

                   <div class="mt-4 text-blue-600 font-semibold group relative inline-block cursor-pointer">
    
    <span>Mulai Belajar →</span>

    <span class="absolute left-0 -bottom-1 h-[2px] w-full bg-blue-600
        scale-x-0 origin-left
        transition-transform duration-300 ease-in-out
        group-hover:scale-x-100
        group-hover:origin-left">
    </span>

</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <div class="h-[50px] scale-y-[-1] mt-12"
        style="background-image: url('/images/pemisah.png');">
    </div>
    @include('components.footer')
</body>

</html>