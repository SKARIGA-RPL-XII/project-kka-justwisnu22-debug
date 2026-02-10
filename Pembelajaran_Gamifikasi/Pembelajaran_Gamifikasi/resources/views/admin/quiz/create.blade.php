<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Quiz - Admin</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Tambah Quiz Baru</h1>
        
        <form action="{{ route('admin.quiz.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
            @csrf
            
            <div class="mb-4">
                <label class="block font-semibold mb-2">Judul Quiz</label>
                <input type="text" name="title" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div class="mb-4">
                <label class="block font-semibold mb-2">Kategori</label>
                <select name="category_id" id="category_id" required class="w-full border rounded px-3 py-2">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block font-semibold mb-2">Tingkat</label>
                <select name="level_id" id="level_id" required class="w-full border rounded px-3 py-2">
                    <option value="">Pilih Kategori Dulu</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block font-semibold mb-2">EXP Reward</label>
                <input type="number" name="exp_reward" required min="1" class="w-full border rounded px-3 py-2">
            </div>
            
            <div id="questions-container">
                <div class="question-item border-2 border-blue-200 rounded p-4 mb-4">
                    <h3 class="font-bold mb-3">Soal 1</h3>
                    <div class="mb-3">
                        <label class="block font-semibold mb-2">Pertanyaan</label>
                        <textarea name="questions[0][question]" required class="w-full border rounded px-3 py-2" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="block font-semibold mb-2">Jawaban A</label>
                        <input type="text" name="questions[0][answers][0]" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-3">
                        <label class="block font-semibold mb-2">Jawaban B</label>
                        <input type="text" name="questions[0][answers][1]" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-3">
                        <label class="block font-semibold mb-2">Jawaban C</label>
                        <input type="text" name="questions[0][answers][2]" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-3">
                        <label class="block font-semibold mb-2">Jawaban D</label>
                        <input type="text" name="questions[0][answers][3]" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-3">
                        <label class="block font-semibold mb-2">Jawaban Benar</label>
                        <select name="questions[0][correct_answer]" required class="w-full border rounded px-3 py-2">
                            <option value="0">A</option>
                            <option value="1">B</option>
                            <option value="2">C</option>
                            <option value="3">D</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <button type="button" onclick="addQuestion()" class="mb-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                + Tambah Soal
            </button>
            
            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                <a href="{{ route('admin.quiz.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</a>
            </div>
        </form>
    </div>
    
    <script>
        let questionCount = 1;
        
        function addQuestion() {
            const container = document.getElementById('questions-container');
            const newQuestion = `
                <div class="question-item border-2 border-blue-200 rounded p-4 mb-4">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-bold">Soal ${questionCount + 1}</h3>
                        <button type="button" onclick="this.closest('.question-item').remove()" class="text-red-600 hover:text-red-800">Hapus</button>
                    </div>
                    <div class="mb-3">
                        <label class="block font-semibold mb-2">Pertanyaan</label>
                        <textarea name="questions[${questionCount}][question]" required class="w-full border rounded px-3 py-2" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="block font-semibold mb-2">Jawaban A</label>
                        <input type="text" name="questions[${questionCount}][answers][0]" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-3">
                        <label class="block font-semibold mb-2">Jawaban B</label>
                        <input type="text" name="questions[${questionCount}][answers][1]" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-3">
                        <label class="block font-semibold mb-2">Jawaban C</label>
                        <input type="text" name="questions[${questionCount}][answers][2]" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-3">
                        <label class="block font-semibold mb-2">Jawaban D</label>
                        <input type="text" name="questions[${questionCount}][answers][3]" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-3">
                        <label class="block font-semibold mb-2">Jawaban Benar</label>
                        <select name="questions[${questionCount}][correct_answer]" required class="w-full border rounded px-3 py-2">
                            <option value="0">A</option>
                            <option value="1">B</option>
                            <option value="2">C</option>
                            <option value="3">D</option>
                        </select>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newQuestion);
            questionCount++;
        }
        
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
                        levelSelect.innerHTML += `<option value="${level.id}">${level.title} (${level.difficulty.name})</option>`;
                    });
                });
        });
    </script>
</body>
</html>
