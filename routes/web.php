<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 
Route::get('all-products', [App\Http\Controllers\ProductController::class, 'AllProducts'])->name('all.products');

Route::get('add-product', [App\Http\Controllers\ProductController::class, 'AddProduct'])->name('add.product');

Route::POST('store-product', [App\Http\Controllers\ProductController::class, 'StoreProduct'])->name('store.product'); 

Route::get('edit-product/{id}', [App\Http\Controllers\ProductController::class, 'EditProduct'])->name('edit.product');

Route::POST('update-product/{id}', [App\Http\Controllers\ProductController::class, 'UpdateProduct'])->name('update.product');

Route::POST('delete-product', [App\Http\Controllers\ProductController::class, 'DeleteProduct'])->name('delete.product');
 
Route::get('product-listing', [App\Http\Controllers\ProductController::class, 'ProductListing'])->name('product.listing');