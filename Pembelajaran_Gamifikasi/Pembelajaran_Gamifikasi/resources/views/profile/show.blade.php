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

        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Header -->
                <div class="bg-[linear-gradient(90deg,#093595_32%,#03112F_100%)] px-6 py-8 text-white">
                    <div class="flex items-center space-x-6">
                        <!-- Foto Profil -->
                        <div class="w-24 h-24 rounded-full bg-white flex items-center justify-center overflow-hidden">
                            @if(!empty($user->photo_profile))
                            <img src="{{ route('profile.photo', $user->id) }}"
                                class="w-32 h-32 rounded-full object-cover mx-auto">

                            @else
                            <img
                                src="{{ asset('Images/dummy_user.png') }}"
                                alt="Profile"
                                class="w-full h-full object-cover">
                            @endif
                        </div>

                        <!-- Info User -->
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold mb-1">{{ $user->username }}</h1>
                            @if($user->title)
                            <p class="text-blue-100 text-sm mb-2">{{ $user->title }}</p>
                            @else
                            <p class="text-blue-100 text-sm mb-2 opacity-60">Belum ada title</p>
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