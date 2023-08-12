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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
// Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index'); // product
Route::view('/product/index', 'product.index')->name('product.index');
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');

//create
Route::get('/customer/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('customer.create');
// Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
Route::get('/category/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');

//update
Route::post('/customer/update/{id}', [CustomerController::class, 'customerUpdate'])->name('customer.update');
Route::post('/product/update/{id}', [ProductController::class, 'productUpdate'])->name('product.update');
Route::post('/category/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('category.update');
//Route::get('/customer_update', [App\Http\Controllers\CustomerController::class, 'update'])->name('customer.update');
//Route::get('/product_update', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
//Route::get('/category_update', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');

//store
Route::post('/customer/store', [CustomerController::class, 'customerStore'])->name('customer.store');
// Route::post('/product/store', [ProductController::class, 'productStore'])->name('product.store'); // product
Route::post('/category/store', [CategoryController::class, 'categoryStore'])->name('category.store');

//edit
Route::get('/customer/edit/{id}', [CustomerController::class, 'customerEdit'])->name('customer.edit');
// Route::get('/product/edit/{id}', [ProductController::class, 'productEdit'])->name('product.edit'); // product
Route::get('/category/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('category.edit');

//datatables
Route::get('/datatables/customer', [DatatableController::class, 'customerDatatable'])->name('customer.datatable');
// Route::get('/datatables/product', [DatatableController::class, 'productDatatable'])->name('product.datatable'); // product
Route::get('/datatables/category', [DatatableController::class, 'categoryDatatable'])->name('category.datatable');

//delete
Route::get('/delete/customer{id}', [CustomerController::class, 'customerDelete'])->name('customer.delete');
// Route::get('/delete/product{id}', [ProductController::class, 'productDelete'])->name('product.delete'); // product
Route::get('/delete/category{id}', [CategoryController::class, 'categoryDelete'])->name('category.delete');
