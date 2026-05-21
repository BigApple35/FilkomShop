<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SellerOrderController;
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


    Route::prefix('seller')->group(function () {

        Route::get('/orders', [SellerOrderController::class, 'index'])->name('seller.orders.index');

        Route::get('/orders/{id}', [SellerOrderController::class, 'show'])->name('seller.orders.show');
    });
});

// Root Route
Route::get('/', function () {
    return view('welcome');
});
