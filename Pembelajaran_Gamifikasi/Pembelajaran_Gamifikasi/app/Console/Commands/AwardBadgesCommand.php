<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\ExpService;
use Illuminate\Console\Command;

class AwardBadgesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'badges:award {--user_id= : Award badges for specific user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Award badges to users based on their current level';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->option('user_id');

        if ($userId) {
            $user = User::find($userId);
            if (!$user) {
                $this->error("User with ID {$userId} not found.");
                return;
            }
            $users = collect([$user]);
        } else {
            $users = User::all();
        }

        $this->info("Awarding badges to " . $users->count() . " users...");

        $totalNewBadges = 0;
        foreach ($users as $user) {
            $newBadges = ExpService::awardBadges($user);
            if (!empty($newBadges)) {
                $this->line("User {$user->username} earned: " . implode(', ', $newBadges));
                $totalNewBadges += count($newBadges);
            }
        }

        $this->info("Total new badges awarded: {$totalNewBadges}");
    }
}
