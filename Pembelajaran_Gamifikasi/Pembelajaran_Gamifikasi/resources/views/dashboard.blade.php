<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - AKU DEV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased ">
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
        <div class="bg-gradient-to-b from-[#F4F7FF] via-white to-[#F4F7FF]"></div>
    </div>

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
            <div class="flex items-center gap-6 bg-[linear-gradient(90deg,#093595_32%,#03112F_100%)] rounded-2xl p-8 shadow-xl">


                <!-- Foto Profil -->
                <div class="w-24 h-24 rounded-full bg-white overflow-hidden ring-4 ring-blue-500/20">
                    @if(Auth::user()->photo_profile)
                    <img
                        src="{{ route('profile.photo', Auth::id()) }}"
                        alt="Profile"
                        class="w-full h-full object-cover">
                    @else
                    <img
                        src="{{ asset('Images/dummy_user.png') }}"
                        alt="Profile"
                        class="w-full h-full object-cover">
                    @endif
                </div>



                <!-- INFO USER -->
                <div class="flex-1 text-white">
                    <h2 class="text-3xl font-bitter mb-1">{{ Auth::user()->username }}</h2>
                    @if(Auth::user()->title)
                    <p class="text-sm opacity-80 mb-1">{{ Auth::user()->title }}</p>
                    @endif
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

    <!-- Materi Section -->
    <section class="mt-[50px] pb-[50px]">
        <div class="mx-auto max-w-[1320px] ">
            <!-- TITLE -->
            <h2 class="text-4xl font-bitter font-bold text-black text-center mb-4">Pilih Kategori Belajar</h2>
            <p class="text-center text-gray-600 mb-12">Mulai perjalanan belajarmu dari kategori yang kamu minati</p>

            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($categories as $category)
                <a href="{{ route('materials.category', $category->id) }}" class="group bg-white rounded-xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center overflow-hidden">
                            <img src="{{ $category->foto_kategori ? route('category.photo', $category->id) : asset('images/no_image.jpg') }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-xl font-bitter font-bold mb-2">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-600 mb-4">{{ $category->levels->count() }} Tingkatan</p>

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
                @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-gray-500">Belum ada kategori tersedia</p>
                </div>
                @endforelse
            </div>

            <!-- SEE MORE -->
            @if($totalCategories > 6)
            <div class="flex justify-center mt-16">
                <a href="{{ route('materials.index') }}">
                    <button class="cursor-pointer bg-gradient-to-b from-blue-500 to-[#093595] shadow-[0px_4px_32px_0_rgba(99,102,241,.70)] px-6 py-3 rounded-xl text-white font-medium group">
                        <div class="relative overflow-hidden">
                            <p class="group-hover:-translate-y-7 duration-[1.125s] ease-[cubic-bezier(0.19,1,0.22,1)]">See More . . .</p>
                            <p class="absolute top-7 left-0 group-hover:top-0 duration-[1.125s] ease-[cubic-bezier(0.19,1,0.22,1)]">See More . . .</p>
                        </div>
                    </button>
                </a>
            </div>
            @endif
        </div>
    </section>

    <!-- Section ABOUT US -->
    <section class="py-[50px] my-[30px] bg-gray-100">
        <div class="mx-auto max-w-[1320px] ">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">

                <div class="md:col-span-4">
                    <div class="our-story rounded-xl">
                        <div><img class="h-[275px] w-full object-cover" src="{{ asset('images/mockup1.png') }}" alt=""></div>
                        <div><img class="h-[275px] w-full object-cover" src="{{ asset('images/story2.jpg') }}" alt=""></div>
                    </div>
                </div>

                <div class="md:col-span-8 ">
                    <div class="ml-5">
                        <h1 class="font-bold text-3xl font-lumanosimo pb-4">Our Story</h1>
                        <p class="font-montserrat text-justify pb-8">Aku Dev lahir dari keresahan banyak pemula yang ingin belajar coding namun bingung harus mulai dari mana. Materi yang tersebar dan tidak terstruktur sering membuat proses belajar menjadi tidak efektif dan mudah terhenti di tengah jalan.
                            <br>
                            <br>
                            Untuk itu, Aku Dev hadir dengan alur pembelajaran yang terarah, menggabungkan materi dan . . .
                        </p>
                        <button
                            onclick="window.location='{{ route('about') }}'"
                            class="group relative w-auto cursor-pointer overflow-hidden rounded-full border border-gray-200 bg-white px-5 py-2 text-center font-medium text-gray-900 shadow-sm transition-all duration-300 hover:shadow-md dark:border-gray-800 dark:bg-gray-950 dark:text-white dark:hover:border-gray-700">
                            <div class="flex items-center gap-3">
                                <div
                                    class="h-2 w-2 rounded-full bg-gray-900 transition-all duration-300 group-hover:scale-[100.8] dark:bg-white"></div>
                                <span
                                    class="inline-block transition-all duration-300 group-hover:translate-x-12 group-hover:opacity-0">
                                    See More
                                </span>
                            </div>

                            <div
                                class="absolute top-0 z-10 flex h-full w-full translate-x-12 items-center justify-center gap-3 bg-gray-900 text-white opacity-0 transition-all duration-300 group-hover:-translate-x-5 group-hover:opacity-100 dark:bg-gray-100 dark:text-gray-900">
                                <div class="flex items-center gap-3 whitespace-nowrap">
                                    <span class="leading-none font-medium">See More</span>

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 leading-none"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2.5"
                                        aria-hidden="true">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 12h14"></path>
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M13 6l6 6-6 6"></path>
                                    </svg>
                                </div>
                            </div>
                        </button>

                    </div>
                </div>

            </div>
        </div>
    </section>


    <div class="h-[50px] scale-y-[-1] mb-[-50px]"
        style="background-image: url('/images/pemisah.png');">
    </div>
    @include('components.footer')
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $('.our-story').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });
</script>
<script>
    function filterQuiz(category) {
        const cards = document.querySelectorAll('.quiz-card');
        const buttons = document.querySelectorAll('.category-btn');

        // Update button styles
        buttons.forEach(btn => {
            btn.classList.remove('bg-blue-600', 'text-white', 'active');
            btn.classList.add('bg-blue-100', 'text-blue-700');
        });

        event.target.classList.remove('bg-blue-100', 'text-blue-700');
        event.target.classList.add('bg-blue-600', 'text-white', 'active');

        // Filter cards
        cards.forEach(card => {
            if (category === 'all' || card.dataset.category === category) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
</body>

</html>