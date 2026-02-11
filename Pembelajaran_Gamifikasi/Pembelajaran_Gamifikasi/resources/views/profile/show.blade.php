<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil - AKU DEV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800 min-h-screen">
    @include('components.navbar')

    <div class="container mx-auto px-4 py-8">
        @if(session('success'))
        <div class="max-w-7xl mx-auto mb-6">
            <div class="bg-green-500/20 border border-green-500/50 text-green-300 px-6 py-4 rounded-xl backdrop-blur-sm">
                {{ session('success') }}
            </div>
        </div>
        @endif

        <div class="max-w-7xl mx-auto">
            <!-- Profile Card -->
            <div class="bg-slate-800/30 backdrop-blur-sm border border-slate-700/50 rounded-2xl shadow-2xl overflow-hidden mb-8">
                <!-- Header with Gradient -->
                <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-900 px-8 py-10 text-white relative overflow-hidden">
                    <div class="absolute inset-0 bg-black/20"></div>
                    <div class="relative z-10 flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-8">
                        <!-- Photo Profile -->
                        <div class="w-32 h-32 rounded-full bg-white p-1 shadow-2xl">
                            <div class="w-full h-full rounded-full overflow-hidden bg-gray-100">
                                @if(!empty($user->photo_profile))
                                <img src="{{ route('profile.photo', $user->id) }}" class="w-full h-full object-cover">
                                @else
                                <img src="{{ asset('Images/dummy_user.png') }}" alt="Profile" class="w-full h-full object-cover">
                                @endif
                            </div>
                        </div>

                        <!-- User Info -->
                        <div class="flex-1 text-center md:text-left">
                            <h1 class="text-3xl font-bold mb-2">{{ $user->username }}</h1>
                            @if($user->title)
                            <p class="text-blue-100 text-lg mb-3 font-medium">{{ $user->title }}</p>
                            @else
                            <p class="text-blue-200 text-sm mb-3 opacity-75 italic">Belum ada title</p>
                            @endif
                            
                            <div class="flex items-center justify-center md:justify-start space-x-6 text-sm">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="font-semibold">Level {{ $user->level }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>{{ $user->exp }} EXP</span>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Button -->
                        <div class="relative z-10">
                            <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-6 py-3 bg-white text-blue-600 rounded-xl font-semibold hover:bg-blue-50 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Stats & Progress -->
                <div class="p-8">
                    <!-- EXP Progress Bar -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-sm font-semibold text-slate-300">Progress ke Level {{ $user->level + 1 }}</span>
                            @php
                            $currentLevelExp = ($user->level - 1) * 100;
                            $nextLevelExp = $user->level * 100;
                            $expInCurrentLevel = $user->exp - $currentLevelExp;
                            $expProgress = min(100, ($expInCurrentLevel / 100) * 100);
                            @endphp
                            <span class="text-sm font-bold text-blue-600">{{ $expInCurrentLevel }}/100 EXP</span>
                        </div>
                        <div class="w-full bg-slate-700/50 rounded-full h-4 overflow-hidden shadow-inner">
                            <div class="bg-gradient-to-r from-blue-500 via-blue-600 to-purple-600 h-4 rounded-full transition-all duration-500 shadow-lg" style="width: {{ $expProgress }}%"></div>
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-slate-700/30 backdrop-blur-sm p-6 rounded-xl border border-slate-600/50">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-3xl font-bold text-blue-400">{{ $user->level }}</div>
                                    <div class="text-sm text-slate-300 font-medium">Level Saat Ini</div>
                                </div>
                                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-700/30 backdrop-blur-sm p-6 rounded-xl border border-slate-600/50">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-3xl font-bold text-green-400">{{ $user->exp }}</div>
                                    <div class="text-sm text-slate-300 font-medium">Total EXP</div>
                                </div>
                                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-700/30 backdrop-blur-sm p-6 rounded-xl border border-slate-600/50">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-3xl font-bold text-purple-400">{{ $learningHistory->count() }}</div>
                                    <div class="text-sm text-slate-300 font-medium">Materi Dibuka</div>
                                </div>
                                <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Learning History -->
            <div class="bg-slate-800/30 backdrop-blur-sm border border-slate-700/50 rounded-2xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-slate-700 to-slate-900 px-8 py-6 border-b border-slate-700/50">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <svg class="w-7 h-7 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        Riwayat Pembelajaran
                    </h2>
                </div>

                <div class="p-8">
                    @forelse($learningHistory as $history)
                    <div class="mb-6 last:mb-0 bg-slate-700/30 backdrop-blur-sm rounded-xl p-6 border border-slate-600/50 hover:bg-slate-700/40 hover:border-slate-500/50 transition-all">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between space-y-4 lg:space-y-0">
                            <!-- Left: Material Info -->
                            <div class="flex-1">
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-white mb-1">{{ $history['material_title'] }}</h3>
                                        <div class="flex flex-wrap items-center gap-2 text-sm">
                                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full font-medium">{{ $history['category'] }}</span>
                                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full font-medium">{{ $history['level'] }}</span>
                                            <span class="px-3 py-1 
                                                @if($history['difficulty'] == 'easy') bg-green-100 text-green-700
                                                @elseif($history['difficulty'] == 'medium') bg-yellow-100 text-yellow-700
                                                @else bg-red-100 text-red-700 @endif
                                                rounded-full font-medium">
                                                {{ ucfirst($history['difficulty']) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: Status & Date -->
                            <div class="flex flex-col lg:items-end space-y-2">
                                <div class="flex flex-wrap gap-2">
                                    <!-- EXP Status -->
                                    @if($history['exp_claimed'])
                                    <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        EXP Diklaim
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                        </svg>
                                        EXP Belum Diklaim
                                    </span>
                                    @endif

                                    <!-- Quiz Status -->
                                    @if($history['quiz_passed'])
                                    <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        Quiz Lulus ({{ round($history['quiz_score']) }}%)
                                    </span>
                                    @elseif($history['quiz_score'] !== null)
                                    <span class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                        </svg>
                                        Quiz Belum Lulus ({{ round($history['quiz_score']) }}%)
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                                        </svg>
                                        Quiz Belum Dikerjakan
                                    </span>
                                    @endif
                                </div>

                                <div class="text-xs text-slate-400 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                    Terakhir diakses: {{ $history['last_accessed']->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <p class="text-slate-400 text-lg font-medium">Belum ada riwayat pembelajaran</p>
                        <p class="text-slate-500 text-sm mt-2">Mulai belajar untuk melihat riwayat di sini</p>
                        <a href="{{ route('materials.index') }}" class="inline-block mt-4 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Mulai Belajar
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="relative bottom-[-50px] h-[50px] scale-y-[-1]" style="background-image: url('/images/pemisah.png');"></div>
    
    <!-- Footer -->
    <footer class="bg-[#0F172A] text-white pt-[80px] pb-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-12 md:col-span-4">
                    <img src="/images/aku_dev_logo-removebg-preview.png" alt="" class="w-[100px]">
                    <h3 class="text-xl font-lumanosimo font-semibold mb-4">Dari Nol Jadi Developer Handal</h3>
                </div>
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
                <div class="col-span-6 md:col-span-2">
                    <h4 class="text-sm font-bitter font-semibold mb-4">Our Contact</h4>
                    <ul class="space-y-2 text-sm opacity-80">
                        <li><a href="#" class="font-montserrat hover:opacity-100">No. +62 858-5555-0057</a></li>
                        <li><a href="#" class="font-montserrat hover:opacity-100">Email: akudev@gmail.com</a></li>
                        <li><a href="#" class="font-montserrat hover:opacity-100">Instagram: AkuDev_</a></li>
                    </ul>
                </div>
                <div class="col-span-12 md:col-span-4">
                    <h4 class="text-sm font-bitter font-semibold mb-4">Our Location</h4>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d246.9950363968931!2d112.58121981308561!3d-7.903365759255451!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sid!2sid!4v1769363353465!5m2!1sid!2sid" width="300" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="border-t border-white/10 mt-12 pt-6 text-center text-sm opacity-70">
                © 2026 Aku Dev. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>
