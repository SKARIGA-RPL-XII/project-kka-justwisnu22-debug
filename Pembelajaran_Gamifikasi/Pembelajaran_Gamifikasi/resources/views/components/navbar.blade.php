<section class="bg-[#0F172A] w-full rounded-b-3xl z-10 relative">
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
                <a href="{{ route('welcome') }}" class="text-white font-lumanosimo hover:text-gray-300">Home</a>
                <a href="#" class="text-white font-lumanosimo hover:text-gray-300">Quest</a>
                <a href="#" class="text-white font-lumanosimo hover:text-gray-300">Belajar</a>
                <a href="#" class="text-white font-lumanosimo hover:text-gray-300">Badge</a>
            </nav>

            <!-- AUTH -->
            @auth
                <div class="flex items-center gap-3">
                    <span class="text-white font-montserrat">{{ Auth::user()->name }}</span>
                    <a href="{{ route('dashboard') }}" class="text-white font-montserrat px-4 py-2 rounded-lg hover:bg-white/10 transition">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-white font-montserrat px-4 py-2 rounded-lg hover:bg-white/10 transition">Logout</button>
                    </form>
                </div>
            @else
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="text-white font-montserrat px-4 py-2 rounded-lg hover:bg-white/10 transition">Login</a>
                    <a href="{{ route('register') }}" class="bg-white text-[#0F172A] font-montserrat px-4 py-2 rounded-lg font-semibold hover:bg-gray-200 transition">Daftar</a>
                </div>
            @endauth
        </div>
    </div>
</section>