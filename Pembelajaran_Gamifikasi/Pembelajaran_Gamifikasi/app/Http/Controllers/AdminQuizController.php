<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Category;
use App\Models\CategoryLevel;
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;
use Illuminate\Http\Request;

class AdminQuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with(['category', 'level.difficulty'])->get();
        return view('admin.quiz.index', compact('quizzes'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.quiz.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:category_levels,id',
            'exp_reward' => 'required|integer|min:1',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string',
            'questions.*.answers' => 'required|array|size:4',
            'questions.*.answers.*' => 'required|string',
            'questions.*.correct_answer' => 'required|integer|between:0,3'
        ]);

        $quiz = Quiz::create([
            'title' => $request->title,
            'description' => $request->title,
            'category_id' => $request->category_id,
            'level_id' => $request->level_id,
            'exp_reward' => $request->exp_reward,
        ]);

        foreach ($request->questions as $questionData) {
            $question = QuizQuestion::create([
                'quiz_id' => $quiz->id,
                'question' => $questionData['question'],
            ]);

            foreach ($questionData['answers'] as $index => $answer) {
                QuizAnswer::create([
                    'question_id' => $question->id,
                    'answer' => $answer,
                    'is_correct' => $index == $questionData['correct_answer'],
                ]);
            }
        }

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz berhasil dibuat!');
    }

    public function edit($id)
    {
        $quiz = Quiz::with(['category', 'level', 'questions.answers'])->findOrFail($id);
        $categories = Category::all();
        $levels = CategoryLevel::where('category_id', $quiz->category_id)->get();
        return view('admin.quiz.edit', compact('quiz', 'categories', 'levels'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:category_levels,id',
            'exp_reward' => 'required|integer|min:1',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string',
            'questions.*.answers' => 'required|array|size:4',
            'questions.*.answers.*' => 'required|string',
            'questions.*.correct_answer' => 'required|integer|between:0,3'
        ]);

        $quiz = Quiz::findOrFail($id);
        $quiz->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'level_id' => $request->level_id,
            'exp_reward' => $request->exp_reward,
        ]);

        // Delete old questions
        $quiz->questions()->delete();

        // Create new questions
        foreach ($request->questions as $questionData) {
            $question = QuizQuestion::create([
                'quiz_id' => $quiz->id,
                'question' => $questionData['question'],
            ]);

            foreach ($questionData['answers'] as $index => $answer) {
                QuizAnswer::create([
                    'question_id' => $question->id,
                    'answer' => $answer,
                    'is_correct' => $index == $questionData['correct_answer'],
                ]);
            }
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