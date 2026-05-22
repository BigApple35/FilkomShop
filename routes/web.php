<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StorefrontController;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

/*
|--------------------------------------------------------------------------
| Storefront Routes
|--------------------------------------------------------------------------
*/

// Homepage storefront
Route::get('/', [StorefrontController::class, 'index'])
    ->name('storefront');

// Detail produk
Route::get('/product/{id}', [StorefrontController::class, 'show'])
    ->name('product.detail');

// View store seller
Route::get('/store/{id}', [StorefrontController::class, 'store'])
    ->name('store.view');

Route::get('/', [StorefrontController::class, 'index']);

Route::get('/product/{id}', [StorefrontController::class, 'show']);

Route::get('/store/{sellerId}', [StorefrontController::class, 'store']);
