<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\QuizCategory;
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $easyCategory = QuizCategory::where('name', 'easy')->first();
        $mediumCategory = QuizCategory::where('name', 'medium')->first();
        $hardCategory = QuizCategory::where('name', 'hard')->first();

        // Quiz 1 - Easy
        $quiz1 = Quiz::create([
            'title' => 'HTML Dasar',
            'description' => 'Quiz tentang dasar-dasar HTML',
            'category_id' => $easyCategory->id,
            'exp_reward' => 25,
        ]);

        $question1 = QuizQuestion::create([
            'quiz_id' => $quiz1->id,
            'question' => 'Apa kepanjangan dari HTML?',
        ]);

        QuizAnswer::create(['question_id' => $question1->id, 'answer' => 'HyperText Markup Language', 'is_correct' => true]);
        QuizAnswer::create(['question_id' => $question1->id, 'answer' => 'High Tech Modern Language', 'is_correct' => false]);
        QuizAnswer::create(['question_id' => $question1->id, 'answer' => 'Home Tool Markup Language', 'is_correct' => false]);
        QuizAnswer::create(['question_id' => $question1->id, 'answer' => 'Hyperlink and Text Markup Language', 'is_correct' => false]);

        // Quiz 2 - Medium
        $quiz2 = Quiz::create([
            'title' => 'CSS Styling',
            'description' => 'Quiz tentang CSS dan styling',
            'category_id' => $mediumCategory->id,
            'exp_reward' => 50,
        ]);

        $question2 = QuizQuestion::create([
            'quiz_id' => $quiz2->id,
            'question' => 'Property CSS mana yang digunakan untuk mengubah warna teks?',
        ]);

        QuizAnswer::create(['question_id' => $question2->id, 'answer' => 'color', 'is_correct' => true]);
        QuizAnswer::create(['question_id' => $question2->id, 'answer' => 'text-color', 'is_correct' => false]);
        QuizAnswer::create(['question_id' => $question2->id, 'answer' => 'font-color', 'is_correct' => false]);
        QuizAnswer::create(['question_id' => $question2->id, 'answer' => 'background-color', 'is_correct' => false]);

        // Quiz 3 - Hard
        $quiz3 = Quiz::create([
            'title' => 'JavaScript Advanced',
            'description' => 'Quiz tentang JavaScript tingkat lanjut',
            'category_id' => $hardCategory->id,
            'exp_reward' => 100,
        ]);

        $question3 = QuizQuestion::create([
            'quiz_id' => $quiz3->id,
            'question' => 'Apa output dari: console.log(typeof null)?',
        ]);

        QuizAnswer::create(['question_id' => $question3->id, 'answer' => 'object', 'is_correct' => true]);
        QuizAnswer::create(['question_id' => $question3->id, 'answer' => 'null', 'is_correct' => false]);
        QuizAnswer::create(['question_id' => $question3->id, 'answer' => 'undefined', 'is_correct' => false]);
        QuizAnswer::create(['question_id' => $question3->id, 'answer' => 'string', 'is_correct' => false]);
    }
}