<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StorefrontController;
use App\Http\Controllers\CartController;

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

    /*
    |--------------------------------------------------------------------------
    | Cart Routes
    |--------------------------------------------------------------------------
    */

    // View cart
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    // Add to cart
    Route::get('/cart/add/{id}', [CartController::class, 'add'])
        ->name('cart.add');

    // Delete cart item
    Route::get('/cart/delete/{id}', [CartController::class, 'delete'])
        ->name('cart.delete');
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
Route::get('/store/{sellerId}', [StorefrontController::class, 'store'])
    ->name('store.view');
