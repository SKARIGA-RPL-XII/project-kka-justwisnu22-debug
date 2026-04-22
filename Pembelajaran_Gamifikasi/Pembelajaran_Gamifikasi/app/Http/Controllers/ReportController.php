<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Material;
use App\Models\Category;
use App\Models\UserQuizResult;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Laporan user yang mendapat badge beserta tanggal
        $userBadges = Badge::with(['users' => function ($q) {
                $q->select('users.id', 'users.username')
                  ->orderByPivot('earned_at', 'desc');
            }])
            ->get()
            ->flatMap(function ($badge) {
                return $badge->users->map(fn($user) => [
                    'username'  => $user->username,
                    'badge'     => $badge->title,
                    'earned_at' => $user->pivot->earned_at,
                ]);
            })
            ->sortByDesc('earned_at')
            ->values();

        // Laporan jumlah materi per kategori
        $materialsPerCategory = Category::withCount('materials')->get();

        // Total quiz dikerjakan
        $totalQuizDone = UserQuizResult::count();

        return view('admin.reports.index', compact(
            'userBadges',
            'materialsPerCategory',
            'totalQuizDone'
        ));
    }
}
