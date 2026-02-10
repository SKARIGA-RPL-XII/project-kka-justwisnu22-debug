<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryLevel;
use App\Models\Difficulty;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $difficulties = Difficulty::all()->keyBy('name');
        
        $categories = [
            [
                'name' => 'Front End Web',
                'levels' => [
                    ['title' => 'Pengenalan HTML & CSS', 'difficulty' => 'Dasar'],
                    ['title' => 'JavaScript Dasar', 'difficulty' => 'Pemula'],
                    ['title' => 'Framework Modern', 'difficulty' => 'Menengah'],
                ]
            ],
            [
                'name' => 'Back End Web',
                'levels' => [
                    ['title' => 'Pengenalan PHP', 'difficulty' => 'Dasar'],
                    ['title' => 'Database MySQL', 'difficulty' => 'Pemula'],
                    ['title' => 'Laravel Framework', 'difficulty' => 'Menengah'],
                ]
            ],
            [
                'name' => 'UI/UX',
                'levels' => [
                    ['title' => 'Prinsip Desain', 'difficulty' => 'Dasar'],
                    ['title' => 'Wireframing & Prototyping', 'difficulty' => 'Pemula'],
                ]
            ],
            [
                'name' => 'Android',
                'levels' => [
                    ['title' => 'Pengenalan Android', 'difficulty' => 'Dasar'],
                    ['title' => 'Kotlin Programming', 'difficulty' => 'Pemula'],
                ]
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::firstOrCreate(['name' => $categoryData['name']]);
            
            foreach ($categoryData['levels'] as $index => $levelData) {
                CategoryLevel::firstOrCreate(
                    [
                        'category_id' => $category->id,
                        'title' => $levelData['title']
                    ],
                    [
                        'difficulty_id' => $difficulties[$levelData['difficulty']]->id,
                        'order' => $index + 1
                    ]
                );
            }
        }
    }
}
