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
});

// Public Admin Product Views
Route::get('/admin/products', [ProductsController::class, 'index'])->name('admin.products.index');
Route::get('/admin/products/{products}', [ProductsController::class, 'show'])->name('admin.products.show');

// Root Route
Route::get('/', function () {
    return view('welcome');
});

Route::get(
    '/admin/products',
    [ProductsController::class, 'index']
)->name('admin.products.index');

Route::get(
    '/admin/products/{products}',
    [ProductsController::class, 'show']
)->name('admin.products.show');

Route::delete(
    '/admin/products/{products}',
    [ProductsController::class, 'destroy']
)->name('admin.products.destroy');