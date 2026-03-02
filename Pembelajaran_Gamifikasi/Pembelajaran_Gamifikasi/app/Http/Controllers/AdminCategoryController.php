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
        try {
            $data = ['name' => $request->name];
            
            if ($request->hasFile('foto_kategori')) {
                $file = $request->file('foto_kategori');
                $extension = strtolower($file->getClientOriginalExtension());
                
                if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    return back()->withErrors(['foto_kategori' => 'File harus berformat JPG, JPEG, atau PNG']);
                }
                
                $data['foto_kategori'] = file_get_contents($file->getRealPath());
            }

            $category = Category::create($data);

            foreach ($request->levels as $index => $levelData) {
                CategoryLevel::create([
                    'category_id' => $category->id,
                    'title' => $levelData['title'],
                    'difficulty_id' => $levelData['difficulty_id'],
                    'order' => $index + 1
                ]);
            }

            return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $category = Category::with('levels')->findOrFail($id);
        $difficulties = Difficulty::all();
        return view('admin.categories.edit', compact('category', 'difficulties'));
    }

    public function update(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            
            $data = ['name' => $request->name];
            
            if ($request->hasFile('foto_kategori')) {
                $file = $request->file('foto_kategori');
                $extension = strtolower($file->getClientOriginalExtension());
                
                if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    return back()->withErrors(['foto_kategori' => 'File harus berformat JPG, JPEG, atau PNG']);
                }
                
                $data['foto_kategori'] = file_get_contents($file->getRealPath());
            }
            
            $category->update($data);

            foreach ($request->levels as $index => $levelData) {
                if (isset($levelData['id']) && !empty($levelData['id'])) {
                    CategoryLevel::where('id', $levelData['id'])->update([
                        'title' => $levelData['title'],
                        'difficulty_id' => $levelData['difficulty_id'],
                        'order' => $index + 1
                    ]);
                } else {
                    CategoryLevel::create([
                        'category_id' => $category->id,
                        'title' => $levelData['title'],
                        'difficulty_id' => $levelData['difficulty_id'],
                        'order' => $index + 1
                    ]);
                }
            }

            return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diupdate');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
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
