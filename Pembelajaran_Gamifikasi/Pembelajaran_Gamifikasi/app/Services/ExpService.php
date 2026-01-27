<?php

namespace App\Services;

use App\Models\User;

class ExpService
{
    public static function addExp(User $user, int $exp): array
    {
        $oldLevel = $user->level;
        $user->exp += $exp;
        
        // Level up logic: setiap 100 EXP = 1 level
        $newLevel = floor($user->exp / 100) + 1;
        $user->level = $newLevel;
        
        $user->save();
        
        return [
            'old_level' => $oldLevel,
            'new_level' => $newLevel,
            'leveled_up' => $newLevel > $oldLevel,
            'current_exp' => $user->exp,
            'exp_gained' => $exp
        ];
    }
    
    public static function getExpForNextLevel(User $user): int
    {
        $currentLevelExp = ($user->level - 1) * 100;
        $nextLevelExp = $user->level * 100;
        return $nextLevelExp - $user->exp;
    }
    
    public static function getExpProgress(User $user): int
    {
        $currentLevelExp = ($user->level - 1) * 100;
        $expInCurrentLevel = $user->exp - $currentLevelExp;
        return min(100, ($expInCurrentLevel / 100) * 100);
    }
}