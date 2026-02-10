<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Material;
use App\Models\Badge;
use App\Models\Category;
use App\Models\CategoryLevel;

class AdminController extends Controller
{
    public function dashboard()
    {
        $quizCount = Quiz::count();
        $materialCount = Material::count();
        $badgeCount = Badge::count();
        $categoryCount = Category::count();

        return view('admin.dashboard', compact('quizCount', 'materialCount', 'badgeCount', 'categoryCount'));
    }

    // Materials CRUD
    public function materialsIndex()
    {
        $materials = Material::with(['category', 'level.difficulty'])->get();
        return view('admin.materials.index', compact('materials'));
    }

    public function materialsCreate()
    {
        $categories = Category::all();
        return view('admin.materials.create', compact('categories'));
    }

    public function materialsStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:category_levels,id'
        ]);

        Material::create($request->all());
        return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil ditambahkan');
    }

    public function materialsEdit($id)
    {
        $material = Material::findOrFail($id);
        $categories = Category::all();
        $levels = CategoryLevel::where('category_id', $material->category_id)->get();
        return view('admin.materials.edit', compact('material', 'categories', 'levels'));
    }

    public function materialsUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:category_levels,id'
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
