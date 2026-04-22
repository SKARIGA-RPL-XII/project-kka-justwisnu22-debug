<div id="navbar-wrapper" style="height: var(--navbar-h)"></div>
<section id="main-navbar" class="bg-[#0F172A] w-full rounded-b-3xl z-50 relative">
    <div class="mx-auto max-w-[1320px]  py-4 flex justify-between items-center">
        <!-- LEFT: LOGO -->
        <div class="flex items-center gap-3">
            <img src="/images/aku_dev_logo-removebg-preview.png" alt="Aku Dev" class="w-[70px]">
            <div class="font-lumanosimo text-3xl text-white">AKUDEV</div>
        </div>

        <!-- RIGHT: MENU + AUTH -->
        <div class="flex items-center gap-6">
            <!-- MENU -->
            <nav class="flex items-center gap-5">
                <a href="{{ Auth::check() ? route('dashboard') : route('welcome') }}" class="text-white font-lumanosimo transition duration-300 hover:text-gray-300">Home</a>
                <a href="{{ route('about') }}" class="text-white font-lumanosimo transition duration-300 hover:text-gray-300">About Us</a>
                <a href="{{ route('materials.index') }}" class="text-white font-lumanosimo transition duration-300 hover:text-gray-300">Belajar</a>
                @auth
                <a href="{{ route('badges.index') }}" class="text-white font-lumanosimo transition duration-300 hover:text-gray-300">Badge</a>
                @else
                <a href="{{ route('badges.guest') }}" class="text-white font-lumanosimo transition duration-300 hover:text-gray-300">Badge</a>
                @endauth
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
                    <form method="POST" action="{{ route('logout') }}" id="logout-form-user">
                        @csrf
                        <button type="button" onclick="document.getElementById('logoutModalUser').classList.remove('hidden')" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">Logout</button>
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

<!-- Login Modal -->
<div id="loginModal" class="fixed inset-0 hidden z-[100] flex items-center justify-center bg-[#03112F]/80 backdrop-blur-sm">
    <div class="bg-white/95 rounded-2xl shadow-2xl w-full max-w-md mx-4 p-8 relative">
        <button onclick="closeLoginModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700">✕</button>
        <h2 class="text-3xl font-bold text-center text-[#03112F] mb-2">Welcome Back</h2>
        <p class="text-center text-gray-500 text-sm mb-8">Masuk ke akun AKU DEV</p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="space-y-4">
                @if($errors->has('email'))
                <div class="p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">{{ $errors->first('email') }}</div>
                @endif
                @if($errors->has('password'))
                <div class="p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">{{ $errors->first('password') }}</div>
                @endif
                <input type="email" name="email" placeholder="Email" required class="w-full px-4 py-3 text-black rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:outline-none">
                <input type="password" name="password" placeholder="Password" required class="w-full px-4 py-3 text-black rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:outline-none">
                <button type="submit" class="w-full py-3 rounded-lg text-white font-semibold bg-gradient-to-r from-[#093595] to-[#03112F] hover:opacity-90 transition">Login</button>
                <p class="text-center text-sm text-gray-600 mt-4">Belum punya akun? <button type="button" onclick="closeLoginModal(); openRegisterModal();" class="text-blue-600 hover:underline font-semibold">Daftar!</button></p>
            </div>
        </form>
    </div>
</div>

<!-- Register Modal -->
<div id="registerModal" class="fixed inset-0 hidden z-[100] flex items-center justify-center bg-[#03112F]/80 backdrop-blur-sm">
    <div class="bg-white/95 rounded-2xl shadow-2xl w-full max-w-md mx-4 p-8 relative">
        <button onclick="closeRegisterModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700">✕</button>
        <h2 class="text-3xl font-bold text-center text-[#03112F] mb-2">Create Account</h2>
        <p class="text-center text-gray-500 text-sm mb-8">Mulai perjalanan belajarmu 🚀</p>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="space-y-4">
                <input type="text" name="username" placeholder="Username" required class="w-full px-4 py-3 text-black rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:outline-none">
                <input type="email" name="email" placeholder="Email" required class="w-full px-4 py-3 text-black rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:outline-none">
                <input type="password" name="password" placeholder="Password" required class="w-full px-4 py-3 text-black rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:outline-none">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required class="w-full px-4 py-3 text-black rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:outline-none">
                <button type="submit" class="w-full py-3 rounded-lg text-white font-semibold bg-gradient-to-r from-[#093595] to-[#03112F] hover:opacity-90 transition">Daftar</button>
                <p class="text-center text-sm text-gray-600 mt-4">Sudah punya akun? <button type="button" onclick="closeRegisterModal(); openLoginModal();" class="text-blue-600 hover:underline font-semibold">Login!</button></p>
            </div>
        </form>
    </div>
</div>

<!-- Logout Modal User -->
<div id="logoutModalUser" class="fixed inset-0 hidden z-[200] flex items-center justify-center bg-[#03112F]/80 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm mx-4 p-8 text-center">
        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Konfirmasi Logout</h3>
        <p class="text-gray-500 text-sm mb-6">Apakah kamu yakin ingin keluar dari akun ini?</p>
        <div class="flex gap-3 justify-center">
            <button onclick="document.getElementById('logoutModalUser').classList.add('hidden')" class="px-6 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition font-medium">Batal</button>
            <button onclick="document.getElementById('logout-form-user').submit()" class="px-6 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white transition font-medium">Ya, Logout</button>
        </div>
    </div>
</div>

<script>
    function openLoginModal() { document.getElementById('loginModal').classList.remove('hidden'); }
    function closeLoginModal() { document.getElementById('loginModal').classList.add('hidden'); }
    function openRegisterModal() { document.getElementById('registerModal').classList.remove('hidden'); }
    function closeRegisterModal() { document.getElementById('registerModal').classList.add('hidden'); }
    @if(isset($errors) && $errors->any() && !auth()->check())
    document.addEventListener('DOMContentLoaded', function() { openLoginModal(); });
    @endif
</script>

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