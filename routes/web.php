<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DatatableController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\FrontEndController::class, 'categories'])->name('home');
Route::get('/product/{id}/all', [App\Http\Controllers\FrontEndController::class, 'ViewAllProduct'])->name('ViewAllProduct');
Route::get('/product/{id}/details', [App\Http\Controllers\FrontEndController::class, 'product'])->name('product.details');
Route::view('/category', 'category.index')->name('category.index');
Route::view('/product/index', 'product.index')->name('product.index');
Route::view('/user/index', 'user.index')->name('user.index');
Route::view('/payment/index', 'payment.index')->name('payment.index');

Route::get('/viewCart', [App\Http\Controllers\CartController::class, 'viewCart'])->name('view.cart');
Route::get('/addCart/{id}', [App\Http\Controllers\CartController::class, 'addCart'])->name('add.cart');

Route::post('/category/import', [App\Http\Controllers\CategoryController::class, 'import'])->name('category.import');
Route::post('/payment/import', [App\Http\Controllers\PaymentController::class, 'import'])->name('payment.import');
Route::post('/user/import', [App\Http\Controllers\UserController::class, 'import'])->name('user.import');

