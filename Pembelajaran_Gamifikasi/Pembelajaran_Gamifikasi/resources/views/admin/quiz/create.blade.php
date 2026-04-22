@extends('layouts.admin')

@section('title', 'Tambah Quiz - AKU DEV')

@section('content')
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.quiz.index') }}" class="bg-slate-700/50 hover:bg-slate-700 text-slate-300 hover:text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
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
            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-3">Durasi Timer Quiz (detik)</label>
                <input type="number" name="timer" required min="5" max="300" value="30" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" placeholder="Contoh: 30">
                <p class="text-xs text-slate-500 mt-1">Timer berlaku untuk seluruh soal dalam quiz ini. Minimal 5 detik, maksimal 300 detik.</p>
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
@endsection

@push('scripts')
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

    addQuestion();

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
@endpush
