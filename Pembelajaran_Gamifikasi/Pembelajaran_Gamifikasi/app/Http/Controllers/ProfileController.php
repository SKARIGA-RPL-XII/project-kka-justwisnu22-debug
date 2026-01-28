<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        $userBadges = $user->badges;
        return view('profile.edit', compact('user', 'userBadges'));
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
        
        if ($request->hasFile('photo_profile')) {
            if ($user->photo_profile) {
                Storage::delete('public/' . $user->photo_profile);
            }
            $path = $request->file('photo_profile')->store('profiles', 'public');
            $user->photo_profile = $path;
        }

        $user->username = $request->username;
        $user->title = $request->title;
        
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile berhasil diupdate!');
    }
}