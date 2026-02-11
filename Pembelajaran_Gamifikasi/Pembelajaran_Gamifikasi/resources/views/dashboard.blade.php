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

<div class="font-sans antialiased bg-gray-100">
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
    <section class="my-[50px]">
        <div class="mx-auto max-w-[1320px] ">
            <!-- TITLE -->
            <h2 class="text-4xl font-bitter font-bold text-black text-center mb-4">Pilih Kategori Belajar</h2>
            <p class="text-center text-gray-600 mb-12">Mulai perjalanan belajarmu dari kategori yang kamu minati</p>

            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($categories as $category)
                <a href="{{ route('materials.category', $category->id) }}" class="group bg-white rounded-xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center text-4xl">
                            @if($category->name == 'Front End Web') 🎨
                            @elseif($category->name == 'Back End Web') ⚙️
                            @elseif($category->name == 'UI/UX') 🎯
                            @elseif($category->name == 'Android') 📱
                            @else 📚
                            @endif
                        </div>
                        <h3 class="text-xl font-bitter font-bold mb-2">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-600 mb-4">{{ $category->levels->count() }} Tingkatan</p>
                        
                        <div class="mt-4 text-blue-600 font-semibold group-hover:text-blue-700">
                            Mulai Belajar →
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
            @if($categories->count() >= 6)
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
                        <li><a href="https://wa.me/6285855550057/" target="_blank" class=" font-montserrat hover:opacity-100">No. +62 858-5555-0057</a></li>
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
</div>
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