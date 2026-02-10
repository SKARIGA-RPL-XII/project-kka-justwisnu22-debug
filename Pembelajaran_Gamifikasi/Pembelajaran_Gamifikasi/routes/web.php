<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminQuizController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminDifficultyController;
use App\Http\Controllers\AdminBadgeController;
use App\Http\Controllers\UserQuizController;
use App\Http\Controllers\UserBadgeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');

// Materials Routes for User (Halaman Belajar)
Route::get('/belajar', [MaterialController::class, 'index'])->name('materials.index');
Route::get('/belajar/{categoryId}', [MaterialController::class, 'showCategory'])->name('materials.category');
Route::get('/belajar/{categoryId}/{levelId}', [MaterialController::class, 'show'])->name('materials.show');

// Quiz Routes for User (Terintegrasi dengan Materi)
Route::middleware('auth')->group(function () {
    Route::get('/quiz/{categoryId}/{levelId}', [UserQuizController::class, 'show'])->name('quiz.show');
    Route::post('/quiz/{categoryId}/{levelId}/submit', [UserQuizController::class, 'submit'])->name('quiz.submit');

    // Badge Routes for User
    Route::get('/badges', [UserBadgeController::class, 'index'])->name('badges.index');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/photo/{id}', [ProfileController::class, 'photo'])
        ->name('profile.photo');

    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Admin Routes 
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Difficulty Routes
    Route::resource('difficulties', AdminDifficultyController::class);

    // Category Routes
    Route::resource('categories', AdminCategoryController::class);
    Route::get('/categories/{categoryId}/levels', [AdminCategoryController::class, 'getLevels'])->name('categories.levels');

    // Quiz Routes
    Route::resource('quiz', AdminQuizController::class);

    // Badge Routes
    Route::resource('badges', AdminBadgeController::class);

    // Materials Routes
    Route::get('/materials', [AdminController::class, 'materialsIndex'])->name('materials.index');
    Route::get('/materials/create', [AdminController::class, 'materialsCreate'])->name('materials.create');
    Route::post('/materials', [AdminController::class, 'materialsStore'])->name('materials.store');
    Route::get('/materials/{id}/edit', [AdminController::class, 'materialsEdit'])->name('materials.edit');
    Route::put('/materials/{id}', [AdminController::class, 'materialsUpdate'])->name('materials.update');
    Route::delete('/materials/{id}', [AdminController::class, 'materialsDestroy'])->name('materials.destroy');
});
