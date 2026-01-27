<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizCategory;
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;
use Illuminate\Http\Request;

class AdminQuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('category')->get();
        return view('admin.quiz.index', compact('quizzes'));
    }

    public function create()
    {
        $categories = QuizCategory::all();
        return view('admin.quiz.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:quiz_categories,id',
            'exp_reward' => 'required|integer|min:1',
            'question' => 'required|string',
            'answers' => 'required|array|size:4',
            'answers.*' => 'required|string',
            'correct_answer' => 'required|integer|between:0,3'
        ]);

        $quiz = Quiz::create([
            'title' => $request->title,
            'description' => $request->title,
            'category_id' => $request->category_id,
            'exp_reward' => $request->exp_reward,
        ]);

        $question = QuizQuestion::create([
            'quiz_id' => $quiz->id,
            'question' => $request->question,
        ]);

        foreach ($request->answers as $index => $answer) {
            QuizAnswer::create([
                'question_id' => $question->id,
                'answer' => $answer,
                'is_correct' => $index == $request->correct_answer,
            ]);
        }

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz berhasil dibuat!');
    }

    public function edit($id)
    {
        $quiz = Quiz::with(['category', 'questions.answers'])->findOrFail($id);
        $categories = QuizCategory::all();
        return view('admin.quiz.edit', compact('quiz', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:quiz_categories,id',
            'exp_reward' => 'required|integer|min:1',
            'question' => 'required|string',
            'answers' => 'required|array|size:4',
            'answers.*' => 'required|string',
            'correct_answer' => 'required|integer|between:0,3'
        ]);

        $quiz = Quiz::findOrFail($id);
        $quiz->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'exp_reward' => $request->exp_reward,
        ]);

        $question = $quiz->questions()->first();
        $question->update(['question' => $request->question]);

        $question->answers()->delete();
        foreach ($request->answers as $index => $answer) {
            QuizAnswer::create([
                'question_id' => $question->id,
                'answer' => $answer,
                'is_correct' => $index == $request->correct_answer,
            ]);
        }

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz berhasil diupdate!');
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return redirect()->route('admin.quiz.index')->with('success', 'Quiz berhasil dihapus!');
    }
}