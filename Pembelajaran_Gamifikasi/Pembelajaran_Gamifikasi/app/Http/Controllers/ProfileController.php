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
        
        // Get learning history with progress
        $learningHistory = \App\Models\UserProgress::with(['category', 'level.difficulty'])
            ->where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->get();
        
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
