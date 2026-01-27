<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buat Quiz - AKU DEV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <nav class="bg-[#0F172A] text-white p-4">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold">Admin Panel</h1>
            <div class="flex items-center gap-4">
                <span>{{ Auth::user()->username }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 px-3 py-1 rounded">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="flex">
        <aside class="w-64 bg-white shadow-md min-h-screen">
            <nav class="p-4">
                <ul class="space-y-2">
                    <li><a href="{{ route('admin.dashboard') }}" class="block p-2 hover:bg-gray-100 rounded">Dashboard</a></li>
                    <li><a href="{{ route('admin.quiz.index') }}" class="block p-2 bg-gray-100 rounded">Quiz</a></li>
                    <li><a href="{{ route('admin.materials.index') }}" class="block p-2 hover:bg-gray-100 rounded">Materi</a></li>
                    <li><a href="{{ route('admin.badges.index') }}" class="block p-2 hover:bg-gray-100 rounded">Badge</a></li>
                </ul>
            </nav>
        </aside>

        <main class="flex-1 p-6">
            <div class="max-w-4xl mx-auto">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Buat Quiz Baru</h2>
                    <a href="{{ route('admin.quiz.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.quiz.store') }}" class="bg-white rounded-lg shadow-md">
                    @csrf
                    
                    <!-- Quiz Info Section -->
                    <div class="p-6 border-b">
                        <h3 class="text-lg font-semibold mb-4">Informasi Quiz</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Quiz</label>
                                <input type="text" name="title" value="{{ old('title') }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                       placeholder="Masukkan judul quiz" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tingkat Kesulitan</label>
                                <select name="category_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    <option value="">Pilih Kesulitan</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ ucfirst($category->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Reward EXP</label>
                                <input type="number" name="exp_reward" value="{{ old('exp_reward') }}" min="1" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                       placeholder="Contoh: 50" required>
                            </div>
                        </div>
                    </div>

                    <!-- Question Section -->
                    <div class="p-6 border-b">
                        <h3 class="text-lg font-semibold mb-4">Soal</h3>
                        <textarea name="question" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                  placeholder="Tulis soal di sini..." required>{{ old('question') }}</textarea>
                    </div>

                    <!-- Answers Section -->
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Pilihan Jawaban</h3>
                        <p class="text-sm text-gray-600 mb-4">Pilih satu jawaban yang benar dengan mencentang radio button</p>
                        
                        <div class="space-y-4">
                            @foreach(['A', 'B', 'C', 'D'] as $index => $letter)
                                <div class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg">
                                    <input type="radio" name="correct_answer" value="{{ $index }}" 
                                           id="correct_{{ $index }}" 
                                           class="w-4 h-4 text-blue-600 focus:ring-blue-500" 
                                           {{ old('correct_answer') == $index ? 'checked' : '' }} required>
                                    <label for="correct_{{ $index }}" class="font-medium text-gray-700 w-8">{{ $letter }}.</label>
                                    <input type="text" name="answers[{{ $index }}]" 
                                           value="{{ old('answers.' . $index) }}" 
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                           placeholder="Masukkan pilihan jawaban {{ $letter }}" required>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="px-6 py-4 bg-gray-50 rounded-b-lg">
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Simpan Quiz
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        // Validation to ensure one correct answer is selected
        document.querySelector('form').addEventListener('submit', function(e) {
            const correctAnswer = document.querySelector('input[name="correct_answer"]:checked');
            if (!correctAnswer) {
                e.preventDefault();
                alert('Pilih satu jawaban yang benar!');
                return false;
            }
        });
    </script>
</body>
</html>