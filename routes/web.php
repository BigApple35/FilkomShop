<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerOrderController;
use App\Http\Controllers\CheckoutHistoryController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StorefrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\ProductManagementController;
use App\Http\Controllers\OrderController;


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





Route::prefix('seller')->group(function () {
    Route::get('/orders', [SellerOrderController::class, 'index'])->name('seller.orders.index');
    Route::get('/orders/{id}', [SellerOrderController::class, 'show'])->name('seller.orders.show');
});


Route::prefix('history')->group(function () {
    Route::get('/', [CheckoutHistoryController::class, 'index'])->name('history.index');
    Route::get('/{id}', [CheckoutHistoryController::class, 'show'])->name('history.show');
    Route::delete('/{id}', [CheckoutHistoryController::class, 'destroy'])->name('history.destroy');
});

// Root Route
Route::get('/', function () {
    return view('welcome');
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

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::put('/orders/{order}', [OrderController::class, 'update']) ->name('orders.update');
    Route::get('/orders', [OrderController::class, 'index']) ->name('orders.index');

});

/*
|--------------------------------------------------------------------------
| Storefront Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [StorefrontController::class, 'index']);

Route::get('/product/{id}', [StorefrontController::class, 'show']);

Route::get('/store/{sellerId}', [StorefrontController::class, 'store']);
