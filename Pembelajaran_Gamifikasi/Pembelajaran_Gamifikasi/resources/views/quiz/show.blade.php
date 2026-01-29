<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $quiz->title }} - AKU DEV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex items-center justify-center py-8">
        <div class="max-w-3xl w-full mx-4">
            <!-- Quiz Header -->
            <div class="bg-white rounded-t-lg shadow-md p-6 border-b">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $quiz->title }}</h1>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                        @if($quiz->category->name == 'easy') bg-green-100 text-green-800
                        @elseif($quiz->category->name == 'medium') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst($quiz->category->name) }}
                    </span>
                </div>
                <div class="flex items-center space-x-4 text-sm text-gray-600">
                    <span>🏆 Reward: {{ $quiz->exp_reward }} EXP</span>
                    <span>❓ 1 Soal</span>
                </div>
            </div>

            <!-- Quiz Content -->
            <div class="bg-white shadow-md p-8" id="quiz-container">
                @if(isset($result) && $result->score == 0)
                    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6">
                        <p class="font-semibold">Quiz Ulang</p>
                        <p class="text-sm">Anda pernah menjawab quiz ini dengan salah. Silakan coba lagi!</p>
                    </div>
                @endif
                
                @php $question = $quiz->questions->first(); @endphp
                
                <!-- Question -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Soal:</h2>
                    <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-blue-500">
                        <p class="text-gray-700 leading-relaxed">{{ $question->question }}</p>
                    </div>
                </div>

                <!-- Answers -->
                <div class="space-y-3">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Pilihan Jawaban:</h3>
                    @foreach($question->shuffled_answers as $index => $answer)
                        <div class="answer-option p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-300 transition-colors"
                             data-answer-id="{{ $answer->id }}" data-is-correct="{{ $answer->is_correct ? 'true' : 'false' }}">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full border-2 border-gray-300 flex items-center justify-center font-semibold text-gray-600">
                                    {{ chr(65 + $index) }}
                                </div>
                                <span class="text-gray-700">{{ $answer->answer }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Result Message -->
                <div id="result-message" class="mt-6 p-4 rounded-lg hidden">
                    <div id="result-content"></div>
                </div>
            </div>

            <!-- Quiz Footer -->
            <div class="bg-white rounded-b-lg shadow-md p-6 border-t">
                <div class="flex justify-between items-center">
                    <a href="{{ route('quiz.index') }}" class="text-gray-600 hover:text-gray-800">
                        ← Kembali ke Daftar Quiz
                    </a>
                    <div class="text-sm text-gray-500">
                        Pilih salah satu jawaban di atas
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let answered = false;
        const quizId = {{ $quiz->id }};
        
        document.querySelectorAll('.answer-option').forEach(option => {
            option.addEventListener('click', function() {
                if (answered) return;
                
                const answerId = this.dataset.answerId;
                const isCorrect = this.dataset.isCorrect === 'true';
                
                // Disable further clicks
                answered = true;
                
                // Submit answer
                fetch(`/quiz/${quizId}/submit`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        answer: answerId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Show results
                    document.querySelectorAll('.answer-option').forEach(opt => {
                        const optAnswerId = opt.dataset.answerId;
                        const optIsCorrect = opt.dataset.isCorrect === 'true';
                        
                        if (optIsCorrect) {
                            // Correct answer - green
                            opt.classList.remove('border-gray-200', 'hover:border-blue-300');
                            opt.classList.add('border-green-500', 'bg-green-50');
                            opt.querySelector('.w-8').classList.add('bg-green-500', 'text-white', 'border-green-500');
                        } else if (optAnswerId == answerId && !data.correct) {
                            // Wrong selected answer - red
                            opt.classList.remove('border-gray-200', 'hover:border-blue-300');
                            opt.classList.add('border-red-500', 'bg-red-50');
                            opt.querySelector('.w-8').classList.add('bg-red-500', 'text-white', 'border-red-500');
                        } else {
                            // Other options - gray
                            opt.classList.add('opacity-50');
                        }
                        
                        opt.style.cursor = 'default';
                    });
                    
                    // Show result message
                    const resultDiv = document.getElementById('result-message');
                    const resultContent = document.getElementById('result-content');
                    
                    if (data.correct) {
                        resultContent.innerHTML = `
                            <div class="flex items-center space-x-2 text-green-700">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <p class="font-semibold">Benar! 🎉</p>
                                    <p class="text-sm">Anda mendapatkan ${data.earned_exp} EXP!</p>
                                    ${data.exp_result && data.exp_result.leveled_up ? 
                                        `<p class="text-sm font-semibold text-blue-600">🎊 Level Up! Level ${data.exp_result.new_level}</p>` : ''}
                                </div>
                            </div>
                        `;
                        resultDiv.className = 'mt-6 p-4 rounded-lg bg-green-100 border border-green-300';
                    } else {
                        resultContent.innerHTML = `
                            <div class="flex items-center space-x-2 text-red-700">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <p class="font-semibold">Salah! 😔</p>
                                    <p class="text-sm">Tidak mendapatkan EXP. Coba lagi next time!</p>
                                </div>
                            </div>
                        `;
                        resultDiv.className = 'mt-6 p-4 rounded-lg bg-red-100 border border-red-300';
                    }
                    
                    resultDiv.classList.remove('hidden');
                    
                    // Auto redirect after 3 seconds
                    setTimeout(() => {
                        window.location.href = '/quiz';
                    }, 3000);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                    answered = false;
                });
            });
        });
    </script>
</body>
</html>