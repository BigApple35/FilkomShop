<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StorefrontController;
use App\Http\Controllers\ProfileController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::put('/orders/{order}', [OrderController::class, 'update']) ->name('orders.update');
Route::get('/orders', [OrderController::class, 'index'])
    ->name('orders.index');
    
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
