<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemakaianAmbulansController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Arahkan root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Resource route untuk pemakaian ambulans
Route::resource('pemakaian-ambulans', PemakaianAmbulansController::class)
    ->middleware(['auth', 'verified']);

// Register
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Logout
Route::post('/logout', function () {
    auth()->logout();
    return redirect()->route('login');
})->name('logout');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
require __DIR__ . '/auth.php';