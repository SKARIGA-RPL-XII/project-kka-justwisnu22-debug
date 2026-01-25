<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />

    {{-- VITE WAJIB DI SINI --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased dark:text-white/50">
    <!-- Navbar -->
    <section class="bg-[#0F172A] w-full rounded-b-3xl">
        <div class="mx-auto max-w-[1320px] px-6 py-4 flex justify-between items-center">
            <!-- LEFT: LOGO -->
            <div class="flex items-center gap-3">
                <img src="/images/aku_dev_logo-removebg-preview.png" alt="Aku Dev" class="w-[70px]">
                <div class="font-lumanosimo text-3xl text-white">AKU DEV</div>
            </div>


            <!-- RIGHT: MENU + AUTH -->
            <div class="flex items-center gap-6">
                <!-- MENU -->
                <nav class="flex items-center gap-5">
                    <a href="#" class="text-white font-lumanosimo hover:text-gray-300">Home</a>
                    <a href="#" class="text-white font-lumanosimo hover:text-gray-300">Quest</a>
                    <a href="#" class="text-white font-lumanosimo hover:text-gray-300">Belajar</a>
                    <a href="#" class="text-white font-lumanosimo hover:text-gray-300">Badge</a>
                </nav>


                <!-- AUTH (BELUM LOGIN) -->
                <div class="flex items-center gap-3">
                    <a href="#"
                        class="text-white font-montserrat px-4 py-2 rounded-lg hover:bg-white/10 transition">
                        Login
                    </a>
                    <a href="#"
                        class="bg-white text-[#0F172A] font-montserrat px-4 py-2 rounded-lg font-semibold hover:bg-gray-200 transition">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Banner -->
    <section class="banner">
    <div class="h-[400px] bg-[url('/images/baner.jpg')] bg-cover bg-center bg-no-repeat"></div>
    </section>
</body>

</html>