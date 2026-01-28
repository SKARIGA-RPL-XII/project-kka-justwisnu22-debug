<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Support\Facades\Auth;

class UserBadgeController extends Controller
{
    public function index()
    {
        $badges = Badge::all();
        $userBadges = Auth::user()->badges->pluck('id')->toArray();
        
        return view('badges.index', compact('badges', 'userBadges'));
    }
}