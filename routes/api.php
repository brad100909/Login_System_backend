<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AdminProductController;
use App\Http\Controllers\Api\PaymentController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// 商品相關API
Route::apiResource('products', ProductController::class);
Route::get('/products/detail/{id}', [ProductController::class, 'showDetail']);

// 後台api路由


Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::apiResource('products', AdminProductController::class);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/payment/checkout', [PaymentController::class, 'checkout']);
Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');