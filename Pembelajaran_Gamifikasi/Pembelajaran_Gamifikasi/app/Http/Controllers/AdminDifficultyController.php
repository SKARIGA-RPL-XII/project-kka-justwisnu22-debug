<?php

namespace App\Http\Controllers;

use App\Models\Difficulty;
use Illuminate\Http\Request;

class AdminDifficultyController extends Controller
{
    public function index()
    {
        $difficulties = Difficulty::all();
        return view('admin.difficulties.index', compact('difficulties'));
    }

    public function create()
    {
        return view('admin.difficulties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:difficulties,name'
        ]);

        Difficulty::create($request->all());
        return redirect()->route('admin.difficulties.index')->with('success', 'Tingkat kesulitan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $difficulty = Difficulty::findOrFail($id);
        return view('admin.difficulties.edit', compact('difficulty'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:difficulties,name,' . $id
        ]);

        $difficulty = Difficulty::findOrFail($id);
        $difficulty->update($request->all());
        return redirect()->route('admin.difficulties.index')->with('success', 'Tingkat kesulitan berhasil diupdate');
    }

    public function destroy($id)
    {
        Difficulty::findOrFail($id)->delete();
        return redirect()->route('admin.difficulties.index')->with('success', 'Tingkat kesulitan berhasil dihapus');
    }
}
