<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\SetLocale;

// Apply SetLocale middleware to all routes
Route::middleware([SetLocale::class])->group(function () {
    // Tool routes with locale (more specific, must come first)
    Route::get('/{locale}/tools/{slug}', [ToolController::class, 'show'])
        ->where('locale', 'en|pt_BR|es')
        ->name('tools.show.locale');
    
    // Tool routes without locale
    Route::get('/tools/{slug}', [ToolController::class, 'show'])->name('tools.show');

    // About routes with locale
    Route::get('/{locale}/about', [PageController::class, 'about'])
        ->where('locale', 'en|pt_BR|es')
        ->name('about.locale');
    
    // About route without locale
    Route::get('/about', [PageController::class, 'about'])->name('about');

    // Contact routes with locale
    Route::get('/{locale}/contact', [PageController::class, 'contact'])
        ->where('locale', 'en|pt_BR|es')
        ->name('contact.locale');
    
    // Contact route without locale
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');

    // Contact form submission with locale
    Route::post('/{locale}/contact', [PageController::class, 'submitContact'])
        ->where('locale', 'en|pt_BR|es')
        ->name('contact.submit.locale');
    
    // Contact form submission without locale
    Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');

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
