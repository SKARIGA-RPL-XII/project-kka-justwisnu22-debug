<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');

// Materials Routes for User
Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
Route::get('/materials/{id}', [MaterialController::class, 'show'])->name('materials.show');

// Admin Routes 
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Quiz Routes
    Route::get('/quiz', [AdminController::class, 'quizIndex'])->name('quiz.index');
    Route::get('/quiz/create', [AdminController::class, 'quizCreate'])->name('quiz.create');
    Route::post('/quiz', [AdminController::class, 'quizStore'])->name('quiz.store');
    Route::get('/quiz/{id}/edit', [AdminController::class, 'quizEdit'])->name('quiz.edit');
    Route::put('/quiz/{id}', [AdminController::class, 'quizUpdate'])->name('quiz.update');
    Route::delete('/quiz/{id}', [AdminController::class, 'quizDestroy'])->name('quiz.destroy');
    
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
