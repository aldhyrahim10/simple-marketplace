<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PortalController;

Route::get('/', [PortalController::class, 'index'])->name('portal');
Route::get('/admin', [HomeController::class, 'index'])->name('home');
Route::get('/admin/product', [ProductController::class, 'index'])->name('product');
Route::get('/all-categories', [ProductController::class, 'getAllCategories'])->name('get-category');
Route::get('/all-products', [ProductController::class, 'getAllProducts'])->name('get-product');
Route::get('/get-one-product', [ProductController::class, 'getOneProducts'])->name('get-one-product');
Route::get('/admin/stock', [StockController::class, 'index'])->name('stock');
Route::get('/admin/order', [OrderController::class, 'index'])->name('order');

Route::post('/upload-image', [ProductController::class, 'uploadImageProduct'])->name('upload-image');
Route::post('/add-product', [ProductController::class, 'store'])->name('store-product');
Route::patch('/edit-product/{id}', [ProductController::class, 'update'])->name('update-product');
Route::delete('/delete-product/{id}', [ProductController::class, 'destroy'])->name('delete-product');
Route::patch('/edit-stock/{id}', [StockController::class, 'update'])->name('update-stock');