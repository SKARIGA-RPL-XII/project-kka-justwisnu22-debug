<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Quiz - AKU DEV</title>
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
                <h2 class="text-3xl font-bold text-white mb-2 font-bitter">Edit Quiz</h2>
                <p class="text-slate-400">Perbarui quiz pembelajaran</p>
            </div>

            @if ($errors->any())
            <div class="bg-red-500/20 border border-red-500/50 text-red-300 px-6 py-4 rounded-xl mb-6 backdrop-blur-sm shadow-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.quiz.update', $quiz->id) }}" class="bg-slate-800/30 backdrop-blur-sm border border-slate-700/50 rounded-2xl shadow-2xl overflow-hidden">
                @csrf
                @method('PUT')
                
                <div class="p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-3">Judul Quiz</label>
                            <input type="text" name="title" value="{{ old('title', $quiz->title) }}" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" placeholder="Masukkan judul quiz">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-3">Reward EXP</label>
                            <input type="number" name="exp_reward" value="{{ old('exp_reward', $quiz->exp_reward) }}" min="1" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" placeholder="Contoh: 50">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-3">Kategori</label>
                            <select name="category_id" id="category_id" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white transition-all duration-200">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $quiz->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-3">Tingkat</label>
                            <select name="level_id" id="level_id" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white transition-all duration-200">
                                <option value="">Pilih Tingkat</option>
                                @foreach($levels as $level)
                                <option value="{{ $level->id }}" {{ old('level_id', $quiz->level_id) == $level->id ? 'selected' : '' }}>{{ $level->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="p-8 border-t border-slate-700/50">
                    <h3 class="text-lg font-bold text-white mb-4">Soal</h3>
                    <textarea name="questions[0][question]" rows="4" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" placeholder="Tulis soal di sini...">{{ old('questions.0.question', $quiz->questions->first()->question ?? '') }}</textarea>
                </div>

                <div class="p-8 border-t border-slate-700/50">
                    <h3 class="text-lg font-bold text-white mb-2">Pilihan Jawaban</h3>
                    <p class="text-sm text-slate-400 mb-6">Pilih satu jawaban yang benar dengan mencentang radio button</p>
                    
                    @php
                        $answers = $quiz->questions->first()->answers ?? collect();
                        $correctIndex = $answers->search(function($answer) { return $answer->is_correct; });
                    @endphp
                    
                    <div class="space-y-4">
                        @foreach(['A', 'B', 'C', 'D'] as $index => $letter)
                        <div class="flex items-center gap-3 p-4 bg-slate-700/30 border border-slate-600/50 rounded-lg">
                            <input type="radio" name="questions[0][correct_answer]" value="{{ $index }}" id="correct_{{ $index }}" class="w-4 h-4 text-blue-600 focus:ring-blue-500" {{ old('questions.0.correct_answer', $correctIndex) == $index ? 'checked' : '' }} required>
                            <label for="correct_{{ $index }}" class="font-semibold text-slate-300 w-8">{{ $letter }}.</label>
                            <input type="text" name="questions[0][answers][{{ $index }}]" value="{{ old('questions.0.answers.' . $index, $answers->get($index)->answer ?? '') }}" required class="flex-1 px-4 py-2 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-slate-400" placeholder="Masukkan pilihan jawaban {{ $letter }}">
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="px-8 py-6 bg-slate-700/20 border-t border-slate-700/50 flex gap-3">
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold px-8 py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">Update Quiz</button>
                </div>
            </form>
        </main>
    </div>

    <script>
        // Dynamic level loading based on category
        document.getElementById('category_id').addEventListener('change', function() {
            const categoryId = this.value;
            const levelSelect = document.getElementById('level_id');
            
            levelSelect.innerHTML = '<option value="">Pilih Tingkat</option>';
            
            if (categoryId) {
                fetch(`/admin/categories/${categoryId}/levels`)
                    .then(response => response.json())
                    .then(levels => {
                        levels.forEach(level => {
                            const option = document.createElement('option');
                            option.value = level.id;
                            option.textContent = level.title;
                            levelSelect.appendChild(option);
                        });
                    });
            }
        });

        // Validation to ensure one correct answer is selected
        document.querySelector('form').addEventListener('submit', function(e) {
            const correctAnswer = document.querySelector('input[name="questions[0][correct_answer]"]:checked');
            if (!correctAnswer) {
                e.preventDefault();
                alert('Pilih satu jawaban yang benar!');
                return false;
            }
        });
    </script>
</body>
</html>
