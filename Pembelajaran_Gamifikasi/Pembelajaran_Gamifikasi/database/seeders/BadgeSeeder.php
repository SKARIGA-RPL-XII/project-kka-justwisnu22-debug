<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        $badges = [
            [
                'title' => 'Pemula Sejati',
                'level_requirement' => 1,
                'reward_title' => 'Rookie Developer'
            ],
            [
                'title' => 'Penjelajah Kode',
                'level_requirement' => 3,
                'reward_title' => 'Code Explorer'
            ],
            [
                'title' => 'Master Programmer',
                'level_requirement' => 5,
                'reward_title' => 'Programming Master'
            ],
            [
                'title' => 'Legenda Coding',
                'level_requirement' => 10,
                'reward_title' => 'Coding Legend'
            ]
        ];

        foreach ($badges as $badge) {
            Badge::firstOrCreate($badge);
        }
    }
}