<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemakaianAmbulansController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Arahkan root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman utama -> langsung ke pemakaian ambulans
Route::get('/pemakaian-ambulans', [PemakaianAmbulansController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('pemakaian-ambulans.index');

// Register
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Logout
Route::post('/logout', function () {
    auth()->logout();
    return redirect()->route('login');
})->name('logout');

// Form tambah data ambulans
Route::get('/pemakaian-ambulans/create', [PemakaianAmbulansController::class, 'create'])
    ->middleware('auth')
    ->name('pemakaian-ambulans.create');

Route::post('/pemakaian-ambulans', [PemakaianAmbulansController::class, 'store'])
    ->middleware('auth')
    ->name('pemakaian-ambulans.store');

Route::get('/form-ambulans', [PemakaianAmbulansController::class, 'create'])->name('form-ambulans');
Route::post('/form-ambulans', [PemakaianAmbulansController::class, 'store'])->name('pemakaian.store');

Route::get('/pemakaian', [PemakaianController::class, 'index'])->name('pemakaian.index');
Route::post('/pemakaian', [PemakaianController::class, 'store'])->name('pemakaian.store');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
require __DIR__ . '/auth.php';