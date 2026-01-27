<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ToolController;
use App\Http\Middleware\SetLocale;

// Apply SetLocale middleware to all routes
Route::middleware([SetLocale::class])->group(function () {
    // Tool routes with locale (more specific, must come first)
    Route::get('/{locale}/tools/{slug}', [ToolController::class, 'show'])
        ->where('locale', 'en|pt_BR|es')
        ->name('tools.show.locale');
    
    // Tool routes without locale
    Route::get('/tools/{slug}', [ToolController::class, 'show'])->name('tools.show');

    // Homepage routes with locale (more specific, must come after tools)
    Route::get('/{locale}', [HomeController::class, 'index'])
        ->where('locale', 'en|pt_BR|es')
        ->name('home.locale');
    
    // Homepage route without locale (must come last)
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

// IndexNow Verification
Route::get('/{key}.txt', function ($key) {
    if ($key === config('services.indexnow.key')) {
        return response($key)->header('Content-Type', 'text/plain');
    }
    abort(404);
})->where('key', '[a-zA-Z0-9]+');
