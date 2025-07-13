<?php

use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\PesMatchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlayerAccountController;
use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Blokir halaman register & login (langsung)
|--------------------------------------------------------------------------
*/
Route::get('/register', function () {
    abort(404);
});
Route::get('/login', function () {
    abort(404);
});

/*
|--------------------------------------------------------------------------
| Fallback 404 buat route liar
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    abort(404);
});

/*
|--------------------------------------------------------------------------
| Route yang butuh auth & status aktif
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'check.user.access', 'check.app.active'])->group(function () {
    Route::get('/', fn () => view('welcome'))->name('welcome');
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/leaderboard', fn () => view('leaderboard'))->name('leaderboard');
});

/*
|--------------------------------------------------------------------------
| Route profile
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Route SuperAdmin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'check.user.access', 'role:SuperAdmin'])->group(function () {
    Route::get('/users/create', [PlayerAccountController::class, 'create'])->name('users.create');
    Route::get('/admin/users', [PlayerAccountController::class, 'index'])->name('users.index');
    Route::post('/users', [PlayerAccountController::class, 'store'])->name('users.store');

    Route::post('/admin/users/{user}/toggle', [PlayerAccountController::class, 'toggleActive'])->name('users.toggle');
    Route::post('/admin/toggle-app', [PlayerAccountController::class, 'toggleApp'])->name('app.toggle');
});


/*
|--------------------------------------------------------------------------
| Route Pes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'check.user.access', 'check.app.active'])->group(function () {
    Route::get('/matches/create', [PesMatchController::class, 'create'])->name('matches.create');
    Route::post('/matches', [PesMatchController::class, 'store'])->name('matches.store');
    Route::get('/matches', [PesMatchController::class, 'index'])->name('matches.index');

    Route::get('/players/{id}/profile', [PlayerController::class, 'showProfile'])->name('players.profile');
});


/*
|--------------------------------------------------------------------------
| Route Leaderboard
|--------------------------------------------------------------------------
*/
Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');


/*
|--------------------------------------------------------------------------
| Auth routes dari Breeze/Fortify
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
