@extends('layouts.app')

@section('title', 'AKU DEV - Dari Nol Jadi Developer Handal')

@section('content')
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
        <div class="mx-auto max-w-[1320px]">
            <h2 class="text-4xl font-bitter font-bold text-black text-center mb-4">Pilih Kategori Belajar</h2>
            <p class="text-center text-gray-600 mb-12">Mulai perjalanan belajarmu dari kategori yang kamu minati</p>

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
                            <span class="absolute left-0 -bottom-1 h-[2px] w-full bg-blue-600 scale-x-0 origin-left transition-transform duration-300 ease-in-out group-hover:scale-x-100 group-hover:origin-left"></span>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-gray-500">Belum ada kategori tersedia</p>
                </div>
                @endforelse
            </div>

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
        <div class="mx-auto max-w-[1320px]">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-4">
                    <div class="our-story rounded-xl">
                        <div><img class="h-[275px] w-full object-cover" src="{{ asset('images/mockup1.png') }}" alt=""></div>
                        <div><img class="h-[275px] w-full object-cover" src="{{ asset('images/office2.jpg') }}" alt=""></div>
                    </div>
                </div>
                <div class="md:col-span-8">
                    <div class="ml-5">
                        <h1 class="font-bold text-3xl font-lumanosimo pb-4">Our Story</h1>
                        <p class="font-montserrat text-justify pb-8">Aku Dev lahir dari keresahan banyak pemula yang ingin belajar coding namun bingung harus mulai dari mana. Materi yang tersebar dan tidak terstruktur sering membuat proses belajar menjadi tidak efektif dan mudah terhenti di tengah jalan.
                            <br><br>
                            Untuk itu, Aku Dev hadir dengan alur pembelajaran yang terarah, menggabungkan materi dan . . .
                        </p>
                        <button onclick="window.location='{{ route('about') }}'"
                            class="group relative w-auto cursor-pointer overflow-hidden rounded-full border border-gray-200 bg-white px-5 py-2 text-center font-medium text-gray-900 shadow-sm transition-all duration-300 hover:shadow-md">
                            <div class="flex items-center gap-3">
                                <div class="h-2 w-2 rounded-full bg-gray-900 transition-all duration-300 group-hover:scale-[100.8]"></div>
                                <span class="inline-block transition-all duration-300 group-hover:translate-x-12 group-hover:opacity-0">See More</span>
                            </div>
                            <div class="absolute top-0 z-10 flex h-full w-full translate-x-12 items-center justify-center gap-3 bg-gray-900 text-white opacity-0 transition-all duration-300 group-hover:-translate-x-5 group-hover:opacity-100">
                                <div class="flex items-center gap-3 whitespace-nowrap">
                                    <span class="leading-none font-medium">See More</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h14" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 6l6 6-6 6" />
                                    </svg>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="relative bottom-[-50px] h-[50px] scale-y-[-1]" style="background-image: url('/images/pemisah.png');"></div>
@endsection

@push('scripts')
<script>
    $('.our-story').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });
</script>
@endpush
