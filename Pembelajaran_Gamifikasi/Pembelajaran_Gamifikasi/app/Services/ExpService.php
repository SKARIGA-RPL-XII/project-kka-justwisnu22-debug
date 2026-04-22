<?php

namespace App\Services;

use App\Models\User;
use App\Models\Badge;

class ExpService
{
    public static function addExp(User $user, int $exp): array
    {
        $oldLevel = $user->level;
        $user->exp += $exp;

        // Level up: setiap 100 EXP = 1 level
        $newLevel = (int) floor($user->exp / 100) + 1;
        $user->level = $newLevel;
        $user->save();

        // Cek dan berikan badge jika level naik
        $newBadges = [];
        if ($newLevel > $oldLevel) {
            $newBadges = self::awardBadges($user);
        }

        return [
            'old_level'   => $oldLevel,
            'new_level'   => $newLevel,
            'leveled_up'  => $newLevel > $oldLevel,
            'current_exp' => $user->exp,
            'exp_gained'  => $exp,
            'new_badges'  => $newBadges,
        ];
    }

    /**
     * Cek semua badge yang memenuhi syarat level user.
     * Hanya attach badge yang belum dimiliki (cegah duplikat).
     */
    public static function awardBadges(User $user): array
    {
        // Ambil badge yang syarat levelnya <= level user saat ini
        $eligibleBadges = Badge::where('level_requirement', '<=', $user->level)->get();

        // ID badge yang sudah dimiliki user
        $ownedBadgeIds = $user->badges()->pluck('badges.id')->toArray();

        $newBadges = [];
        foreach ($eligibleBadges as $badge) {
            if (!in_array($badge->id, $ownedBadgeIds)) {
                // Attach dengan earned_at
                $user->badges()->attach($badge->id, [
                    'earned_at'    => now(),
                    'is_displayed' => false,
                ]);
                $newBadges[] = $badge->title;
            }
        }

        return $newBadges;
    }

    public static function getExpForNextLevel(User $user): int
    {
        return ($user->level * 100) - $user->exp;
    }

    public static function getExpProgress(User $user): int
    {
        $expInCurrentLevel = $user->exp - (($user->level - 1) * 100);
        return min(100, ($expInCurrentLevel / 100) * 100);
    }
}