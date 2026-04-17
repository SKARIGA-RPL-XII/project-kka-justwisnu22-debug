<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} - AKU DEV</title>
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    @include('components.navbar')
    

    <div class="max-w-5xl mx-auto px-4 py-12">
        <a href="{{ route('materials.index') }}" class="text-blue-600 hover:text-blue-700 mb-6 inline-block">
            ← Kembali ke Kategori
        </a>

        {{-- NAVIGASI KATEGORI SLIDER --}}
        <div class="mb-8 flex items-center gap-3">
            {{-- Tombol Kiri --}}
            <button id="cat-prev" class="flex-shrink-0 w-9 h-9 rounded-full bg-white border border-gray-200 shadow-sm flex items-center justify-center text-gray-600 hover:bg-[#093595] hover:text-white hover:border-[#093595] transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            {{-- Track --}}
            <div class="flex-1 overflow-hidden">
                <div id="cat-track" class="flex gap-2 transition-transform duration-300 ease-in-out">
                    @foreach($allCategories as $cat)
                    <a href="{{ route('materials.category', $cat->id) }}"
                       data-cat-item
                       class="flex-shrink-0 px-5 py-2 rounded-full text-sm font-montserrat font-medium transition-all duration-200
                              {{ $cat->id === $category->id
                                  ? 'bg-[#093595] text-white shadow-md'
                                  : 'bg-white text-gray-600 border border-gray-200 hover:border-blue-400 hover:text-blue-600 hover:bg-blue-50' }}">
                        {{ $cat->name }}
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Tombol Kanan --}}
            <button id="cat-next" class="flex-shrink-0 w-9 h-9 rounded-full bg-white border border-gray-200 shadow-sm flex items-center justify-center text-gray-600 hover:bg-[#093595] hover:text-white hover:border-[#093595] transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>

        <script>
            (function () {
                const track = document.getElementById('cat-track');
                const items = Array.from(track.querySelectorAll('[data-cat-item]'));
                const total = items.length;
                if (total <= 1) return;

                // Clone semua item: taruh salinan di depan dan di belakang
                items.forEach(item => track.appendChild(item.cloneNode(true)));
                items.slice().reverse().forEach(item => track.insertBefore(item.cloneNode(true), track.firstChild));

                const gap = 8;

                function itemW(el) { return el.offsetWidth + gap; }

                // Lebar satu set penuh (original items)
                function fullSetWidth() {
                    return Array.from(track.children).slice(total, total * 2)
                        .reduce((acc, el) => acc + itemW(el), 0);
                }

                // Posisi awal: tepat di awal set original (setelah clone kiri)
                function initialOffset() {
                    return Array.from(track.children).slice(0, total)
                        .reduce((acc, el) => acc + itemW(el), 0);
                }

                let currentPx = initialOffset();
                track.style.transition = 'none';
                track.style.transform = 'translateX(-' + currentPx + 'px)';

                // Satu langkah = lebar item pertama di set original
                function stepWidth() {
                    return itemW(track.children[total]);
                }

                function slideTo(px, animate) {
                    track.style.transition = animate ? 'transform 0.3s ease-in-out' : 'none';
                    track.style.transform = 'translateX(-' + px + 'px)';
                    currentPx = px;
                }

                document.getElementById('cat-next').addEventListener('click', function () {
                    const step = stepWidth();
                    slideTo(currentPx + step, true);

                    // Setelah animasi: jika sudah masuk zona clone kanan, reset ke zona original
                    setTimeout(function () {
                        const setW = fullSetWidth();
                        const initPx = initialOffset();
                        if (currentPx >= initPx + setW) {
                            slideTo(currentPx - setW, false);
                        }
                    }, 310);
                });

                document.getElementById('cat-prev').addEventListener('click', function () {
                    const step = stepWidth();
                    slideTo(currentPx - step, true);

                    // Setelah animasi: jika sudah masuk zona clone kiri, reset ke zona original
                    setTimeout(function () {
                        const setW = fullSetWidth();
                        const initPx = initialOffset();
                        if (currentPx < initPx) {
                            slideTo(currentPx + setW, false);
                        }
                    }, 310);
                });
            })();
        </script>

        <h1 class="text-4xl font-bitter font-bold mb-2">{{ $category->name }}</h1>
        <p class="text-gray-600 mb-8">Ikuti langkah-langkah pembelajaran secara berurutan</p>

        <div class="space-y-4">
            @foreach($category->levels as $level)
            @php
                $status = $userProgress[$level->id] ?? 'locked';
                $isLocked = $status === 'locked';
            @endphp
            
            <div class="bg-white rounded-xl shadow-md p-6 {{ $isLocked ? 'opacity-60' : '' }}">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-2xl
                            {{ $status === 'completed' ? 'bg-green-100' : ($status === 'ongoing' ? 'bg-blue-100' : 'bg-gray-100') }}">
                            @if($status === 'completed') ✅
                            @elseif($status === 'ongoing') 📖
                            @else 🔒
                            @endif
                        </div>
                        
                        <div class="flex-1">
                            <h3 class="text-xl font-bitter font-bold">{{ $level->title }}</h3>
                            <div class="flex items-center gap-3 mt-1">
                                <span class="text-sm px-3 py-1 rounded-full
                                    {{ $level->difficulty->name === 'Dasar' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $level->difficulty->name === 'Pemula' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $level->difficulty->name === 'Menengah' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $level->difficulty->name === 'Mahir' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ $level->difficulty->name }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    @if($status === 'completed') Selesai
                                    @elseif($status === 'ongoing') Sedang Belajar
                                    @else Terkunci
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    @if(!$isLocked)
                    <a href="{{ route('materials.show', [$category->id, $level->id]) }}" 
                       class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        {{ $status === 'completed' ? 'Lihat Lagi' : 'Mulai' }}
                    </a>
                    @else
                    <button disabled class="px-6 py-3 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">
                        Terkunci
                    </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>
