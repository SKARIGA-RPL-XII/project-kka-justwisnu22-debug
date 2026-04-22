@extends('layouts.admin')

@section('title', 'Edit Quiz - AKU DEV')

@section('content')
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.quiz.index') }}" class="bg-slate-700/50 hover:bg-slate-700 text-slate-300 hover:text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
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
        @csrf @method('PUT')

        {{-- Info Quiz --}}
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
            {{-- Timer satu untuk seluruh quiz --}}
            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-3">Durasi Timer Quiz (detik)</label>
                <input type="number" name="timer" value="{{ old('timer', $quiz->questions->first()->timer ?? 30) }}" required min="5" max="300" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" placeholder="Contoh: 30">
                <p class="text-xs text-slate-500 mt-1">Timer berlaku untuk seluruh soal dalam quiz ini. Minimal 5 detik, maksimal 300 detik.</p>
            </div>
        </div>

        {{-- Daftar semua soal --}}
        <div class="p-8 border-t border-slate-700/50">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-white">Soal</h3>
                <button type="button" onclick="addQuestion()" class="px-4 py-2 bg-green-600/80 hover:bg-green-600 text-white rounded-lg transition-all duration-200 font-semibold text-sm">+ Tambah Soal</button>
            </div>

            <div id="questions-container" class="space-y-8">
                @foreach($quiz->questions as $qIndex => $question)
                @php
                    $qAnswers     = $question->answers;
                    $correctIndex = $qAnswers->search(fn($a) => $a->is_correct);
                @endphp
                <div class="question-item bg-slate-700/30 border border-slate-600/50 rounded-xl p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-white font-bold">Soal {{ $qIndex + 1 }}</h4>
                        @if($qIndex > 0)
                        <button type="button" onclick="this.closest('.question-item').remove()" class="text-red-400 hover:text-red-300 font-semibold text-sm">Hapus</button>
                        @endif
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Pertanyaan</label>
                            <textarea name="questions[{{ $qIndex }}][question]" rows="3" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" placeholder="Tulis soal di sini...">{{ old("questions.$qIndex.question", $question->question) }}</textarea>
                        </div>
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-slate-300">Pilihan Jawaban</label>
                            @foreach(['A','B','C','D'] as $i => $letter)
                            <div class="flex items-center gap-3 p-3 bg-slate-700/30 border border-slate-600/50 rounded-lg">
                                <input type="radio" name="questions[{{ $qIndex }}][correct_answer]" value="{{ $i }}" id="correct_{{ $qIndex }}_{{ $i }}" class="w-4 h-4 text-blue-600 focus:ring-blue-500" {{ old("questions.$qIndex.correct_answer", $correctIndex) == $i ? 'checked' : '' }} required>
                                <label for="correct_{{ $qIndex }}_{{ $i }}" class="font-semibold text-slate-300 w-6">{{ $letter }}.</label>
                                <input type="text" name="questions[{{ $qIndex }}][answers][{{ $i }}]" value="{{ old("questions.$qIndex.answers.$i", $qAnswers->get($i)->answer ?? '') }}" required class="flex-1 px-3 py-2 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-slate-400" placeholder="Pilihan {{ $letter }}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="px-8 py-6 bg-slate-700/20 border-t border-slate-700/50 flex gap-3">
            <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold px-8 py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">Update Quiz</button>
            <a href="{{ route('admin.quiz.index') }}" class="bg-slate-700/50 hover:bg-slate-700 text-slate-300 hover:text-white px-8 py-3 rounded-lg transition-all duration-200 font-semibold flex items-center">Batal</a>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    let questionCount = {{ $quiz->questions->count() }};

    function addQuestion() {
        const container = document.getElementById('questions-container');
        const html = `
            <div class="question-item bg-slate-700/30 border border-slate-600/50 rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-white font-bold">Soal ${questionCount + 1}</h4>
                    <button type="button" onclick="this.closest('.question-item').remove()" class="text-red-400 hover:text-red-300 font-semibold text-sm">Hapus</button>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">Pertanyaan</label>
                        <textarea name="questions[${questionCount}][question]" rows="3" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-slate-400" placeholder="Tulis soal di sini..."></textarea>
                    </div>
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-slate-300">Pilihan Jawaban</label>
                        ${['A','B','C','D'].map((letter, i) => `
                        <div class="flex items-center gap-3 p-3 bg-slate-700/30 border border-slate-600/50 rounded-lg">
                            <input type="radio" name="questions[${questionCount}][correct_answer]" value="${i}" class="w-4 h-4 text-blue-600 focus:ring-blue-500" required>
                            <span class="font-semibold text-slate-300 w-6">${letter}.</span>
                            <input type="text" name="questions[${questionCount}][answers][${i}]" required class="flex-1 px-3 py-2 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-slate-400" placeholder="Pilihan ${letter}">
                        </div>`).join('')}
                    </div>
                </div>
            </div>`;
        container.insertAdjacentHTML('beforeend', html);
        questionCount++;
    }

    document.getElementById('category_id').addEventListener('change', function() {
        const categoryId = this.value;
        const levelSelect = document.getElementById('level_id');
        levelSelect.innerHTML = '<option value="">Pilih Tingkat</option>';
        if (categoryId) {
            fetch(`/admin/categories/${categoryId}/levels`)
                .then(res => res.json())
                .then(levels => {
                    levels.forEach(level => {
                        levelSelect.innerHTML += `<option value="${level.id}">${level.title}</option>`;
                    });
                });
        }
    });
</script>
@endpush
