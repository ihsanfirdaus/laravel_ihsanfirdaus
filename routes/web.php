<?php

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
});


require __DIR__.'/auth.php';
