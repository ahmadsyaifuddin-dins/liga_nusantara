<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlayerAccountController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'check.user.access', 'check.app.active'])->group(function () {
    // semua route utama
    Route::get('/', fn () => view('welcome'))->name('welcome');
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/leaderboard', fn () => view('leaderboard'))->name('leaderboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'check.user.access'])->group(function () {
    Route::middleware('role:SuperAdmin')->group(function () {
        Route::get('/users/create', [PlayerAccountController::class, 'create'])->name('users.create');
        Route::get('/admin/users', [PlayerAccountController::class, 'index'])->name('users.index')->middleware(['auth', 'role:SuperAdmin']);
        Route::post('/users', [PlayerAccountController::class, 'store'])->name('users.store');
        
        Route::post('/admin/users/{user}/toggle', [PlayerAccountController::class, 'toggleActive'])->name('users.toggle');
        Route::post('/admin/toggle-app', [PlayerAccountController::class, 'toggleApp'])->name('app.toggle');
    });
});
require __DIR__.'/auth.php';
