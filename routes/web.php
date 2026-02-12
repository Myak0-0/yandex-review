<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [ProfileController::class, 'reviews'])
    ->middleware(['auth', 'verified'])
    ->name('reviews'); 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [ProfileController::class, 'reviews'])->name('reviews');
    Route::get('/reviews', [ProfileController::class, 'reviews'])->name('reviews');
    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');

    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';

Route::get('/test', [ReviewController::class, 'test']);