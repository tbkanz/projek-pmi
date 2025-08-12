<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemakaianAmbulansController;


Route::get('/', [PemakaianAmbulansController::class, 'index'])->name('pemakaian.index');
Route::get('/create', [PemakaianAmbulansController::class, 'create'])->name('pemakaian.create');
Route::post('/store', [PemakaianAmbulansController::class, 'store'])->name('pemakaian.store');
