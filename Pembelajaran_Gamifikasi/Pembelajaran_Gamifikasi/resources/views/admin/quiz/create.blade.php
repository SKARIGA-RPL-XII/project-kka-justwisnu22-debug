<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Quiz - AKU DEV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800 min-h-screen">
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
        <aside class="w-64 bg-slate-800/30 backdrop-blur-sm border-r border-slate-700/50 min-h-screen shadow-xl">
            <nav class="p-6">
                <ul class="space-y-3">
                    <li><a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 p-3 text-slate-300 hover:bg-slate-700/50 rounded-xl transition-all duration-200"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path></svg><span class="font-medium">Dashboard</span></a></li>
                    <li><a href="{{ route('admin.quiz.index') }}" class="flex items-center gap-3 p-3 bg-blue-600/20 border border-blue-500/30 text-blue-300 rounded-xl transition-all duration-200"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg><span class="font-medium">Quiz</span></a></li>
                    <li><a href="{{ route('admin.materials.index') }}" class="flex items-center gap-3 p-3 text-slate-300 hover:bg-slate-700/50 rounded-xl transition-all duration-200"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path></svg><span class="font-medium">Materi</span></a></li>
                    <li><a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 p-3 text-slate-300 hover:bg-slate-700/50 rounded-xl transition-all duration-200"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg><span class="font-medium">Kategori</span></a></li>
                    <li><a href="{{ route('admin.badges.index') }}" class="flex items-center gap-3 p-3 text-slate-300 hover:bg-slate-700/50 rounded-xl transition-all duration-200"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg><span class="font-medium">Badge</span></a></li>
                </ul>
            </nav>
        </aside>

        <main class="flex-1 p-8">
            <div class="mb-8">
                <div class="flex items-center gap-4 mb-4">
                    <a href="{{ route('admin.quiz.index') }}" class="bg-slate-700/50 hover:bg-slate-700 text-slate-300 hover:text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
                <h2 class="text-3xl font-bold text-white mb-2 font-bitter">Tambah Quiz Baru</h2>
                <p class="text-slate-400">Buat quiz pembelajaran dengan soal pilihan ganda</p>
            </div>

            <form action="{{ route('admin.quiz.store') }}" method="POST" class="bg-slate-800/30 backdrop-blur-sm border border-slate-700/50 rounded-2xl shadow-2xl p-8">
                @csrf
                
                <div class="space-y-6 mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-3">Judul Quiz</label>
                            <input type="text" name="title" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" placeholder="Masukkan judul quiz">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-3">EXP Reward</label>
                            <input type="number" name="exp_reward" required min="1" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" placeholder="Contoh: 50">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                    </div>
                </div>
                
                <div id="questions-container" class="space-y-6 mb-6"></div>
                
                <button type="button" onclick="addQuestion()" class="mb-6 px-6 py-3 bg-green-600/80 hover:bg-green-600 text-white rounded-lg transition-all duration-200 font-semibold shadow-lg">
                    + Tambah Soal
                </button>
                
                <div class="flex gap-3 pt-6 border-t border-slate-700/50">
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold px-8 py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">Simpan Quiz</button>
                    <a href="{{ route('admin.quiz.index') }}" class="bg-slate-700/50 hover:bg-slate-700 text-slate-300 hover:text-white px-8 py-3 rounded-lg transition-all duration-200 font-semibold flex items-center">Batal</a>
                </div>
            </form>
        </main>
    </div>
    
    <script>
        let questionCount = 0;
        
        function addQuestion() {
            const container = document.getElementById('questions-container');
            const newQuestion = `
                <div class="question-item bg-slate-700/30 border border-slate-600/50 rounded-xl p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-white">Soal ${questionCount + 1}</h3>
                        ${questionCount > 0 ? '<button type="button" onclick="this.closest(\'.question-item\').remove()" class="text-red-400 hover:text-red-300 font-semibold">Hapus</button>' : ''}
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Pertanyaan</label>
                            <textarea name="questions[${questionCount}][question]" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-slate-400" rows="3" placeholder="Tulis pertanyaan di sini..."></textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">Jawaban A</label>
                                <input type="text" name="questions[${questionCount}][answers][0]" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-slate-400" placeholder="Pilihan A">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">Jawaban B</label>
                                <input type="text" name="questions[${questionCount}][answers][1]" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-slate-400" placeholder="Pilihan B">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">Jawaban C</label>
                                <input type="text" name="questions[${questionCount}][answers][2]" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-slate-400" placeholder="Pilihan C">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">Jawaban D</label>
                                <input type="text" name="questions[${questionCount}][answers][3]" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-slate-400" placeholder="Pilihan D">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Jawaban Benar</label>
                            <select name="questions[${questionCount}][correct_answer]" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white">
                                <option value="0">A</option>
                                <option value="1">B</option>
                                <option value="2">C</option>
                                <option value="3">D</option>
                            </select>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newQuestion);
            questionCount++;
        }
        
        // Add first question on load
        addQuestion();
        
        // Dynamic level dropdown
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
                        levelSelect.innerHTML += `<option value="${level.id}">${level.title}</option>`;
                    });
                });
        });
    </script>
</body>
</html>
