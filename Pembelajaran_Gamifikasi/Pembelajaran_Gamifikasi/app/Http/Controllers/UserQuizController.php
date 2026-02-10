<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\UserQuizResult;
use App\Models\UserProgress;
use App\Models\CategoryLevel;
use App\Services\ExpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserQuizController extends Controller
{
    // Show quiz dari material page
    public function show($categoryId, $levelId)
    {
        $quiz = Quiz::with(['questions.answers', 'category', 'level'])
            ->where('category_id', $categoryId)
            ->where('level_id', $levelId)
            ->firstOrFail();
        
        // Check if user already passed this quiz (score >= 75)
        $result = UserQuizResult::where('user_id', Auth::id())
                                ->where('quiz_id', $quiz->id)
                                ->where('score', '>=', 75)
                                ->first();
        
        if ($result) {
            return redirect()->route('materials.show', [$categoryId, $levelId])
                ->with('info', 'Anda sudah menyelesaikan quiz ini dengan benar!');
        }
        
        // Shuffle answers for each question
        $quiz->questions->each(function ($question) {
            $question->shuffled_answers = $question->answers->shuffle()->values();
        });
        
        return view('quiz.show', compact('quiz'));
    }

    public function submit(Request $request, $categoryId, $levelId)
    {
        $request->validate([
            'answers' => 'required|array'
        ]);

        $quiz = Quiz::with(['questions.answers'])
            ->where('category_id', $categoryId)
            ->where('level_id', $levelId)
            ->firstOrFail();
        
        $totalQuestions = $quiz->questions->count();
        $correctAnswers = 0;
        
        // Check each answer
        foreach ($request->answers as $questionId => $answerId) {
            $question = $quiz->questions->where('id', $questionId)->first();
            if ($question) {
                $answer = $question->answers->where('id', $answerId)->first();
                if ($answer && $answer->is_correct) {
                    $correctAnswers++;
                }
            }
        }
        
        $scorePercentage = ($correctAnswers / $totalQuestions) * 100;
        $isPassed = $scorePercentage >= 75; // Minimal 75% untuk lulus
        $earnedExp = $isPassed ? $quiz->exp_reward : 0;
        
        // Delete previous result
        UserQuizResult::where('user_id', Auth::id())
                      ->where('quiz_id', $quiz->id)
                      ->delete();
        
        // Save result
        UserQuizResult::create([
            'user_id' => Auth::id(),
            'quiz_id' => $quiz->id,
            'score' => $scorePercentage,
            'earned_exp' => $earnedExp,
            'completed_at' => now(),
        ]);

        $expResult = null;
        if ($isPassed) {
            $expResult = ExpService::addExp(Auth::user(), $earnedExp);
            
            // Mark level as completed
            UserProgress::updateOrCreate(
                ['user_id' => Auth::id(), 'level_id' => $levelId],
                ['category_id' => $categoryId, 'status' => 'completed']
            );
            
            // Unlock next level
            $currentLevel = CategoryLevel::findOrFail($levelId);
            $nextLevel = CategoryLevel::where('category_id', $categoryId)
                ->where('order', $currentLevel->order + 1)
                ->first();
            
            if ($nextLevel) {
                UserProgress::firstOrCreate(
                    ['user_id' => Auth::id(), 'level_id' => $nextLevel->id],
                    ['category_id' => $categoryId, 'status' => 'ongoing']
                );
            }
        }

        return response()->json([
            'passed' => $isPassed,
            'correct' => $correctAnswers,
            'total' => $totalQuestions,
            'score' => $scorePercentage,
            'earned_exp' => $earnedExp,
            'exp_result' => $expResult,
            'message' => $isPassed ? 'Selamat! Anda lulus!' : ($correctAnswers >= $totalQuestions - 2 ? 'Pelajari lagi!' : 'Anda harus mengerjakan ulang!')
        ]);
    }
}