<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryLevel;
use App\Models\Difficulty;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('levels.difficulty')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $difficulties = Difficulty::all();
        return view('admin.categories.create', compact('difficulties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'levels' => 'required|array|min:1',
            'levels.*.title' => 'required|string|max:255',
            'levels.*.difficulty_id' => 'required|exists:difficulties,id'
        ]);

        $category = Category::create(['name' => $request->name]);

        foreach ($request->levels as $index => $levelData) {
            CategoryLevel::create([
                'category_id' => $category->id,
                'title' => $levelData['title'],
                'difficulty_id' => $levelData['difficulty_id'],
                'order' => $index + 1
            ]);
        }

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $category = Category::with('levels')->findOrFail($id);
        $difficulties = Difficulty::all();
        return view('admin.categories.edit', compact('category', 'difficulties'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'levels' => 'required|array|min:1',
            'levels.*.title' => 'required|string|max:255',
            'levels.*.difficulty_id' => 'required|exists:difficulties,id'
        ]);

        $category = Category::findOrFail($id);
        $category->update(['name' => $request->name]);

        // Delete old levels
        $category->levels()->delete();

        // Create new levels
        foreach ($request->levels as $index => $levelData) {
            CategoryLevel::create([
                'category_id' => $category->id,
                'title' => $levelData['title'],
                'difficulty_id' => $levelData['difficulty_id'],
                'order' => $index + 1
            ]);
        }

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus');
    }

    // API endpoint untuk mendapatkan levels berdasarkan category
    public function getLevels($categoryId)
    {
        $levels = CategoryLevel::where('category_id', $categoryId)
            ->with('difficulty')
            ->orderBy('order')
            ->get();
        
        return response()->json($levels);
    }
}
