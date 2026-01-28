<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;

class AdminBadgeController extends Controller
{
    public function index()
    {
        $badges = Badge::all();
        return view('admin.badges.index', compact('badges'));
    }

    public function create()
    {
        return view('admin.badges.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'level_requirement' => 'required|integer|min:1',
            'reward_title' => 'required|string|max:255',
        ]);

        Badge::create($request->all());

        return redirect()->route('admin.badges.index')->with('success', 'Badge berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $badge = Badge::findOrFail($id);
        return view('admin.badges.edit', compact('badge'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'level_requirement' => 'required|integer|min:1',
            'reward_title' => 'required|string|max:255',
        ]);

        $badge = Badge::findOrFail($id);
        $badge->update($request->all());

        return redirect()->route('admin.badges.index')->with('success', 'Badge berhasil diupdate!');
    }

    public function destroy($id)
    {
        $badge = Badge::findOrFail($id);
        $badge->delete();

        return redirect()->route('admin.badges.index')->with('success', 'Badge berhasil dihapus!');
    }
}