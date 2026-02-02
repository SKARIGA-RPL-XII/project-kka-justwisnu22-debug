<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminQuizController;
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

// Materials Routes for User
Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
Route::get('/materials/{id}', [MaterialController::class, 'show'])->name('materials.show');

// Quiz Routes for User
Route::middleware('auth')->group(function () {
    Route::get('/quiz', [UserQuizController::class, 'index'])->name('quiz.index');
    Route::get('/quiz/{id}', [UserQuizController::class, 'show'])->name('quiz.show');
    Route::post('/quiz/{id}/submit', [UserQuizController::class, 'submit'])->name('quiz.submit');

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

    // Badges Routes
    Route::get('/badges', [AdminController::class, 'badgesIndex'])->name('badges.index');
    Route::get('/badges/create', [AdminController::class, 'badgesCreate'])->name('badges.create');
    Route::post('/badges', [AdminController::class, 'badgesStore'])->name('badges.store');
    Route::get('/badges/{id}/edit', [AdminController::class, 'badgesEdit'])->name('badges.edit');
    Route::put('/badges/{id}', [AdminController::class, 'badgesUpdate'])->name('badges.update');
    Route::delete('/badges/{id}', [AdminController::class, 'badgesDestroy'])->name('badges.destroy');
});
