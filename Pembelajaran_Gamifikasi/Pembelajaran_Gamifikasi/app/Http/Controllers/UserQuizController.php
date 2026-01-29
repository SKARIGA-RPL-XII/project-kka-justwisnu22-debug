<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\UserQuizResult;
use App\Services\ExpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserQuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('category')->get();
        $categories = \App\Models\QuizCategory::all();
        return view('quiz.index', compact('quizzes', 'categories'));
    }

    public function show($id)
    {
        $quiz = Quiz::with(['questions.answers', 'category'])->findOrFail($id);
        
        // Check if user already completed this quiz
        $result = UserQuizResult::where('user_id', Auth::id())
                                ->where('quiz_id', $id)
                                ->first();
        
        if ($result && $result->score > 0) {
            return redirect()->route('quiz.index')->with('info', 'Anda sudah menyelesaikan quiz ini dengan benar!');
        }
        
        // Shuffle answers for each question with random seed
        $quiz->questions->each(function ($question) {
            $shuffled = $question->answers->shuffle();
            // Add random letter assignment
            $question->shuffled_answers = $shuffled->values();
        });
        
        return view('quiz.show', compact('quiz', 'result'));
    }

    public function submit(Request $request, $id)
    {
        $request->validate([
            'answer' => 'required|integer'
        ]);

        $quiz = Quiz::with(['questions.answers'])->findOrFail($id);
        $question = $quiz->questions->first();
        $selectedAnswer = $question->answers->where('id', $request->answer)->first();
        
        if (!$selectedAnswer) {
            return response()->json(['error' => 'Invalid answer'], 400);
        }

        $isCorrect = $selectedAnswer->is_correct;
        $earnedExp = $isCorrect ? $quiz->exp_reward : 0;
        
        // Delete previous result if exists (for retake)
        UserQuizResult::where('user_id', Auth::id())
                      ->where('quiz_id', $quiz->id)
                      ->delete();
        
        // Save new result
        UserQuizResult::create([
            'user_id' => Auth::id(),
            'quiz_id' => $quiz->id,
            'score' => $isCorrect ? 100 : 0,
            'earned_exp' => $earnedExp,
            'completed_at' => now(),
        ]);

        // Add EXP if correct
        $expResult = null;
        if ($earnedExp > 0) {
            $expResult = ExpService::addExp(Auth::user(), $earnedExp);
        }

        return response()->json([
            'correct' => $isCorrect,
            'earned_exp' => $earnedExp,
            'exp_result' => $expResult
        ]);
    }
}