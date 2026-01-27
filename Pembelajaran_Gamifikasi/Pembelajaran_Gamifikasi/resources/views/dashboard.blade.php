<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - AKU DEV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    @include('components.navbar')

    <div class="py-0">
        @if(session('success'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                document.querySelector('.fixed.top-4').remove();
            }, 3000);
        </script>
        @endif

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

        <!-- PROFILE CARD -->
        <section class="relative z-30 -mt-40">
            <div class="mx-auto max-w-[1320px]">
                <div class="flex items-center gap-6 bg-[#0B3B8F] rounded-2xl p-8 shadow-xl">


                    <!-- FOTO PROFIL -->
                    <div class="w-[120px] h-[120px] rounded-full bg-white flex items-center justify-center overflow-hidden">
                        <img src="/Images/dummy_user.png" alt="Profile"
                            class="w-full h-full object-cover">
                    </div>


                    <!-- INFO USER -->
                    <div class="flex-1 text-white">
                        <h2 class="text-3xl font-bitter mb-1">{{ Auth::user()->username }}</h2>
                        <p class="text-sm opacity-80 mb-3">Lv {{ Auth::user()->level }}</p>

                        @php
                            $currentLevelExp = (Auth::user()->level - 1) * 100;
                            $nextLevelExp = Auth::user()->level * 100;
                            $expInCurrentLevel = Auth::user()->exp - $currentLevelExp;
                            $expProgress = min(100, ($expInCurrentLevel / 100) * 100);
                        @endphp

                        <!-- XP BAR -->
                        <div class="w-full h-4 bg-white/30 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-green-400 to-lime-400 rounded-full transition-all duration-500" 
                                 style="width: {{ $expProgress }}%"></div>
                        </div>

                        <p class="text-sm mt-2 opacity-90">{{ $expInCurrentLevel }} / 100 XP</p>
                    </div>


                </div>
            </div>
        </section>

        <!-- Quest Section -->
        <section class="my-[50px]">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold font-bitter mb-6 text-black">Quest</h2>


                <div class="flex justify-center gap-4">
                    <button class="px-6 py-2 rounded-full bg-blue-600 text-white text-sm">Easy</button>
                    <button class="px-6 py-2 rounded-full bg-blue-100 text-blue-700 text-sm">Medium</button>
                    <button class="px-6 py-2 rounded-full bg-blue-100 text-blue-700 text-sm">Hard</button>
                </div>
            </div>

            <div class="mx-auto max-w-[1320px] pb-20">


                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @for ($i = 0; $i < 6; $i++)
                        <div class="bg-[#2259D0] rounded-2xl p-6 shadow-xl text-white transition
hover:-translate-y-2 hover:shadow-2xl">


                        <!-- TITLE + BADGE -->
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bitter text-2xl">Basic HTML</h3>
                            <span class="bg-[#0F172A] text-xs px-4 py-1 rounded-full">Easy</span>
                        </div>


                        <!-- DESKRIPSI -->
                        <p class="text-sm leading-relaxed opacity-90 mb-6 line-clamp-3">
                            Pelajari dasar-dasar HTML mulai dari struktur dokumen, penggunaan tag umum seperti heading,
                            paragraf, link, dan gambar, hingga pemahaman elemen dasar untuk Pelajari dasar-dasar HTML mulai dari struktur dokumen, penggunaan tag umum seperti heading,
                            paragraf, link, dan gambar, hingga pemahaman elemen dasar untuk
                        </p>


                        <!-- FOOTER -->
                        <div class="flex items-center justify-between">
                            <button
                                class="bg-[#093595] hover:bg-[#2f58af] transition px-6 py-2 rounded-full text-sm">
                                Mulai →
                            </button>


                            <span class="bg-white text-yellow-500 text-xs font-semibold px-4 py-2 rounded-full">
                                10 XP
                            </span>
                        </div>
                </div>
                @endfor
            </div>


            <!-- SEE MORE -->
            <div class="flex justify-center mt-14">
                <button class="px-10 py-3 rounded-full bg-[#2259D0] text-white text-sm transition hover:bg-[#3e6dd1]">
                    See More...
                </button>
            </div>


    </div>
    </section>

    <!-- Materi Section -->
    <section class="mb-[50px]">
        <div class="mx-auto max-w-[1320px] ">
            <!-- TITLE -->
            <h2 class="text-4xl font-bitter font-bold text-black text-center mb-[50px]">Materi</h2>

            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($materials as $material)
                <div class="bg-[#2457D6] text-white rounded-2xl p-8 shadow-xl transition hover:-translate-y-2 hover:shadow-2xl">
                    <!-- TITLE -->
                    <h3 class="font-bitter text-2xl mb-4">{{ $material->title }}</h3>

                    <!-- DESKRIPSI -->
                    <p class="text-sm leading-relaxed opacity-90 mb-8 line-clamp-3">{{ $material->description }}</p>

                    <!-- BUTTON -->
                    <a href="{{ route('materials.show', $material->id) }}" class="bg-[#0B3FAF] hover:bg-[#0A3797] transition px-6 py-2 rounded-full text-sm inline-block">
                        Lihat Detail →
                    </a>
                </div>
                @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-gray-500">Belum ada materi tersedia</p>
                </div>
                @endforelse
            </div>

            <!-- SEE MORE -->
            @if($materials->count() >= 6)
            <div class="flex justify-center mt-16">
                <a href="{{ route('materials.index') }}" class="px-10 py-3 rounded-full bg-blue-600 text-white text-sm hover:bg-blue-700 transition">
                    See More...
                </a>
            </div>
            @endif
        </div>
    </section>



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