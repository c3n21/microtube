<?php

use App\Http\Controllers\ProfileController;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

Route::get('/', function () {

    return Inertia::render('Welcome', [
        'initialVideos' => Video::with('user')->get()
    ]);
})->name('welcome');

Route::get('/play/{video}', function (Request $request, Video $video) {
    if (Storage::disk('public')->exists($video->getKey())) {
        return Inertia::render('VideoPlayer', [
            'src' => Storage::url($video->getKey())
        ]);
    }

    return redirect()->route('welcome');
})->name('play');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
