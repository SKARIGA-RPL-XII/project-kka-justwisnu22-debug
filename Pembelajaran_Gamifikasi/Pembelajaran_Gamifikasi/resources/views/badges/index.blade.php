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
<body class="font-sans antialiased bg-gray-100">
    @include('components.navbar')

    <div class="container mx-auto px-4 py-8">
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
</body>
</html>