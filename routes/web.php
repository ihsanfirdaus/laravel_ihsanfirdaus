<?php

use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RumahSakitController;
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

    Route::get('rumah-sakit', [RumahSakitController::class, 'index'])->name('rumah-sakit.index');
    Route::post('rumah-sakit', [RumahSakitController::class, 'store'])->name('rumah-sakit.store');
    Route::get('rumah-sakit/{id}', [RumahSakitController::class, 'show'])->name('rumah-sakit.show');
    Route::put('rumah-sakit/{id}', [RumahSakitController::class, 'update'])->name('rumah-sakit.update');
    Route::delete('rumah-sakit/{id}', [RumahSakitController::class, 'destroy'])->name('rumah-sakit.destroy');
    
    Route::get('pasien', [PasienController::class, 'index'])->name('pasien.index');
    Route::post('pasien', [PasienController::class, 'store'])->name('pasien.store');
    Route::get('pasien/{id}', [PasienController::class, 'show'])->name('pasien.show');
    Route::put('pasien/{id}', [PasienController::class, 'update'])->name('pasien.update');
    Route::delete('pasien/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy');
});


require __DIR__.'/auth.php';
