<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/search/data', [App\Http\Controllers\SearchController::class, 'searchData']);
Route::resource('category', App\Http\Controllers\CategoryController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::resource('product', App\Http\Controllers\ProductController::class);
    Route::resource('payment', App\Http\Controllers\PaymentController::class);
    Route::post('/product/images', [App\Http\Controllers\ProductController::class, 'storeMedia'])->name('products.storeMedia');
    Route::post('/category/images', [App\Http\Controllers\CategoryController::class, 'storeMedia'])->name('category.storeMedia');
    Route::post('/user/images', [App\Http\Controllers\UserController::class, 'storeMedia'])->name('user.storeMedia');
    Route::post('/payment/images', [App\Http\Controllers\PaymentController::class, 'storeMedia'])->name('payment.storeMedia');
    Route::get('/bestSeller', [App\Http\Controllers\ChartController::class, 'bestSeller']);
    Route::get('/categories/product', [App\Http\Controllers\ChartController::class, 'categoriesProduct']);
    Route::get('/vieworder/{id}', [App\Http\Controllers\UserController::class, 'vieworder']);
});

Route::middleware(['auth', 'authorize'])->group(function () {
    Route::get('/order', [App\Http\Controllers\OrderController::class, 'index']);
});
