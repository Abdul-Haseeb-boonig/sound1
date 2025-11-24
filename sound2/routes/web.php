<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RatingController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Auth::routes();

Route::resource('music', MusicController::class)->only(['index', 'show']);
Route::resource('videos', VideoController::class)->only(['index', 'show']);

Route::middleware(['auth'])->group(function () {
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
    Route::put('/ratings/{rating}', [RatingController::class, 'update'])->name('ratings.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('music', MusicController::class)->except(['index', 'show']);
    Route::resource('videos', VideoController::class)->except(['index', 'show']);
});