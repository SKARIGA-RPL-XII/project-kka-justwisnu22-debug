<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Category;
use App\Models\CategoryLevel;
use App\Models\Quiz;
use App\Models\UserProgress;
use Illuminate\Support\Facades\Auth;
use App\Models\UserMaterialProgress;
use App\Services\ExpService;

class MaterialController extends Controller
{
    // Halaman Belajar - Tampilkan kategori
    public function index()
    {
        $categories = Category::with('levels')->get();
        
        // Hitung progress per kategori untuk user yang login
        if (Auth::check()) {
            foreach ($categories as $category) {
                $totalLevels = $category->levels->count();
                $completedLevels = UserProgress::where('user_id', Auth::id())
                    ->where('category_id', $category->id)
                    ->where('status', 'completed')
                    ->count();
                
                $category->progress_percentage = $totalLevels > 0 ? round(($completedLevels / $totalLevels) * 100) : 0;
            }
        }
        
        return view('materials.index', compact('categories'));
    }

    // Tampilkan daftar langkah (levels) dalam kategori
    public function showCategory($categoryId)
    {
        $category = Category::with(['levels.difficulty'])->findOrFail($categoryId);
        
        // Get user progress untuk kategori ini
        $userProgress = [];
        if (Auth::check()) {
            $progress = UserProgress::where('user_id', Auth::id())
                ->where('category_id', $categoryId)
                ->get()
                ->keyBy('level_id');
            
            foreach ($category->levels as $index => $level) {
                if (isset($progress[$level->id])) {
                    $userProgress[$level->id] = $progress[$level->id]->status;
                } else {
                    // Level pertama selalu ongoing, sisanya locked
                    $userProgress[$level->id] = $index === 0 ? 'ongoing' : 'locked';
                    
                    // Auto-create progress untuk level pertama
                    if ($index === 0) {
                        UserProgress::firstOrCreate([
                            'user_id' => Auth::id(),
                            'category_id' => $categoryId,
                            'level_id' => $level->id
                        ], [
                            'status' => 'ongoing'
                        ]);
                    }
                }
            }
        }
        
        return view('materials.category', compact('category', 'userProgress'));
    }

    // Tampilkan materi berdasarkan level
    public function show($categoryId, $levelId)
    {
        $level = CategoryLevel::with(['category', 'difficulty'])->findOrFail($levelId);
        $material = Material::where('category_id', $categoryId)
            ->where('level_id', $levelId)
            ->first();
        
        // Check if user has access to this level
        if (Auth::check()) {
            $progress = UserProgress::where('user_id', Auth::id())
                ->where('level_id', $levelId)
                ->first();
            
            if (!$progress || $progress->status === 'locked') {
                return redirect()->route('materials.category', $categoryId)
                    ->with('error', 'Level ini masih terkunci. Selesaikan level sebelumnya terlebih dahulu.');
            }
        }
        
        // Get quiz untuk level ini
        $quiz = Quiz::where('category_id', $categoryId)
            ->where('level_id', $levelId)
            ->first();
        
        return view('materials.show', compact('material', 'level', 'quiz'));
    }
    
    // Claim EXP from reading material
    public function claimExp($materialId)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        
        $material = Material::findOrFail($materialId);
        
        // Check if already claimed
        $progress = UserMaterialProgress::where('user_id', Auth::id())
                                        ->where('material_id', $materialId)
                                        ->first();
        
        if ($progress && $progress->exp_claimed_at) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah mengklaim EXP untuk materi ini!'
            ]);
        }
        
        // Claim EXP
        UserMaterialProgress::updateOrCreate(
            ['user_id' => Auth::id(), 'material_id' => $materialId],
            ['exp_claimed_at' => now()]
        );
        
        // Add EXP to user
        $expResult = ExpService::addExp(Auth::user(), $material->exp_reward);
        
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mendapatkan ' . $material->exp_reward . ' EXP!',
            'exp_earned' => $material->exp_reward,
            'exp_result' => $expResult
        ]);
    }
}