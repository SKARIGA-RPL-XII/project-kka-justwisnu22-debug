<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- VITE WAJIB DI SINI --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- <style>
        .navbar {
            background-color: #0F172A;
        }
    </style> -->
</head>

<body class="font-sans antialiased dark:text-white/50">
    <section class="bg-[#0F172A] w-full">
        <div class="mx-auto max-w-[1320px] py-6 flex justify-between items-center">
            <img src="aku_dev_logo-removebg-preview.png" alt="" class="w-[50px] h-[50px]">
            <div>
                <a href="#" class="text-white hover:text-gray-300 mx-2">Home</a>
                <a href="#" class="text-white hover:text-gray-300 mx-2">Quest</a></a>
                <a href="#" class="text-white hover:text-gray-300 mx-2">belajar</a>
                <a href="#" class="text-white hover:text-gray-300 mx-2">Badge</a>
            </div>
        </div>
    </section>
</body>

</html>