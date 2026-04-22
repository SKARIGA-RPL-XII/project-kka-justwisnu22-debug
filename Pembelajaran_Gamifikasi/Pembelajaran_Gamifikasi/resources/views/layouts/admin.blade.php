<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin - AKU DEV')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="font-sans antialiased bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800 min-h-screen">

    <!-- Top Navigation -->
    <nav class="bg-slate-800/30 backdrop-blur-sm border-b border-slate-700/50 text-white p-4 shadow-xl">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                    </svg>
                </div>
                <h1 class="text-xl font-bold font-lumanosimo">Admin Aku Dev</h1>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 bg-slate-700/50 px-3 py-2 rounded-lg">
                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center text-xs font-bold">{{ substr(Auth::user()->username, 0, 1) }}</div>
                    <span class="text-sm font-lumanosimo">{{ Auth::user()->username }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" id="logout-form-admin" class="inline">
                    @csrf
                    <button type="button" onclick="document.getElementById('logoutModalAdmin').classList.remove('hidden')" class="bg-red-500/80 hover:bg-red-500 px-4 py-2 rounded-lg transition-all duration-200 text-sm font-medium shadow-lg">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-800/30 backdrop-blur-sm border-r border-slate-700/50 min-h-screen shadow-xl">
            <nav class="p-6">
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 p-3 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600/20 border border-blue-500/30 text-blue-300' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }} rounded-xl transition-all duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                            </svg>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.quiz.index') }}" class="flex items-center gap-3 p-3 {{ request()->routeIs('admin.quiz.*') ? 'bg-blue-600/20 border border-blue-500/30 text-blue-300' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }} rounded-xl transition-all duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">Quiz</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.materials.index') }}" class="flex items-center gap-3 p-3 {{ request()->routeIs('admin.materials.*') ? 'bg-blue-600/20 border border-blue-500/30 text-blue-300' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }} rounded-xl transition-all duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                            </svg>
                            <span class="font-medium">Materi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 p-3 {{ request()->routeIs('admin.categories.*') ? 'bg-blue-600/20 border border-blue-500/30 text-blue-300' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }} rounded-xl transition-all duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                            </svg>
                            <span class="font-medium">Kategori</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.badges.index') }}" class="flex items-center gap-3 p-3 {{ request()->routeIs('admin.badges.*') ? 'bg-blue-600/20 border border-blue-500/30 text-blue-300' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }} rounded-xl transition-all duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">Badge</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 p-3 {{ request()->routeIs('admin.reports.*') ? 'bg-blue-600/20 border border-blue-500/30 text-blue-300' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }} rounded-xl transition-all duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">Laporan</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>

    @stack('scripts')

    <!-- Logout Modal Admin -->
    <div id="logoutModalAdmin" class="fixed inset-0 hidden z-[200] flex items-center justify-center bg-slate-900/80 backdrop-blur-sm">
        <div class="bg-slate-800 border border-slate-700 rounded-2xl shadow-2xl w-full max-w-sm mx-4 p-8 text-center">
            <div class="w-16 h-16 bg-red-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Konfirmasi Logout</h3>
            <p class="text-slate-400 text-sm mb-6">Apakah kamu yakin ingin keluar dari panel admin?</p>
            <div class="flex gap-3 justify-center">
                <button onclick="document.getElementById('logoutModalAdmin').classList.add('hidden')" class="px-6 py-2 rounded-lg border border-slate-600 text-slate-300 hover:bg-slate-700 transition font-medium">Batal</button>
                <button onclick="document.getElementById('logout-form-admin').submit()" class="px-6 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white transition font-medium">Ya, Logout</button>
            </div>
        </div>
    </div>
</body>

</html>