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
                        <h2 class="text-3xl font-bitter mb-1">Profile</h2>
                        <p class="text-sm opacity-80 mb-3">Lv 1</p>


                        <!-- XP BAR -->
                        <div class="w-full h-4 bg-white/30 rounded-full overflow-hidden">
                            <div class="h-full w-[50%] bg-gradient-to-r from-green-400 to-lime-400 rounded-full"></div>
                        </div>


                        <p class="text-sm mt-2 opacity-90">50 / 100 XP</p>
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
                @for ($i = 0; $i < 6; $i++)
                    <div
                    class="bg-[#2457D6] text-white rounded-2xl p-8 shadow-xl transition
hover:-translate-y-2 hover:shadow-2xl">


                    <!-- TITLE -->
                    <h3 class="font-bitter text-2xl mb-4">
                        Materi HTML Dasar
                    </h3>


                    <!-- DESKRIPSI -->
                    <p class="text-sm leading-relaxed opacity-90 mb-8 line-clamp-3">
                        Materi HTML dasar yang membahas konsep awal pembuatan website,
                        seperti struktur dokumen, penggunaan tag, dan elemen penting
                        pada halaman web ...
                    </p>


                    <!-- BUTTON -->
                    <button
                        class="bg-[#0B3FAF] hover:bg-[#0A3797] transition
px-6 py-2 rounded-full text-sm">
                        Mulai →
                    </button>
            </div>
            @endfor
        </div>


        <!-- SEE MORE -->
        <div class="flex justify-center mt-16">
            <button
                class="px-10 py-3 rounded-full bg-blue-600 text-white text-sm
hover:bg-blue-700 transition">
                See More...
            </button>
        </div>


        </div>
    </section>

    </div>
</body>

</html>