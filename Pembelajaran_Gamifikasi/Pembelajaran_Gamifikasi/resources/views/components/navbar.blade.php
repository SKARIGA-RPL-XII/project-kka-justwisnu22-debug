<div id="navbar-wrapper" style="height: var(--navbar-h)"></div>
<section id="main-navbar" class="bg-[#0F172A] w-full rounded-b-3xl z-50 relative">
    <div class="mx-auto max-w-[1320px]  py-4 flex justify-between items-center">
        <!-- LEFT: LOGO -->
        <div class="flex items-center gap-3">
            <img src="/images/aku_dev_logo-removebg-preview.png" alt="Aku Dev" class="w-[70px]">
            <div class="font-lumanosimo text-3xl text-white">AKU DEV</div>
        </div>

        <!-- RIGHT: MENU + AUTH -->
        <div class="flex items-center gap-6">
            <!-- MENU -->
            <nav class="flex items-center gap-5">
                <a href="{{ Auth::check() ? route('dashboard') : route('welcome') }}" class="text-white font-lumanosimo hover:text-gray-300">Home</a>
                <a href="{{ route('materials.index') }}" class="text-white font-lumanosimo hover:text-gray-300">Belajar</a>
                <a href="{{ route('badges.index') }}" class="text-white font-lumanosimo hover:text-gray-300">Badge</a>
            </nav>

            <!-- AUTH -->
            @auth
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center gap-2 text-white px-3 py-2 rounded-lg hover:bg-white/10 transition">
                    @if(Auth::user()->photo_profile)
                    <img src="{{ route('profile.photo', Auth::id()) }}"
                        class="w-8 h-8 rounded-full object-cover">
                    @else
                    <img src="{{ asset('Images/dummy_user.png') }}"
                        class="w-8 h-8 rounded-full">
                    @endif

                    <span class="font-lumanosimo">{{ Auth::user()->username }}</span>
                    <svg :class="{'rotate-180': open}" class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- DROPDOWN -->
                <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg py-2 z-50">
                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Lihat Profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
            @else
            <div class="flex items-center gap-3">
                <button onclick="openLoginModal()" class="text-white font-montserrat px-4 py-2 rounded-lg hover:bg-white/10 transition">Login</button>
                <button onclick="openRegisterModal()" class="bg-white text-[#0F172A] font-montserrat px-4 py-2 rounded-lg font-semibold hover:bg-gray-200 transition">Daftar</button>
            </div>
            @endauth
        </div>
    </div>
</section>

<!-- Pastikan AlpineJS sudah di-load -->
<script src="//unpkg.com/alpinejs" defer></script>

<script>
    (function () {
        const navbar = document.getElementById('main-navbar');
        const wrapper = document.getElementById('navbar-wrapper');

        function setNavbarHeight() {
            document.documentElement.style.setProperty('--navbar-h', navbar.offsetHeight + 'px');
        }

        function onScroll() {
            const isFixed = navbar.classList.contains('fixed');
            // Titik trigger: posisi top wrapper relatif ke dokumen
            const triggerY = wrapper.getBoundingClientRect().top + window.scrollY;

            if (window.scrollY >= triggerY) {
                if (!isFixed) {
                    setNavbarHeight();
                    navbar.classList.remove('relative');
                    navbar.classList.add('fixed', 'top-0', 'left-0', 'right-0');
                    wrapper.style.display = 'block';
                }
            } else {
                if (isFixed) {
                    navbar.classList.remove('fixed', 'top-0', 'left-0', 'right-0');
                    navbar.classList.add('relative');
                    wrapper.style.display = 'none';
                }
            }
        }

        setNavbarHeight();
        wrapper.style.display = 'none';
        window.addEventListener('scroll', onScroll, { passive: true });
    })();
</script>