<?php

use App\Http\Controllers\CV\CvIndexShowController;
use App\Http\Controllers\CV\CvCreateController;
use App\Http\Controllers\CV\CvDestroyController;
use App\Http\Controllers\CV\CvUpdateController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(CvIndexShowController::class)->group(function () {
        Route::get('/cv','index')
            ->name('cv.index');
        Route::get('/cv/{cv}','show')
            ->name('cv.show');
    });

    Route::controller(CvUpdateController::class)->group(function () {
        Route::get('/cv/update/{cv}','update')
            ->name('cv.update');
        Route::patch('/cv/update','patch')
            ->name('cv.patch');
    });

    Route::delete('/cv',[CvDestroyController::class, 'destroy'])
        ->name('cv.destroy');

    Route::controller(CvCreateController::class)->group(function () {
        Route::get('/cv/create','create')
            ->name('cv.create');
        Route::post('/cv/create','store')
            ->name('cv.store');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
