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
    <script>
        window.isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
    </script>
    
    @include('components.navbar')

    <!-- Login Modal -->
    <div id="loginModal" class="fixed inset-0 hidden z-50 flex items-center justify-center bg-[#03112F]/80 backdrop-blur-sm">
        <div class="bg-white/95 rounded-2xl shadow-2xl w-full max-w-md mx-4 p-8 relative">

            <!-- Close -->
            <button onclick="closeLoginModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700">
                ✕
            </button>

            <!-- Title -->
            <h2 class="text-3xl font-bold text-center text-[#03112F] mb-2">Welcome Back</h2>
            <p class="text-center text-gray-500 text-sm mb-8">Masuk ke akun AKU DEV</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="space-y-4">
                    <div class="[--clr:#1f1f1f] dark:[--clr:#999999] relative flex flex-row items-center">
  <input
    value=""
    name="email"
    required=""
    aria-invalid="false"
    placeholder=""
    spellcheck="false"
    autocomplete="off"
    id="email"
    type="email"
    class="peer text-black pl-2 h-[40px] min-h-[40px] pr-[40px] leading-normal appearance-none resize-none box-border text-base w-full block text-left border border-solid bg-white rounded-[10px] m-0 p-0 outline-0 focus-visible:outline-0 focus-visible:border-[#1e40af] focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-[#1e40af2e]"
  />

  <label
    class="cursor-text text-[--clr] inline-block z-0 text-sm mb-px font-normal text-start select-none absolute duration-300 transform origin-[0] translate-x-[32px]
           peer-focus-visible:text-[#1e40af]
           peer-[:not(:placeholder-shown)]:text-[#1e40af]
           peer-focus-visible:translate-x-[8px]
           peer-[:not(:placeholder-shown)]:translate-x-[8px]
           peer-focus-visible:translate-y-[-36px]
           peer-[:not(:placeholder-shown)]:translate-y-[-36px]"
    for="email"
  >
    Email
  </label>

  <span
    class="pointer-events-none absolute z-[+1] left-0 top-0 bottom-0 flex items-center justify-center size-[40px] text-gray-500 peer-focus-visible:hidden peer-[:not(:placeholder-shown)]:hidden"
  >
    <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" stroke-linejoin="round" stroke-linecap="round" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor">
      <path fill="none" d="M0 0h24v24H0z" stroke="none"></path>
      <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
      <path d="M16 12v1.5a2.5 2.5 0 0 0 5 0v-1.5a9 9 0 1 0 -5.5 8.28"></path>
    </svg>
  </span>

  <div
    class="group w-[40px] absolute top-0 bottom-0 right-0 flex items-center justify-center text-gray-500 peer-focus-visible:text-[#1e40af]"
  >
    <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" stroke-linejoin="round" stroke-linecap="round" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor">
      <path fill="none" d="M0 0h24v24H0z" stroke="none"></path>
      <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
      <path d="M12 8v4"></path>
      <path d="M12 16h.01"></path>
    </svg>

    <span
      class="text-sm absolute cursor-default select-none rounded-[4px] px-1.5 bg-[#1e40af] text-white opacity-0 right-0 -z-10 transition-all duration-300 group-hover:opacity-100 group-hover:-translate-y-[calc(100%+18px)]"
    >
      Required!
    </span>
  </div>
</div>


                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                        class="w-full px-4 py-3 text-black rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:outline-none">

                    <button
                        type="submit"
                        class="w-full py-3 rounded-lg text-white font-semibold bg-gradient-to-r from-[#093595] to-[#03112F] hover:opacity-90 transition">
                        Login
                    </button>
                    
                    <p class="text-center text-sm text-gray-600 mt-4">
                        Belum punya akun? <button type="button" onclick="closeLoginModal(); openRegisterModal();" class="text-blue-600 hover:underline font-semibold">Daftar!</button>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Register Modal -->
    <div id="registerModal" class="fixed inset-0 hidden z-50 flex items-center justify-center bg-[#03112F]/80 backdrop-blur-sm">
        <div class="bg-white/95 rounded-2xl shadow-2xl w-full max-w-md mx-4 p-8 relative">

            <!-- Close -->
            <button onclick="closeRegisterModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700">
                ✕
            </button>

            <!-- Title -->
            <h2 class="text-3xl font-bold text-center text-[#03112F] mb-2">Create Account</h2>
            <p class="text-center text-gray-500 text-sm mb-8">Mulai perjalanan belajarmu 🚀</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="space-y-6">
                    <div class="[--clr:#1f1f1f] dark:[--clr:#999999] relative flex flex-row items-center">
                        <input value="" name="username" required="" aria-invalid="false" placeholder="" spellcheck="false" autocomplete="off" id="username" type="text" class="peer text-black pl-2 h-[40px] min-h-[40px] pr-[40px] leading-normal appearance-none resize-none box-border text-base w-full block text-left border border-solid bg-white rounded-[10px] m-0 p-0 outline-0 focus-visible:outline-0 focus-visible:border-[#1e40af] focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-[#1e40af2e]" />
                        <label class="cursor-text text-[--clr] inline-block z-0 text-sm mb-px font-normal text-start select-none absolute duration-300 transform origin-[0] translate-x-[32px] peer-focus-visible:text-[#1e40af] peer-[:not(:placeholder-shown)]:text-[#1e40af] peer-focus-visible:translate-x-[8px] peer-[:not(:placeholder-shown)]:translate-x-[8px] peer-focus-visible:translate-y-[-36px] peer-[:not(:placeholder-shown)]:translate-y-[-36px]" for="username">Username</label>
                        <span class="pointer-events-none absolute z-[+1] left-0 top-0 bottom-0 flex items-center justify-center size-[40px] text-gray-500 peer-focus-visible:hidden peer-[:not(:placeholder-shown)]:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor"><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path><path d="M16 12v1.5a2.5 2.5 0 0 0 5 0v-1.5a9 9 0 1 0 -5.5 8.28"></path></svg>
                        </span>
                        <div class="group w-[40px] absolute top-0 bottom-0 right-0 flex items-center justify-center text-gray-500 peer-focus-visible:text-[#1e40af]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor"><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path><path d="M12 8v4"></path><path d="M12 16h.01"></path></svg>
                            <span class="text-sm absolute cursor-default select-none rounded-[4px] px-1.5 bg-[#1e40af] text-white opacity-0 right-0 -z-10 transition-all duration-300 group-hover:opacity-100 group-hover:-translate-y-[calc(100%+18px)]">Required!</span>
                        </div>
                    </div>

                    <div class="[--clr:#1f1f1f] dark:[--clr:#999999] relative flex flex-row items-center">
                        <input value="" name="email" required="" aria-invalid="false" placeholder="" spellcheck="false" autocomplete="off" id="register-email" type="email" class="peer text-black pl-2 h-[40px] min-h-[40px] pr-[40px] leading-normal appearance-none resize-none box-border text-base w-full block text-left border border-solid bg-white rounded-[10px] m-0 p-0 outline-0 focus-visible:outline-0 focus-visible:border-[#1e40af] focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-[#1e40af2e]" />
                        <label class="cursor-text text-[--clr] inline-block z-0 text-sm mb-px font-normal text-start select-none absolute duration-300 transform origin-[0] translate-x-[32px] peer-focus-visible:text-[#1e40af] peer-[:not(:placeholder-shown)]:text-[#1e40af] peer-focus-visible:translate-x-[8px] peer-[:not(:placeholder-shown)]:translate-x-[8px] peer-focus-visible:translate-y-[-36px] peer-[:not(:placeholder-shown)]:translate-y-[-36px]" for="register-email">Email</label>
                        <span class="pointer-events-none absolute z-[+1] left-0 top-0 bottom-0 flex items-center justify-center size-[40px] text-gray-500 peer-focus-visible:hidden peer-[:not(:placeholder-shown)]:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor"><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path><path d="M16 12v1.5a2.5 2.5 0 0 0 5 0v-1.5a9 9 0 1 0 -5.5 8.28"></path></svg>
                        </span>
                        <div class="group w-[40px] absolute top-0 bottom-0 right-0 flex items-center justify-center text-gray-500 peer-focus-visible:text-[#1e40af]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor"><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path><path d="M12 8v4"></path><path d="M12 16h.01"></path></svg>
                            <span class="text-sm absolute cursor-default select-none rounded-[4px] px-1.5 bg-[#1e40af] text-white opacity-0 right-0 -z-10 transition-all duration-300 group-hover:opacity-100 group-hover:-translate-y-[calc(100%+18px)]">Required!</span>
                        </div>
                    </div>

                    <div class="[--clr:#1f1f1f] dark:[--clr:#999999] relative flex flex-row items-center">
                        <input value="" name="password" required="" aria-invalid="false" placeholder="" spellcheck="false" autocomplete="off" id="register-password" type="password" class="peer text-black pl-2 h-[40px] min-h-[40px] pr-[40px] leading-normal appearance-none resize-none box-border text-base w-full block text-left border border-solid bg-white rounded-[10px] m-0 p-0 outline-0 focus-visible:outline-0 focus-visible:border-[#1e40af] focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-[#1e40af2e]" />
                        <label class="cursor-text text-[--clr] inline-block z-0 text-sm mb-px font-normal text-start select-none absolute duration-300 transform origin-[0] translate-x-[32px] peer-focus-visible:text-[#1e40af] peer-[:not(:placeholder-shown)]:text-[#1e40af] peer-focus-visible:translate-x-[8px] peer-[:not(:placeholder-shown)]:translate-x-[8px] peer-focus-visible:translate-y-[-36px] peer-[:not(:placeholder-shown)]:translate-y-[-36px]" for="register-password">Password</label>
                        <span class="pointer-events-none absolute z-[+1] left-0 top-0 bottom-0 flex items-center justify-center size-[40px] text-gray-500 peer-focus-visible:hidden peer-[:not(:placeholder-shown)]:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor"><path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"></path><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path><path d="M8 11v-4a4 4 0 1 1 8 0v4"></path></svg>
                        </span>
                        <div class="group w-[40px] absolute top-0 bottom-0 right-0 flex items-center justify-center text-gray-500 peer-focus-visible:text-[#1e40af]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor"><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path><path d="M12 8v4"></path><path d="M12 16h.01"></path></svg>
                            <span class="text-sm absolute cursor-default select-none rounded-[4px] px-1.5 bg-[#1e40af] text-white opacity-0 right-0 -z-10 transition-all duration-300 group-hover:opacity-100 group-hover:-translate-y-[calc(100%+18px)]">Required!</span>
                        </div>
                    </div>

                    <div class="[--clr:#1f1f1f] dark:[--clr:#999999] relative flex flex-row items-center">
                        <input value="" name="password_confirmation" required="" aria-invalid="false" placeholder="" spellcheck="false" autocomplete="off" id="password-confirmation" type="password" class="peer text-black pl-2 h-[40px] min-h-[40px] pr-[40px] leading-normal appearance-none resize-none box-border text-base w-full block text-left border border-solid bg-white rounded-[10px] m-0 p-0 outline-0 focus-visible:outline-0 focus-visible:border-[#1e40af] focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-[#1e40af2e]" />
                        <label class="cursor-text text-[--clr] inline-block z-0 text-sm mb-px font-normal text-start select-none absolute duration-300 transform origin-[0] translate-x-[32px] peer-focus-visible:text-[#1e40af] peer-[:not(:placeholder-shown)]:text-[#1e40af] peer-focus-visible:translate-x-[8px] peer-[:not(:placeholder-shown)]:translate-x-[8px] peer-focus-visible:translate-y-[-36px] peer-[:not(:placeholder-shown)]:translate-y-[-36px]" for="password-confirmation">Konfirmasi Password</label>
                        <span class="pointer-events-none absolute z-[+1] left-0 top-0 bottom-0 flex items-center justify-center size-[40px] text-gray-500 peer-focus-visible:hidden peer-[:not(:placeholder-shown)]:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor"><path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"></path><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path><path d="M8 11v-4a4 4 0 1 1 8 0v4"></path></svg>
                        </span>
                        <div class="group w-[40px] absolute top-0 bottom-0 right-0 flex items-center justify-center text-gray-500 peer-focus-visible:text-[#1e40af]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor"><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path><path d="M12 8v4"></path><path d="M12 16h.01"></path></svg>
                            <span class="text-sm absolute cursor-default select-none rounded-[4px] px-1.5 bg-[#1e40af] text-white opacity-0 right-0 -z-10 transition-all duration-300 group-hover:opacity-100 group-hover:-translate-y-[calc(100%+18px)]">Required!</span>
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="w-full py-3 rounded-lg text-white font-semibold bg-gradient-to-r from-[#093595] to-[#03112F] hover:opacity-90 transition">
                        Daftar
                    </button>
                    
                    <p class="text-center text-sm text-gray-600 mt-4">
                        Sudah punya akun? <button type="button" onclick="closeRegisterModal(); openLoginModal();" class="text-blue-600 hover:underline font-semibold">Login!</button>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openLoginModal() {
            document.getElementById('loginModal').classList.remove('hidden');
        }

        function closeLoginModal() {
            document.getElementById('loginModal').classList.add('hidden');
        }

        function openRegisterModal() {
            document.getElementById('registerModal').classList.remove('hidden');
        }

        function closeRegisterModal() {
            document.getElementById('registerModal').classList.add('hidden');
        }

        // Show login errors if any
        @if($errors -> has('email'))
        document.addEventListener('DOMContentLoaded', function() {
            openLoginModal();
            document.getElementById('loginError').textContent = '{{ $errors->first('
            email ') }}';
            document.getElementById('loginError').classList.remove('hidden');
        });
        @endif
    </script>

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
                    <a href="{{ route('materials.show', [$material->category_id, $material->level_id]) }}" onclick="return window.isAuthenticated || (openLoginModal(), false)" class="bg-[#0B3FAF] hover:bg-[#0A3797] transition px-6 py-2 rounded-full text-sm inline-block">
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
                <a href="{{ route('materials.index') }}" onclick="return window.isAuthenticated || (openLoginModal(), false)" class="px-10 py-3 rounded-full bg-blue-600 text-white text-sm hover:bg-blue-700 transition">
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