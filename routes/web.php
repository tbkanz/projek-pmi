<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemakaianAmbulansController;
use App\Http\Controllers\Auth\RegisteredUserController;


// Arahkan root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard (hanya bisa diakses setelah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Logout (boleh GET, tapi lebih aman POST)
Route::get('/logout', function () {
    auth()->logout();
    return redirect()->route('login');
})->name('logout');

// CRUD Pemakaian Ambulans
Route::get('/pemakaian-ambulans', [PemakaianAmbulansController::class, 'index'])
    ->middleware('auth')
    ->name('pemakaian.index');

Route::get('/form-ambulans', [PemakaianAmbulansController::class, 'create'])
    ->middleware('auth')
    ->name('pemakaian.create');

Route::post('/form-ambulans', [PemakaianAmbulansController::class, 'store'])
    ->middleware('auth')
    ->name('pemakaian.store');

// Profile (sudah otomatis auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes (login, register, forgot password, dll)
require __DIR__.'/auth.php';