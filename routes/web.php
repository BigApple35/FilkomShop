<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;


// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::delete('/admin/products/{products}', [ProductsController::class, 'destroy'])->name('admin.products.destroy');
    Route::post('/admin/products/{products}/image', [ProductsController::class, 'uploadImage'])->name('admin.products.image.upload');
    Route::get('/admin/products/create', [ProductsController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductsController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{products}/edit', [ProductsController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{products}', [ProductsController::class, 'update'])->name('admin.products.update');
    // Shopping Cart routes
    Route::get('/cart', [\App\Http\Controllers\CartsController::class, 'index'])->name('cart.index');
    Route::post('/cart', [\App\Http\Controllers\CartsController::class, 'store'])->name('cart.store');
    Route::post('/cart/checkout', [\App\Http\Controllers\CartsController::class, 'checkout'])->name('cart.checkout');
    Route::patch('/cart/item/{id}', [\App\Http\Controllers\CartsController::class, 'update'])->name('cart.update');
    Route::delete('/cart/item/{id}', [\App\Http\Controllers\CartsController::class, 'destroy'])->name('cart.destroy');
});

// Public Product Views
Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/{products}', [ProductsController::class, 'show'])->name('products.show');

// Admin Product Views
Route::get('/admin/products', [ProductsController::class, 'index'])->name('admin.products.index');
Route::get('/admin/products/{products}', [ProductsController::class, 'show'])->name('admin.products.show');

// Root Route
Route::get('/', function () {
    return view('welcome');
});