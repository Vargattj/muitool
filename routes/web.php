<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ToolController;
use App\Http\Middleware\SetLocale;

// Apply SetLocale middleware to all routes
Route::middleware([SetLocale::class])->group(function () {
    // Homepage routes
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/{locale}', [HomeController::class, 'index'])
        ->where('locale', 'en|pt_BR|es')
        ->name('home.locale');

    // Tool routes
    Route::get('/tools/{slug}', [ToolController::class, 'show'])->name('tools.show');
    Route::get('/{locale}/tools/{slug}', [ToolController::class, 'show'])
        ->where('locale', 'en|pt_BR|es')
        ->name('tools.show.locale');
});
