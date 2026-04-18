<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - AKU DEV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    @include('components.navbar')

    <!-- Banner -->
    <section>
        <div class="relative top-[-20px] z-0 h-[400px] bg-cover bg-center bg-no-repeat"
            style="background-image: url('/images/baner.jpg');">
            <div class="absolute inset-0 bg-[#03112F]/60 flex flex-col items-center justify-center">
                <h1 class="text-5xl font-lumanosimo text-white mb-3">About Us</h1>
                <p class="text-white/80 font-montserrat text-lg">Kenali lebih dalam tentang Aku Dev</p>
            </div>
        </div>
    </section>
    <div class="relative top-[-65px] w-full h-[45px]" style="background-image: url('/images/pemisah.png')"></div>

    <!-- OUR STORY -->
    <section class="py-16 bg-white">
        <div class="mx-auto max-w-[1320px] px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">

                <!-- Gambar -->
               <div class="grid grid-cols-2 gap-4">

    <!-- SLIDER 1 -->
    <div class="story-1">
        <div>
            <img src="{{ asset('images/mockup1.png') }}" 
                 class="rounded-2xl w-full h-64 object-cover shadow-lg">
        </div>
        <div>
            <img src="{{ asset('images/mockup2.png') }}" 
                 class="rounded-2xl w-full h-64 object-cover shadow-lg">
        </div>
    </div>

    <!-- SLIDER 2 -->
    <div class="story-2 mt-8">
        <div>
            <img src="{{ asset('images/office2.jpg') }}" 
                 class="rounded-2xl w-full h-64 object-cover shadow-lg">
        </div>
        <div>
            <img src="{{ asset('images/program1.jpg') }}" 
                 class="rounded-2xl w-full h-64 object-cover shadow-lg">
        </div>
    </div>

</div>

                <!-- Teks -->
                <div>
                    <span class="text-sm font-montserrat font-semibold text-blue-600 uppercase tracking-widest">Our Story</span>
                    <h2 class="text-4xl font-lumanosimo font-bold mt-2 mb-6 leading-snug">Dari Nol Jadi<br>Developer Handal</h2>
                    <p class="font-montserrat text-gray-600 text-justify leading-relaxed mb-4">
                        Aku Dev lahir dari keresahan banyak pemula yang ingin belajar coding namun bingung harus mulai dari mana. Materi yang tersebar dan tidak terstruktur sering membuat proses belajar menjadi tidak efektif dan mudah terhenti di tengah jalan.
                    </p>
                    <p class="font-montserrat text-gray-600 text-justify leading-relaxed mb-4">
                        Untuk itu, Aku Dev hadir dengan alur pembelajaran yang terarah, menggabungkan materi berkualitas dengan sistem gamifikasi — poin, level, dan badge — agar belajar terasa lebih menyenangkan dan memotivasi.
                    </p>
                    <p class="font-montserrat text-gray-600 text-justify leading-relaxed">
                        Kami percaya bahwa siapapun bisa menjadi developer handal, asalkan punya panduan yang tepat dan semangat yang konsisten. Aku Dev ada untuk menemanimu di setiap langkah perjalanan itu.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- VISI & MISI -->
    <section class="py-16 bg-gray-50">
        <div class="mx-auto max-w-[1320px] px-6">
            <h2 class="text-4xl font-lumanosimo font-bold text-center mb-12">Visi & Misi</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Visi -->
                <div class="bg-[linear-gradient(135deg,#093595,#03112F)] rounded-2xl p-8 text-white shadow-xl">
                    <div class="w-14 h-14 bg-white/10 rounded-xl flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-lumanosimo font-bold mb-4">Visi</h3>
                    <p class="font-montserrat text-white/80 leading-relaxed">
                        Menjadi platform pembelajaran pemrograman terdepan di Indonesia yang melahirkan generasi developer berkualitas melalui pendekatan belajar yang menyenangkan, terstruktur, dan berbasis gamifikasi.
                    </p>
                </div>

                <!-- Misi -->
                <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100">
                    <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-lumanosimo font-bold mb-4 text-[#03112F]">Misi</h3>
                    <ul class="font-montserrat text-gray-600 space-y-3">
                        <li class="flex items-start gap-3">
                            <span class="mt-1 w-2 h-2 rounded-full bg-blue-600 flex-shrink-0"></span>
                            Menyediakan materi pemrograman yang terstruktur dan mudah dipahami oleh pemula.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-1 w-2 h-2 rounded-full bg-blue-600 flex-shrink-0"></span>
                            Memotivasi pengguna melalui sistem gamifikasi berupa poin, level, dan badge.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-1 w-2 h-2 rounded-full bg-blue-600 flex-shrink-0"></span>
                            Membangun komunitas belajar yang suportif dan inklusif bagi semua kalangan.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-1 w-2 h-2 rounded-full bg-blue-600 flex-shrink-0"></span>
                            Terus berinovasi menghadirkan konten dan fitur yang relevan dengan kebutuhan industri.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- KENAPA AKU DEV -->
    <section class="py-16 bg-white">
        <div class="mx-auto max-w-[1320px] px-6">
            <h2 class="text-4xl font-lumanosimo font-bold text-center mb-4">Kenapa Aku Dev?</h2>
            <p class="text-center text-gray-500 font-montserrat mb-12">Keunggulan yang membuat belajar di Aku Dev berbeda</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- 1 -->
                 <div class="bg-gray-50 rounded-2xl p-6 text-center hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                    <div class="w-[35px] h-[35px] mx-auto mb-[8px]"><img src="{{asset('images/clipboard.png')}}" alt=""/>
                    </div>
                    <h3 class="text-lg font-bitter font-bold mb-2 text-[#03112F]">Alur Terstruktur</h3>
                    <p class="text-sm font-montserrat text-gray-500 leading-relaxed">Materi disusun dari dasar hingga mahir dengan urutan yang logis dan mudah diikuti.</p>
                </div>

                <!-- 2 -->
                <div class="bg-gray-50 rounded-2xl p-6 text-center hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                    <div class="w-[35px] h-[35px] mx-auto mb-[8px]"><img src="{{asset('images/console.png')}}" alt=""/>
                    </div>
                    <h3 class="text-lg font-bitter font-bold mb-2 text-[#03112F]">Gamifikasi</h3>
                    <p class="text-sm font-montserrat text-gray-500 leading-relaxed">Kumpulkan EXP, naik level, dan raih badge untuk setiap pencapaian belajarmu.</p>
                </div>

                <!-- 3 -->
                <div class="bg-gray-50 rounded-2xl p-6 text-center hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                    <div class="w-[35px] h-[35px] mx-auto mb-[8px]"><img src="{{asset('images/question.png')}}" alt=""/>
                    </div>
                    <h3 class="text-lg font-bitter font-bold mb-2 text-[#03112F]">Kuis Interaktif</h3>
                    <p class="text-sm font-montserrat text-gray-500 leading-relaxed">Uji pemahamanmu dengan kuis di setiap level sebelum melanjutkan ke materi berikutnya.</p>
                </div>

                <!-- 4 -->
                <div class="bg-gray-50 rounded-2xl p-6 text-center hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                    <div class="w-[35px] h-[35px] mx-auto mb-[8px]"><img src="{{asset('images/award.png')}}" alt=""/>
                    </div>
                    <h3 class="text-lg font-bitter font-bold mb-2 text-[#03112F]">Sistem Badge</h3>
                    <p class="text-sm font-montserrat text-gray-500 leading-relaxed">Dapatkan penghargaan berupa badge eksklusif sebagai bukti kompetensimu.</p>
                </div>
                
            </div>
        </div>
    </section>

    <!-- KONTAK -->
   <section class="relative py-16 bg-cover bg-center bg-no-repeat bg-fixed"
    style="background-image:url('{{ asset('images/office1.jpg') }}');">

    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-[#03112F]/60"></div>

    <!-- CONTENT -->
    <div class="relative z-10 mx-auto max-w-[1320px] px-6 text-center">
        <h2 class="text-4xl font-lumanosimo font-bold text-white mb-4">Hubungi Kami</h2>
        <p class="text-white/70 font-montserrat mb-10">
            Ada pertanyaan atau ingin berkolaborasi? Kami siap mendengar.
        </p>

        <div class="flex flex-col md:flex-row justify-center gap-6">

           <a href="https://wa.me/6285855550057" target="_blank">
    <button class="bg-gradient-to-r from-[#03112F] to-blue-800 
                   hover:from-blue-900 hover:to-[#03112F]
                   text-white font-bold py-3 px-6 rounded-full 
                   shadow-lg transform transition-all duration-500 ease-in-out 
                   hover:scale-110 hover:brightness-110 hover:animate-pulse 
                   active:animate-bounce">
        +62 858-5555-0057
    </button>
</a>

          <a href="#">
    <button class="bg-gradient-to-r from-[#03112F] to-blue-800 
                   hover:from-blue-900 hover:to-[#03112F]
                   text-white font-bold py-3 px-6 rounded-full 
                   shadow-lg transform transition-all duration-500 ease-in-out 
                   hover:scale-110 hover:brightness-110 hover:animate-pulse 
                   active:animate-bounce">
        akudev@gmail.com
    </button>
</a>

          <a href="https://www.instagram.com/zwardosh_/" target="_blank">
    <button class="bg-gradient-to-r from-[#03112F] to-blue-800 
                   hover:from-blue-900 hover:to-[#03112F]
                   text-white font-bold py-3 px-6 rounded-full 
                   shadow-lg transform transition-all duration-500 ease-in-out 
                   hover:scale-110 hover:brightness-110 hover:animate-pulse 
                   active:animate-bounce">
        @AkuDev_
    </button>
</a>

        </div>
    </div>

</section>

    <div class="h-[50px] scale-y-[-1] mt-0" style="background-image: url('/images/pemisah.png');"></div>

    @include('components.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
 $('.story-1').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });

 $('.story-2').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });
</script>
</body>
</html>
