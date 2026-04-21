<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Badges - AKU DEV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    @include('components.navbar')

    <!-- Banner -->
    <section>
        <div class="relative top-[-20px] z-0 h-[400px] bg-cover bg-center bg-no-repeat"
            style="background-image: url('/images/baner.jpg');">
            <div class="absolute inset-0 bg-[#03112F]/60 flex flex-col items-center justify-center">
                <h1 class="text-5xl font-lumanosimo text-white mb-3">Achievement Badges</h1>
                <p class="text-white/80 font-montserrat text-lg">Kumpulkan badge dengan mencapai level tertentu!</p>
            </div>
        </div>
    </section>
    <div class="relative top-[-65px] w-full h-[45px]" style="background-image: url('/images/pemisah.png')"></div>

    <!-- Login prompt banner -->
    <div class="max-w-7xl mx-auto px-4 mb-6">
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <p class="font-montserrat font-semibold text-[#03112F]">Login untuk melacak badge yang sudah kamu raih!</p>
                <p class="font-montserrat text-sm text-gray-500">Daftar gratis dan mulai kumpulkan badge sekarang.</p>
            </div>
            <div class="flex gap-3">
                <button onclick="openLoginModal()" class="bg-gradient-to-r from-[#093595] to-[#03112F] text-white font-montserrat font-semibold px-5 py-2 rounded-lg hover:opacity-90 transition">Login</button>
                <button onclick="openRegisterModal()" class="bg-white border border-[#03112F] text-[#03112F] font-montserrat font-semibold px-5 py-2 rounded-lg hover:bg-gray-100 transition">Daftar</button>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-4">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Achievement Badges</h1>
            <p class="text-gray-600">Kumpulkan badge dengan mencapai level tertentu!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($badges as $badge)
                <div class="rounded-lg shadow-md p-6 bg-white border border-gray-200 relative overflow-hidden">
                    <!-- Locked overlay -->
                    <div class="absolute inset-0 bg-white/60 backdrop-blur-[2px] flex flex-col items-center justify-center z-10">
                        <svg class="w-10 h-10 text-gray-400 mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-sm font-montserrat text-gray-500 mb-3">Login untuk melihat progress</p>
                        <button onclick="openLoginModal()" class="bg-gradient-to-r from-[#093595] to-[#03112F] text-white text-xs font-semibold px-4 py-1.5 rounded-lg hover:opacity-90 transition">Login</button>
                    </div>

                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $badge->reward_title }}</h3>
                        <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2"><span class="font-medium">{{ $badge->title }}</span></p>
                        <p class="text-sm text-gray-500">Syarat: Mencapai Level {{ $badge->level_requirement }}</p>
                    </div>
                    <div class="text-sm text-gray-400">— / {{ $badge->level_requirement }}</div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-400 text-6xl mb-4">🏆</div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Badge</h3>
                    <p class="text-gray-500">Badge akan segera tersedia. Pantau terus ya!</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="h-[50px] scale-y-[-1] mt-12" style="background-image: url('/images/pemisah.png');"></div>
    @include('components.footer')
</body>
</html>
