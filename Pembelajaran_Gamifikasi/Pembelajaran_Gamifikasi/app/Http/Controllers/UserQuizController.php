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
        
        // Check if user already took this quiz
        $previousResult = UserQuizResult::where('user_id', Auth::id())
                                ->where('quiz_id', $quiz->id)
                                ->first();
        
        // Shuffle answers for each question
        $quiz->questions->each(function ($question) {
            $question->shuffled_answers = $question->answers->shuffle()->values();
        });
        
        return view('quiz.show', compact('quiz', 'previousResult'));
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
        $isPassed = $scorePercentage >= 75;
        
        // Get previous result
        $previousResult = UserQuizResult::where('user_id', Auth::id())
                                        ->where('quiz_id', $quiz->id)
                                        ->first();
        
        $shouldUpdate = false;
        $earnedExp = 0;
        
        if (!$previousResult) {
            // First attempt
            $shouldUpdate = true;
            $earnedExp = $isPassed ? $quiz->exp_reward : 0;
        } else {
            // Retake - only update if score is higher
            if ($scorePercentage > $previousResult->score) {
                $shouldUpdate = true;
                // Calculate EXP difference
                $oldExp = $previousResult->earned_exp;
                $newExp = $isPassed ? $quiz->exp_reward : 0;
                $earnedExp = $newExp - $oldExp;
            }
        }
        
        if ($shouldUpdate) {
            // Update or create result
            UserQuizResult::updateOrCreate(
                ['user_id' => Auth::id(), 'quiz_id' => $quiz->id],
                [
                    'score' => $scorePercentage,
                    'earned_exp' => $isPassed ? $quiz->exp_reward : 0,
                    'completed_at' => now(),
                ]
            );
            
            // Add EXP if earned
            $expResult = null;
            if ($earnedExp > 0) {
                $expResult = ExpService::addExp(Auth::user(), $earnedExp);
            }
            
            // Mark level as completed and unlock next if passed
            if ($isPassed) {
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
        }

        return response()->json([
            'passed' => $isPassed,
            'correct' => $correctAnswers,
            'total' => $totalQuestions,
            'score' => $scorePercentage,
            'earned_exp' => $shouldUpdate ? $earnedExp : 0,
            'is_new_record' => $shouldUpdate,
            'previous_score' => $previousResult ? $previousResult->score : null,
            'message' => $isPassed ? 'Selamat! Anda lulus!' : 'Pelajari lagi dan coba lagi!'
        ]);
    }
}