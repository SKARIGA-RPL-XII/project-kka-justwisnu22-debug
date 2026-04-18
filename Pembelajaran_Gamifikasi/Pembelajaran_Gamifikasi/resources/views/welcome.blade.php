<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

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
                    @if($errors->has('email'))
                    <div class="p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                        {{ $errors->first('email') }}
                    </div>
                    @endif
                    
                    @if($errors->has('password'))
                    <div class="p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                        {{ $errors->first('password') }}
                    </div>
                    @endif
                    
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
        @if($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            openLoginModal();
        });
        @endif
    </script>

    <!-- Banner -->
     <section>
        <div class="relative top-[-20px] z-0 h-[500px] bg-cover bg-center bg-no-repeat"
            style="background-image: url('/images/baner.jpg');">
            <div class="absolute inset-0 bg-[#03112F]/60 flex flex-col items-center justify-center">
              
            </div>
        </div>
    </section>
    <div class="relative top-[-65px] w-full h-[45px]" style="background-image: url('/images/pemisah.png')"></div>



    <!-- Materi Section -->
    <section class="mb-[50px]">
        <div class="mx-auto max-w-[1320px] ">
            <!-- TITLE -->
            <h2 class="text-4xl font-bitter font-bold text-black text-center mb-4">Pilih Kategori Belajar</h2>
            <p class="text-center text-gray-600 mb-12">Mulai perjalanan belajarmu dari kategori yang kamu minati</p>

            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($categories as $category)
                <a href="#" onclick="openLoginModal(); return false;" class="group bg-white rounded-xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center overflow-hidden">
                            <img src="{{ $category->foto_kategori ? route('category.photo', $category->id) : asset('images/no_image.jpg') }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-xl text-black font-bitter font-bold mb-2">{{ $category->name }}</h3>
                        <p class="text-sm text-black mb-4">{{ $category->levels->count() }} Tingkatan</p>
                        
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
            @if($categories->count() >= 6)
            <div class="flex justify-center mt-16">
                <button onclick="openLoginModal()" class="cursor-pointer bg-gradient-to-b from-blue-500 to-[#093595] shadow-[0px_4px_32px_0_rgba(99,102,241,.70)] px-6 py-3 rounded-xl text-white font-medium group">
                    <div class="relative overflow-hidden">
                        <p class="group-hover:-translate-y-7 duration-[1.125s] ease-[cubic-bezier(0.19,1,0.22,1)]">See More . . .</p>
                        <p class="absolute top-7 left-0 group-hover:top-0 duration-[1.125s] ease-[cubic-bezier(0.19,1,0.22,1)]">See More . . .</p>
                    </div>
                </button>
            </div>
            @endif
        </div>
    </section>

     <!-- Section ABOUT US -->
    <section class="py-[50px] my-[30px] bg-gray-100 text-black">
        <div class="mx-auto max-w-[1320px] ">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">

                <div class="md:col-span-4">
                    <div class="our-story rounded-xl">
                       <div><img class="h-[275px] w-full object-cover" src="{{ asset('images/mockup1.png') }}" alt=""></div>
                        <div><img class="h-[275px] w-full object-cover" src="{{ asset('images/office2.jpg') }}" alt=""></div>
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

    <div
        class="relative bottom-[-50px] h-[50px] scale-y-[-1]"
        style="background-image: url('/images/pemisah.png');">
    </div>
    @include('components.footer')
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
</body>

</html>