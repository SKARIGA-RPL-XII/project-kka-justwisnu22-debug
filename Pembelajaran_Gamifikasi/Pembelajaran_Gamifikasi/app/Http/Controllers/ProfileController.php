<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        
        // Get learning history with all related data
        $learningHistory = \App\Models\UserProgress::with([
            'category', 
            'level.difficulty',
            'level.materials' => function($query) {
                $query->select('id', 'title', 'level_id', 'category_id', 'exp_reward');
            }
        ])
        ->where('user_id', $user->id)
        ->where('status', '!=', 'locked')
        ->orderBy('updated_at', 'desc')
        ->get()
        ->map(function($progress) use ($user) {
            $material = $progress->level->materials->first();
            
            // Check if EXP claimed
            $expClaimed = false;
            if ($material) {
                $materialProgress = \App\Models\UserMaterialProgress::where('user_id', $user->id)
                    ->where('material_id', $material->id)
                    ->first();
                $expClaimed = $materialProgress && $materialProgress->exp_claimed_at;
            }
            
            // Check quiz status
            $quiz = \App\Models\Quiz::where('category_id', $progress->category_id)
                ->where('level_id', $progress->level_id)
                ->first();
            
            $quizPassed = false;
            $quizScore = null;
            if ($quiz) {
                $quizResult = \App\Models\UserQuizResult::where('user_id', $user->id)
                    ->where('quiz_id', $quiz->id)
                    ->first();
                if ($quizResult) {
                    $quizPassed = $quizResult->score >= 75;
                    $quizScore = $quizResult->score;
                }
            }
            
            return [
                'category' => $progress->category->name,
                'level' => $progress->level->title,
                'difficulty' => $progress->level->difficulty->name,
                'material_title' => $material ? $material->title : '-',
                'last_accessed' => $progress->updated_at,
                'status' => $progress->status,
                'exp_claimed' => $expClaimed,
                'quiz_passed' => $quizPassed,
                'quiz_score' => $quizScore
            ];
        });
        
        return view('profile.show', compact('user', 'learningHistory'));
    }

    public function edit()
    {
        $user = Auth::user();
        // Get badges that user has earned based on level
        $earnedBadges = Badge::where('level_requirement', '<=', $user->level)->get();
        return view('profile.edit', compact('user', 'earnedBadges'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'title' => 'nullable|string|max:255',
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        /**
         * UPDATE PHOTO PROFILE (LONGBLOB)
         */
        if ($request->hasFile('photo_profile')) {
            $user->photo_profile = file_get_contents(
                $request->file('photo_profile')->getRealPath()
            );
        }

        $user->username = $request->username;
        $user->title = $request->title;

        /**
         * UPDATE PASSWORD (OPTIONAL)
         */
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('profile.show')
            ->with('success', 'Profile berhasil diupdate!');
    }

    public function photo($id)
{
    $user = User::findOrFail($id);

    if (!$user->photo_profile) {
        abort(404);
    }

    return response($user->photo_profile)
        ->header('Content-Type', 'image/jpeg');
}
}
