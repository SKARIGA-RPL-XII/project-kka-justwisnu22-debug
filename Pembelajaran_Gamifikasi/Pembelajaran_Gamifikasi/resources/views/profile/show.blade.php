<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil - AKU DEV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    @include('components.navbar')

    <div class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-8 text-white">
                    <div class="flex items-center space-x-6">
                        <!-- Foto Profil -->
                        <div class="w-24 h-24 rounded-full bg-white flex items-center justify-center overflow-hidden">
                            @if($user->photo_profile)
                                <img src="{{ asset('storage/' . $user->photo_profile) }}" alt="Profile" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('Images/dummy_user.png') }}" alt="Profile" class="w-full h-full object-cover">
                            @endif
                        </div>
                        
                        <!-- Info User -->
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold mb-1">{{ $user->username }}</h1>
                            @if($user->title)
                                <p class="text-blue-100 text-sm mb-2">{{ $user->title }}</p>
                            @endif
                            <p class="text-blue-100 text-sm">Level {{ $user->level }}</p>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <!-- Progress EXP -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-700">Progress EXP</span>
                            @php
                                $currentLevelExp = ($user->level - 1) * 100;
                                $nextLevelExp = $user->level * 100;
                                $expInCurrentLevel = $user->exp - $currentLevelExp;
                                $expProgress = min(100, ($expInCurrentLevel / 100) * 100);
                            @endphp
                            <span class="text-sm text-gray-500">{{ $expInCurrentLevel }}/100 EXP</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-gradient-to-r from-green-400 to-blue-500 h-3 rounded-full transition-all duration-500" 
                                 style="width: {{ $expProgress }}%"></div>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 p-4 rounded-lg text-center">
                            <div class="text-2xl font-bold text-blue-600">{{ $user->level }}</div>
                            <div class="text-sm text-gray-600">Level</div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg text-center">
                            <div class="text-2xl font-bold text-green-600">{{ $user->exp }}</div>
                            <div class="text-sm text-gray-600">Total EXP</div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="text-center">
                        <a href="{{ route('profile.edit') }}" 
                           class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition-colors">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>