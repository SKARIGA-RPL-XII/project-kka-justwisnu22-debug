<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Difficulty;

class DifficultySeeder extends Seeder
{
    public function run(): void
    {
        $difficulties = [
            ['name' => 'Dasar'],
            ['name' => 'Pemula'],
            ['name' => 'Menengah'],
            ['name' => 'Mahir'],
        ];

        foreach ($difficulties as $difficulty) {
            Difficulty::firstOrCreate($difficulty);
        }
    }
}
