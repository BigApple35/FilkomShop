<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerOrderController;
use App\Http\Controllers\CheckoutHistoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StorefrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\ProductManagementController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\Admin\AdminCategoryController; // Untuk manage categories

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

    // Shopping Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');

    // Admin - Manage Products (sudah ada)
    Route::prefix('admin')->group(function () {
        Route::get('/products', [ProductManagementController::class, 'index'])->name('admin.products.index');
        Route::get('/products/create', [ProductManagementController::class, 'create'])->name('admin.products.create');
        Route::post('/products/store', [ProductManagementController::class, 'store'])->name('admin.products.store');
        Route::get('/products/edit/{id}', [ProductManagementController::class, 'edit'])->name('admin.products.edit');
        Route::post('/products/update/{id}', [ProductManagementController::class, 'update'])->name('admin.products.update');
        Route::get('/products/delete/{id}', [ProductManagementController::class, 'delete'])->name('admin.products.delete');

        // ========== MANAGE CATEGORIES (ADMIN) - CREATE & UPDATE ==========
        Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/categories/{id}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/categories/{id}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Item Management (CREATE + UPDATE dari tugas sebelumnya)
    Route::resource('items', ItemController::class);

    // Orders (user biasa)
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

/*
|--------------------------------------------------------------------------
| Storefront & Checkout Routes (Bebas, tanpa middleware auth)
|--------------------------------------------------------------------------
*/

Route::get('/', [StorefrontController::class, 'index']);
Route::get('/product/{id}', [StorefrontController::class, 'show']);
Route::get('/cart', function() {
    return view('cart.index');
})->name('cart.index');

Route::get('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/checkout', [App\Http\Controllers\CheckoutHistoryController::class, 'store'])->name('checkout.store');