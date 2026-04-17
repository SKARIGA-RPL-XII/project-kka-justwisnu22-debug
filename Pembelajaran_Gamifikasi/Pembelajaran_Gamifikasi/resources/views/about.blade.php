<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - AKU DEV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
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
                    <img src="{{ asset('images/mockup1.png') }}" alt="Aku Dev" class="rounded-2xl w-full h-64 object-cover shadow-lg">
                    <img src="{{ asset('images/story2.jpg') }}" alt="Aku Dev" class="rounded-2xl w-full h-64 object-cover shadow-lg mt-8">
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
                @php
                $features = [
                    ['icon' => '🗺️', 'title' => 'Alur Terstruktur', 'desc' => 'Materi disusun dari dasar hingga mahir dengan urutan yang logis dan mudah diikuti.'],
                    ['icon' => '🎮', 'title' => 'Gamifikasi', 'desc' => 'Kumpulkan EXP, naik level, dan raih badge untuk setiap pencapaian belajarmu.'],
                    ['icon' => '📝', 'title' => 'Kuis Interaktif', 'desc' => 'Uji pemahamanmu dengan kuis di setiap level sebelum melanjutkan ke materi berikutnya.'],
                    ['icon' => '🏆', 'title' => 'Sistem Badge', 'desc' => 'Dapatkan penghargaan berupa badge eksklusif sebagai bukti kompetensimu.'],
                ];
                @endphp
                @foreach($features as $f)
                <div class="bg-gray-50 rounded-2xl p-6 text-center hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                    <div class="text-4xl mb-4">{{ $f['icon'] }}</div>
                    <h3 class="text-lg font-bitter font-bold mb-2 text-[#03112F]">{{ $f['title'] }}</h3>
                    <p class="text-sm font-montserrat text-gray-500 leading-relaxed">{{ $f['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- KONTAK -->
    <section class="py-16 bg-[linear-gradient(135deg,#093595,#03112F)]">
        <div class="mx-auto max-w-[1320px] px-6 text-center">
            <h2 class="text-4xl font-lumanosimo font-bold text-white mb-4">Hubungi Kami</h2>
            <p class="text-white/70 font-montserrat mb-10">Ada pertanyaan atau ingin berkolaborasi? Kami siap mendengar.</p>
            <div class="flex flex-col md:flex-row justify-center gap-6">
                <a href="https://wa.me/6285855550057" target="_blank"
                   class="flex items-center gap-3 bg-white/10 hover:bg-white/20 transition rounded-xl px-6 py-4 text-white font-montserrat">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    +62 858-5555-0057
                </a>
                <a href="#"
                   class="flex items-center gap-3 bg-white/10 hover:bg-white/20 transition rounded-xl px-6 py-4 text-white font-montserrat">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    akudev@gmail.com
                </a>
                <a href="#"
                   class="flex items-center gap-3 bg-white/10 hover:bg-white/20 transition rounded-xl px-6 py-4 text-white font-montserrat">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                    @AkuDev_
                </a>
            </div>
        </div>
    </section>

    <div class="h-[50px] scale-y-[-1] mt-0" style="background-image: url('/images/pemisah.png');"></div>

    @include('components.footer')
</body>
</html>
