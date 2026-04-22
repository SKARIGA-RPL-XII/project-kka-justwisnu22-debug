<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $quiz->title }} - AKU DEV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.3; }
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%      { transform: translateX(-6px); }
            40%      { transform: translateX(6px); }
            60%      { transform: translateX(-4px); }
            80%      { transform: translateX(4px); }
        }
        .timer-panic {
            animation: blink 0.6s ease-in-out infinite, shake 0.5s ease-in-out infinite;
            color: #dc2626 !important;
            background-color: #fee2e2 !important;
            border-color: #dc2626 !important;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">

    @if(isset($previousResult) && $previousResult)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Quiz Sudah Dikerjakan',
                html: `
                    <p>Anda sudah mengerjakan quiz ini sebelumnya.</p>
                    <p class="mt-2"><strong>Nilai Sebelumnya: {{ round($previousResult->score) }}%</strong></p>
                    <p class="mt-2 text-sm text-gray-600">Apakah Anda ingin mengerjakan ulang?</p>
                    <p class="text-xs text-gray-500 mt-2">*Hanya nilai tertinggi yang akan disimpan</p>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Kerjakan Ulang',
                cancelButtonText: 'Tidak, Kembali',
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#6b7280',
                allowOutsideClick: false
            }).then((result) => {
                if (!result.isConfirmed) {
                    window.location.href = '/belajar/{{ $quiz->category_id }}/{{ $quiz->level_id }}';
                }
            });
        });
    </script>
    @endif

    @php
        // Ambil timer dari soal pertama sebagai durasi satu quiz
        $quizTimer = $quiz->questions->first()->timer ?? 30;
    @endphp

    <div class="min-h-screen flex items-center justify-center py-8">
        <div class="max-w-3xl w-full mx-4">

            {{-- Quiz Header --}}
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
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                        <span>🏆 Reward: {{ $quiz->exp_reward }} EXP</span>
                        <span>❓ {{ $quiz->questions->count() }} Soal</span>
                    </div>

                    {{-- SATU TIMER untuk seluruh quiz --}}
                    <div id="quiz-timer"
                         class="flex items-center gap-2 px-4 py-2 rounded-full border-2 border-blue-400 bg-blue-50 text-blue-700 font-bold text-sm transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span id="timer-text">{{ $quizTimer }}s</span>
                    </div>
                </div>
            </div>

            {{-- Quiz Content --}}
            <div class="bg-white shadow-md p-8" id="quiz-container">
                @if(isset($result) && $result->score == 0)
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6">
                    <p class="font-semibold">Quiz Ulang</p>
                    <p class="text-sm">Anda pernah menjawab quiz ini dengan salah. Silakan coba lagi!</p>
                </div>
                @endif

                @php $questions = $quiz->questions; @endphp

                @foreach($questions as $qIndex => $question)
                <div class="mb-10">
                    <h2 class="text-lg font-semibold text-gray-800 mb-3">Soal {{ $qIndex + 1 }}:</h2>

                    <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-blue-500 mb-4">
                        <p class="text-gray-700 leading-relaxed">{{ $question->question }}</p>
                    </div>

                    <div class="space-y-3">
                        @foreach($question->shuffled_answers as $index => $answer)
                        <div class="answer-option p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-300 transition-colors"
                             data-question-id="{{ $question->id }}"
                             data-answer-id="{{ $answer->id }}">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full border-2 border-gray-300 flex items-center justify-center font-semibold text-gray-600">
                                    {{ chr(65 + $index) }}
                                </div>
                                <span class="text-gray-700">{{ $answer->answer }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach

                {{-- Result Message --}}
                <div id="result-message" class="mt-6 p-4 rounded-lg hidden">
                    <div id="result-content"></div>
                </div>
            </div>

            {{-- Quiz Footer --}}
            <div class="bg-white rounded-b-lg shadow-md p-6 border-t">
                <div class="flex justify-between items-center">
                    <a href="{{ route('materials.show', [$quiz->category_id, $quiz->level_id]) }}" class="text-gray-600 hover:text-gray-800">
                        ← Kembali ke Materi
                    </a>
                    <div class="text-sm text-gray-500">Pilih salah satu jawaban di atas</div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const answers        = {};
        const totalQuestions = {{ $quiz->questions->count() }};
        const categoryId     = {{ $quiz->category_id }};
        const levelId        = {{ $quiz->level_id }};
        const panicAt        = 10; // detik mulai efek panik

        // ── Satu countdown timer untuk seluruh quiz ────────────────────
        let remaining  = {{ $quizTimer }};
        const timerEl  = document.getElementById('quiz-timer');
        const textEl   = document.getElementById('timer-text');

        const countdown = setInterval(() => {
            remaining--;
            textEl.textContent = remaining + 's';

            // Efek panik saat <= 10 detik
            if (remaining <= panicAt) {
                timerEl.classList.add('timer-panic');
            }

            // Waktu habis — auto submit
            if (remaining <= 0) {
                clearInterval(countdown);
                textEl.textContent = '0s';
                submitQuiz();
            }
        }, 1000);

        // ── Pilih jawaban ──────────────────────────────────────────────
        document.querySelectorAll('.answer-option').forEach(option => {
            option.addEventListener('click', function () {
                const questionId = this.dataset.questionId;
                const answerId   = this.dataset.answerId;

                document.querySelectorAll(`[data-question-id="${questionId}"]`).forEach(opt => {
                    opt.classList.remove('border-blue-500', 'bg-blue-50');
                });
                this.classList.add('border-blue-500', 'bg-blue-50');
                answers[questionId] = answerId;

                // Auto submit jika semua soal sudah dijawab
                if (Object.keys(answers).length === totalQuestions) {
                    clearInterval(countdown);
                    submitQuiz();
                }
            });
        });

        // ── Submit quiz ke server ──────────────────────────────────────
        function submitQuiz() {
            clearInterval(countdown);

            // Nonaktifkan semua pilihan jawaban
            document.querySelectorAll('.answer-option').forEach(opt => {
                opt.style.pointerEvents = 'none';
            });

            fetch(`/quiz/${categoryId}/${levelId}/submit`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ answers })
            })
            .then(response => response.json())
            .then(data => {
                const resultDiv     = document.getElementById('result-message');
                const resultContent = document.getElementById('result-content');
                let message = '';

                if (data.is_new_record) {
                    if (data.passed) {
                        message = `
                            <div class="text-green-700">
                                <p class="font-semibold text-xl">🎉 Selamat! Anda Lulus!</p>
                                <p class="text-sm mt-2">Benar: ${data.correct}/${data.total} (${Math.round(data.score)}%)</p>
                                <p class="text-sm">EXP: +${data.earned_exp}</p>
                            </div>`;
                        resultDiv.className = 'mt-6 p-4 rounded-lg bg-green-100 border border-green-300';
                    } else {
                        message = `
                            <div class="text-red-700">
                                <p class="font-semibold text-xl">😔 ${data.message}</p>
                                <p class="text-sm mt-2">Benar: ${data.correct}/${data.total} (${Math.round(data.score)}%)</p>
                                <p class="text-sm">Minimal 75% untuk lulus</p>
                            </div>`;
                        resultDiv.className = 'mt-6 p-4 rounded-lg bg-red-100 border border-red-300';
                    }
                } else {
                    message = `
                        <div class="text-yellow-700">
                            <p class="font-semibold text-xl">📊 Nilai Tidak Berubah</p>
                            <p class="text-sm mt-2">Nilai Anda: ${Math.round(data.score)}%</p>
                            <p class="text-sm">Nilai Tertinggi: ${Math.round(data.previous_score)}%</p>
                            <p class="text-xs mt-2">Nilai tertinggi tetap disimpan</p>
                        </div>`;
                    resultDiv.className = 'mt-6 p-4 rounded-lg bg-yellow-100 border border-yellow-300';
                }

                resultContent.innerHTML = message;
                resultDiv.classList.remove('hidden');
                resultDiv.scrollIntoView({ behavior: 'smooth' });

                setTimeout(() => {
                    window.location.href = `/belajar/${categoryId}/${levelId}`;
                }, 3000);
            });
        }
    </script>
</body>
</html>
