<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuizCategory;

class QuizCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['easy', 'medium', 'hard'];
        
        foreach ($categories as $category) {
            QuizCategory::firstOrCreate(['name' => $category]);
        }
    }
}