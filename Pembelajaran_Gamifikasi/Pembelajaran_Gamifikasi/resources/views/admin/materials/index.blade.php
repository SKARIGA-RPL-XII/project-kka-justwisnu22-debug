<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Materials Management - AKU DEV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                <h1 class="text-xl font-bold font-bitter">Admin Panel</h1>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 bg-slate-700/50 px-3 py-2 rounded-lg">
                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center text-xs font-bold">{{ substr(Auth::user()->username, 0, 1) }}</div>
                    <span class="text-sm">{{ Auth::user()->username }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500/80 hover:bg-red-500 px-4 py-2 rounded-lg transition-all duration-200 text-sm font-medium shadow-lg">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-800/30 backdrop-blur-sm border-r border-slate-700/50 min-h-screen shadow-xl">
            <nav class="p-6">
                <ul class="space-y-3">
                    <li><a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 p-3 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600/20 border border-blue-500/30 text-blue-300' : 'text-slate-300 hover:bg-slate-700/50' }} rounded-xl transition-all duration-200"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path></svg><span class="font-medium">Dashboard</span></a></li>
                    <li><a href="{{ route('admin.quiz.index') }}" class="flex items-center gap-3 p-3 {{ request()->routeIs('admin.quiz.*') ? 'bg-blue-600/20 border border-blue-500/30 text-blue-300' : 'text-slate-300 hover:bg-slate-700/50' }} rounded-xl transition-all duration-200"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg><span class="font-medium">Quiz</span></a></li>
                    <li><a href="{{ route('admin.materials.index') }}" class="flex items-center gap-3 p-3 {{ request()->routeIs('admin.materials.*') ? 'bg-blue-600/20 border border-blue-500/30 text-blue-300' : 'text-slate-300 hover:bg-slate-700/50' }} rounded-xl transition-all duration-200"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path></svg><span class="font-medium">Materi</span></a></li>
                    <li><a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 p-3 {{ request()->routeIs('admin.categories.*') ? 'bg-blue-600/20 border border-blue-500/30 text-blue-300' : 'text-slate-300 hover:bg-slate-700/50' }} rounded-xl transition-all duration-200"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg><span class="font-medium">Kategori</span></a></li>
                    <li><a href="{{ route('admin.badges.index') }}" class="flex items-center gap-3 p-3 {{ request()->routeIs('admin.badges.*') ? 'bg-blue-600/20 border border-blue-500/30 text-blue-300' : 'text-slate-300 hover:bg-slate-700/50' }} rounded-xl transition-all duration-200"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg><span class="font-medium">Badge</span></a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2 font-bitter">Materials Management</h2>
                    <p class="text-slate-400">Kelola konten pembelajaran</p>
                </div>
                <a href="{{ route('admin.materials.create') }}">
                    <button
                        title="Add New"
                        class="group cursor-pointer outline-none transition-transform duration-300 hover:rotate-90">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="42"
                            height="42"
                            viewBox="0 0 24 24"
                            class="fill-none stroke-[#2457D6]
                                   transition-all duration-300
                                   group-hover:fill-[#0B3FAF]
                                   group-hover:stroke-white
                                   group-hover:drop-shadow-[0_0_12px_rgba(36,87,214,0.8)]
                                   group-active:scale-95">
                            <path
                                d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z"
                                stroke-width="1.5" />
                            <path d="M8 12H16" stroke-width="1.5" />
                            <path d="M12 16V8" stroke-width="1.5" />
                        </svg>
                    </button>
                </a>
            </div>

            @if(session('success'))
            <div class="bg-green-500/20 border border-green-500/50 text-green-300 px-6 py-4 rounded-xl mb-6 backdrop-blur-sm shadow-lg">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
            @endif

            <div class="bg-slate-800/30 backdrop-blur-sm border border-slate-700/50 rounded-2xl shadow-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-slate-700/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/50">
                            @forelse($materials ?? [] as $material)
                            <tr class="hover:bg-slate-700/30 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-slate-300 font-medium">{{ $material->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-white font-semibold">{{ $material->title }}</td>
                                <td class="px-6 py-4 max-w-md">
                                    <div class="text-sm text-slate-400 line-clamp-2">{{ $material->description }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-300">{{ $material->category->name ?? '-' }}</div>
                                    <div class="text-xs text-slate-500">{{ $material->level->title ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.materials.edit', $material->id) }}" class="bg-blue-500/20 hover:bg-blue-500/30 text-blue-300 px-4 py-2 rounded-lg transition-all duration-200 border border-blue-500/30">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.materials.destroy', $material->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500/20 hover:bg-red-500/30 text-red-300 px-4 py-2 rounded-lg transition-all duration-200 border border-red-500/30" onclick="return confirm('Yakin hapus?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <svg class="w-12 h-12 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="text-slate-400 text-lg">Tidak ada data materi</p>
                                        <p class="text-slate-500 text-sm">Mulai dengan menambahkan materi pembelajaran pertama</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>