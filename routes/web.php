<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerOrderController;
use App\Http\Controllers\CheckoutHistoryController;

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
});



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
});

