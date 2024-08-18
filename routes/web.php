<?php

use App\Http\Controllers\CV\CvIndexShowController;
use App\Http\Controllers\CV\CvCreateController;
use App\Http\Controllers\CV\CvDestroyController;
use App\Http\Controllers\CV\CvUpdateController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\UserOwnsCv;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::delete('/cv/destroy',[CvDestroyController::class, 'destroy'])
        ->name('cv.destroy')
        ->middleware(UserOwnsCv::class);

    Route::controller(CvCreateController::class)->group(function () {
        Route::get('/cv/create','create')
            ->name('cv.create');
        Route::post('/cv/create','store')
            ->name('cv.store');
    });
    Route::controller(CvIndexShowController::class)->group(function () {
        Route::get('/cv','index')
            ->name('cv.index');
        Route::get('/dashboard','index')
            ->name('dashboard');
        Route::get('/cv/show/{cv}','show')
            ->name('cv.show')
            ->middleware(UserOwnsCv::class);
    });
    Route::controller(CvUpdateController::class)->group(function () {
        Route::get('/cv/update/{cv}','update')
            ->name('cv.update')
            ->middleware(UserOwnsCv::class);
        Route::patch('/cv/update/{cv}','patch')
            ->name('cv.patch')
            ->middleware(UserOwnsCv::class);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
