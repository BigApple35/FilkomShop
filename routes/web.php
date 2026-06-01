<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\SellerOrderController;
use App\Http\Controllers\CheckoutHistoryController;
use App\Http\Controllers\StorefrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\ProductManagementController;
use App\Http\Controllers\ItemController; // ← TAMBAHAN UNTUK ITEM MANAGEMENT
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminUserController;

/*
|--------------------------------------------------------------------------
| Guest Routes (Belum Login)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Sudah Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Seller routes
    Route::prefix('seller')->group(function () {
        Route::get('/orders', [SellerOrderController::class, 'index'])->name('seller.orders.index');
        Route::get('/orders/{id}', [SellerOrderController::class, 'show'])->name('seller.orders.show');
    });

    // Checkout history routes
    Route::prefix('history')->group(function () {
        Route::get('/', [CheckoutHistoryController::class, 'index'])->name('history.index');
        Route::get('/{id}', [CheckoutHistoryController::class, 'show'])->name('history.show');
        Route::delete('/{id}', [CheckoutHistoryController::class, 'destroy'])->name('history.destroy');
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Shopping Cart
    Route::get('/cart', [CartController::class, 'index']);
    Route::get('/cart/add/{id}', [CartController::class, 'add']);
    Route::get('/cart/delete/{id}', [CartController::class, 'delete']);

    // Admin - Manage Products
    Route::prefix('admin')->group(function () {
        Route::get('/products', [ProductManagementController::class, 'index']);
        Route::get('/products/create', [ProductManagementController::class, 'create']);
        Route::post('/products/store', [ProductManagementController::class, 'store']);
        Route::get('/products/edit/{id}', [ProductManagementController::class, 'edit']);
        Route::post('/products/update/{id}', [ProductManagementController::class, 'update']);
        Route::get('/products/delete/{id}', [ProductManagementController::class, 'delete']);
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // === TAMBAHAN UNTUK ITEM MANAGEMENT (CREATE + UPDATE) ===
    Route::resource('items', ItemController::class);
    // =======================================================

    // Orders (mungkin milik user biasa, bukan seller)
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});



    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Orders
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Shopping Cart
    Route::get('/cart', [CartsController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartsController::class, 'store'])->name('cart.store');
    Route::post('/cart/checkout', [CartsController::class, 'checkout'])->name('cart.checkout');
    Route::patch('/cart/item/{id}', [CartsController::class, 'update'])->name('cart.update');
    Route::delete('/cart/item/{id}', [CartsController::class, 'destroy'])->name('cart.destroy');

    // Shopping Cart
    Route::get('/cart/add/{id}', [CartController::class, 'add']);
    Route::get('/cart/delete/{id}', [CartController::class, 'delete']);

    /*
    |--------------------------------------------------------------------------
    | Fitur Admin
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [\App\Http\Controllers\AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Manage Users
        Route::get('/users', [AuthController::class, 'manageUsers'])->name('admin.users.index');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{user}', [AuthController::class, 'showUser'])->name('admin.users.show');
        Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{user}', [AuthController::class, 'deleteUser'])->name('admin.users.destroy');

        // Manage Products
        Route::get('/products', [ProductsController::class, 'index'])->name('admin.products.index');
        Route::get('/products/create', [ProductsController::class, 'create'])->name('admin.products.create');
        Route::post('/products', [ProductsController::class, 'store'])->name('admin.products.store');
        Route::get('/products/{products}', [ProductsController::class, 'show'])->name('admin.products.show');
        Route::get('/products/{products}/edit', [ProductsController::class, 'edit'])->name('admin.products.edit');
        Route::put('/products/{products}', [ProductsController::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{products}', [ProductsController::class, 'destroy'])->name('admin.products.destroy');
        Route::post('/products/{products}/image', [ProductsController::class, 'uploadImage'])->name('admin.products.image.upload');
    });


/*
|--------------------------------------------------------------------------
| Fitur Khusus Seller & Buyer History
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

/*
|--------------------------------------------------------------------------
| Public Routes & Storefront
|--------------------------------------------------------------------------
*/
Route::get('/', [StorefrontController::class, 'index']);
Route::get('/product/{id}', [StorefrontController::class, 'show']);
Route::get('/store/{sellerId}', [StorefrontController::class, 'store']);
Route::get('/store/{sellerId}', [StorefrontController::class, 'store']);

Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/{products}', [ProductsController::class, 'show'])->name('products.show');
