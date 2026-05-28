<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StorefrontController;
use App\Http\Controllers\CartController;

use App\Http\Controllers\Admin\ProductManagementController;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);

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

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    /*
    |--------------------------------------------------------------------------
    | Shopping Cart
    |--------------------------------------------------------------------------
    */

    Route::get('/cart', [CartController::class, 'index']);

    Route::get('/cart/add/{id}', [CartController::class, 'add']);

    Route::get('/cart/delete/{id}', [CartController::class, 'delete']);


    /*
    |--------------------------------------------------------------------------
    | Admin - Manage Products
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/products', [ProductManagementController::class, 'index']);

    Route::get('/admin/products/create', [ProductManagementController::class, 'create']);

    Route::post('/admin/products/store', [ProductManagementController::class, 'store']);

    Route::get('/admin/products/edit/{id}', [ProductManagementController::class, 'edit']);

    Route::post('/admin/products/update/{id}', [ProductManagementController::class, 'update']);

    Route::get('/admin/products/delete/{id}', [ProductManagementController::class, 'delete']);

});


/*
|--------------------------------------------------------------------------
| Storefront Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [StorefrontController::class, 'index']);

Route::get('/product/{id}', [StorefrontController::class, 'show']);

Route::get('/store/{sellerId}', [StorefrontController::class, 'store']);
