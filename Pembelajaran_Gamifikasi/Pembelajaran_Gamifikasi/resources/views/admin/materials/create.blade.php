<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Materi - Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css'])
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
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
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 p-3 text-slate-300 rounded-xl transition-all duration-200 hover:bg-slate-700/50 hover:text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                            </svg>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.quiz.index') }}" class="flex items-center gap-3 p-3 text-slate-300 rounded-xl transition-all duration-200 hover:bg-slate-700/50 hover:text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">Quiz</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.materials.index') }}" class="flex items-center gap-3 p-3 bg-blue-600/20 border border-blue-500/30 text-blue-300 rounded-xl transition-all duration-200 hover:bg-blue-600/30">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                            </svg>
                            <span class="font-medium">Materi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 p-3 text-slate-300 rounded-xl transition-all duration-200 hover:bg-slate-700/50 hover:text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                            </svg>
                            <span class="font-medium">Kategori</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.badges.index') }}" class="flex items-center gap-3 p-3 text-slate-300 rounded-xl transition-all duration-200 hover:bg-slate-700/50 hover:text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">Badge</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="max-w-4xl mx-auto">
                <div class="mb-8">
                    <div class="flex items-center gap-4 mb-4">
                        <a href="{{ route('admin.materials.index') }}" class="bg-slate-700/50 hover:bg-slate-700 text-slate-300 hover:text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-2 font-bitter">Tambah Materi Baru</h2>
                    <p class="text-slate-400">Buat konten pembelajaran baru</p>
                </div>

                <div class="bg-slate-800/30 backdrop-blur-sm border border-slate-700/50 rounded-2xl shadow-2xl p-8">
                    <form action="{{ route('admin.materials.store') }}" method="POST" id="createForm">
                        @csrf
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-3">Judul Materi</label>
                                <input type="text" name="title" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" placeholder="Masukkan judul materi">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-3">Deskripsi Singkat</label>
                                <textarea name="description" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" rows="3" placeholder="Deskripsi singkat untuk card user"></textarea>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-3">Kategori</label>
                                <select name="category_id" id="category_id" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white transition-all duration-200">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-3">Tingkat</label>
                                <select name="level_id" id="level_id" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white transition-all duration-200">
                                    <option value="">Pilih Kategori Dulu</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-3">EXP Reward</label>
                                <input type="number" name="exp_reward" required min="0" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" placeholder="Contoh: 50">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-3">Konten Materi</label>
                                <div class="bg-slate-700/50 border border-slate-600 rounded-lg overflow-hidden">
                                    <textarea name="content" id="content" required class="w-full bg-transparent text-white placeholder-slate-400 resize-none border-0 focus:ring-0" rows="10"></textarea>
                                </div>
                            </div>
                            
                            <div class="flex justify-end pt-6">
                                <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold px-8 py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    Simpan Materi
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    
    <script>
        CKEDITOR.replace('content', {
            height: 400
        });
        
        document.getElementById('category_id').addEventListener('change', function() {
            const categoryId = this.value;
            const levelSelect = document.getElementById('level_id');
            
            if (!categoryId) {
                levelSelect.innerHTML = '<option value="">Pilih Kategori Dulu</option>';
                return;
            }
            
            fetch(`/admin/categories/${categoryId}/levels`)
                .then(res => res.json())
                .then(levels => {
                    levelSelect.innerHTML = '<option value="">Pilih Tingkat</option>';
                    levels.forEach(level => {
                        levelSelect.innerHTML += `<option value="${level.id}">${level.title} (${level.difficulty.name})</option>`;
                    });
                });
        });
    </script>
</body>
</html>
