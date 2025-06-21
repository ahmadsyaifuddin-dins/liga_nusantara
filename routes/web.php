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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'check.user.access'])->group(function () {
    Route::middleware('role:SuperAdmin')->group(function () {
        Route::get('/users/create', [PlayerAccountController::class, 'create'])->name('users.create');
        Route::post('/users', [PlayerAccountController::class, 'store'])->name('users.store');
    });
});

require __DIR__.'/auth.php';
