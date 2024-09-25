<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::prefix('Admin')
    ->name('Admin.')
    ->group(function () {
        Route::middleware(['auth' ])->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('home');
            // require __DIR__ . '/users.php';
            require __DIR__ . '/products.php';
            
        });
    });
