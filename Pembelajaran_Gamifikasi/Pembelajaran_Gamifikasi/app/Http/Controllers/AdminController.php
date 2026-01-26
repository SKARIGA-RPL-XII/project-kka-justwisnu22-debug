<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Material;
use App\Models\Badge;

class AdminController extends Controller
{
    public function dashboard()
    {
        $quizCount = Quiz::count();
        $materialCount = Material::count();
        $badgeCount = Badge::count();

        return view('admin.dashboard', compact('quizCount', 'materialCount', 'badgeCount'));
    }

    // Quiz CRUD
    public function quizIndex()
    {
        $quizzes = Quiz::all();
        return view('admin.quiz.index', compact('quizzes'));
    }

    public function quizCreate()
    {
        return view('admin.quiz.create');
    }

    public function quizStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'difficulty' => 'required|in:easy,medium,hard',
            'description' => 'required|string',
        ]);

        Quiz::create($request->all());
        return redirect()->route('admin.quiz.index')->with('success', 'Quiz berhasil ditambahkan');
    }

    public function quizEdit($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('admin.quiz.edit', compact('quiz'));
    }

    public function quizUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'difficulty' => 'required|in:easy,medium,hard',
            'description' => 'required|string',
        ]);

        $quiz = Quiz::findOrFail($id);
        $quiz->update($request->all());
        return redirect()->route('admin.quiz.index')->with('success', 'Quiz berhasil diupdate');
    }

    public function quizDestroy($id)
    {
        Quiz::findOrFail($id)->delete();
        return redirect()->route('admin.quiz.index')->with('success', 'Quiz berhasil dihapus');
    }

    // Materials CRUD
    public function materialsIndex()
    {
        $materials = Material::all();
        return view('admin.materials.index', compact('materials'));
    }

    public function materialsCreate()
    {
        return view('admin.materials.create');
    }

    public function materialsStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'content' => 'required|string',
        ]);

        Material::create($request->all());
        return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil ditambahkan');
    }

    public function materialsEdit($id)
    {
        $material = Material::findOrFail($id);
        return view('admin.materials.edit', compact('material'));
    }

    public function materialsUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'content' => 'required|string',
        ]);

        $material = Material::findOrFail($id);
        $material->update($request->all());
        return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil diupdate');
    }

    public function materialsDestroy($id)
    {
        Material::findOrFail($id)->delete();
        return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil dihapus');
    }

    // Badges CRUD
    public function badgesIndex()
    {
        $badges = Badge::all();
        return view('admin.badges.index', compact('badges'));
    }

    public function badgesCreate()
    {
        return view('admin.badges.create');
    }

    public function badgesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
        ]);

        Badge::create($request->all());
        return redirect()->route('admin.badges.index')->with('success', 'Badge berhasil ditambahkan');
    }

    public function badgesEdit($id)
    {
        $badge = Badge::findOrFail($id);
        return view('admin.badges.edit', compact('badge'));
    }

    public function badgesUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
        ]);

        $badge = Badge::findOrFail($id);
        $badge->update($request->all());
        return redirect()->route('admin.badges.index')->with('success', 'Badge berhasil diupdate');
    }

    public function badgesDestroy($id)
    {
        Badge::findOrFail($id)->delete();
        return redirect()->route('admin.badges.index')->with('success', 'Badge berhasil dihapus');
    }
}
