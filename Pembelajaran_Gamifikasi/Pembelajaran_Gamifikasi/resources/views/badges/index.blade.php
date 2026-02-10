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
    <section class="banner">
        <div
            class="relative top-[-20px] z-0 h-[500px] bg-cover bg-center bg-no-repeat"
            style="background-image: url('/images/baner.jpg');">
            <!-- OVERLAY -->
            <div class="absolute inset-0 bg-[#1552D8]/40"></div>
        </div>

    </section>
    <div class="relative top-[-65px] w-full h-[45px] " style="background-image: url('/images/pemisah.png')"></div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Achievement Badges</h1>
            <p class="text-gray-600">Kumpulkan badge dengan mencapai level tertentu!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($badges as $badge)
                @php
                    $userLevel = Auth::user()->level;
                    $hasEarned = $userLevel >= $badge->level_requirement;
                    $isOwned = in_array($badge->id, $userBadges);
                @endphp
                
                <div class="rounded-lg shadow-md p-6 transition-all duration-300 {{ $hasEarned ? 'bg-green-50 border-2 border-green-200' : 'bg-white border border-gray-200' }}">
                    <!-- Header with title and icon -->
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-semibold {{ $hasEarned ? 'text-green-800' : 'text-gray-800' }}">
                            {{ $badge->reward_title }}
                        </h3>
                        <div class="flex-shrink-0">
                            @if($hasEarned)
                                <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                        </div>
                    </div>

                    <!-- Badge info -->
                    <div class="mb-4">
                        <p class="text-sm {{ $hasEarned ? 'text-green-700' : 'text-gray-600' }} mb-2">
                            <span class="font-medium">{{ $badge->title }}</span>
                        </p>
                        <p class="text-sm {{ $hasEarned ? 'text-green-600' : 'text-gray-500' }}">
                            Syarat: Mencapai Level {{ $badge->level_requirement }}
                        </p>
                    </div>

                    <!-- Status -->
                    <div class="flex justify-between items-center">
                        <div class="text-sm">
                            @if($hasEarned)
                                <span class="text-green-600 font-semibold">✓ Terbuka</span>
                            @else
                                <span class="text-gray-500">Level {{ $userLevel }}/{{ $badge->level_requirement }}</span>
                            @endif
                        </div>
                        
                        @if($hasEarned)
                            <a href="{{ route('profile.edit') }}" class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600 transition">
                                Konfigurasi Title
                            </a>
                        @endif
                    </div>
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
    <div
        class="relative bottom-[-50px] h-[50px] scale-y-[-1]"
        style="background-image: url('/images/pemisah.png');">
    </div>
    <!-- Footer -->
    <footer class="bg-[#0F172A] text-white pt-[80px] pb-8">
        <div class="max-w-7xl mx-auto">

            <!-- GRID FOOTER -->
            <div class="grid grid-cols-12 gap-8">

                <!-- COL 1 (4/12) -->
                <div class="col-span-12 md:col-span-4">
                    <img src="/images/aku_dev_logo-removebg-preview.png" alt="" class="w-[100px]">
                    <h3 class="text-xl font-lumanosimo font-semibold mb-4">Dari Nol Jadi Developer Handal</h3>

                </div>

                <!-- COL 2 (2/12) -->
                <div class="col-span-6 md:col-span-2">
                    <h4 class="text-sm font-bitter font-semibold mb-4">Link</h4>
                    <ul class="space-y-2 text-sm opacity-80">
                        <li><a href="#" class="font-montserrat hover:opacity-100">Home</a></li>
                        <li><a href="#" class="font-montserrat hover:opacity-100">Quest</a></li>
                        <li><a href="#" class="font-montserrat hover:opacity-100">Belajar</a></li>
                        <li><a href="#" class="font-montserrat hover:opacity-100">Badge</a></li>
                        <li><a href="#" class="font-montserrat hover:opacity-100">About Us</a></li>
                    </ul>
                </div>

                <!-- COL 3 (2/12) -->
                <div class="col-span-6 md:col-span-2">
                    <h4 class="text-sm font-bitter font-semibold mb-4">Our Contact</h4>
                    <ul class="space-y-2 text-sm opacity-80">
                        <li><a href="#" class="font-montserrat hover:opacity-100">No. +62 858-5555-0057</a></li>
                        <li><a href="#" class="font-montserrat hover:opacity-100">Email: akudev@gmail.com</a></li>
                        <li><a href="#" class="font-montserrat hover:opacity-100">Instagram: AkuDev_</a></li>
                    </ul>
                </div>

                <!-- COL 4 (4/12) -->
                <div class="col-span-12 md:col-span-4">
                    <h4 class="text-sm font-bitter font-semibold mb-4">Our Location</h4>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d246.9950363968931!2d112.58121981308561!3d-7.903365759255451!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sid!2sid!4v1769363353465!5m2!1sid!2sid" width="300" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>

            <!-- DIVIDER -->
            <div class="border-t border-white/10 mt-12 pt-6 text-center text-sm opacity-70">
                © 2026 Aku Dev. All rights reserved.
            </div>

        </div>
    </footer>
</body>
</html>