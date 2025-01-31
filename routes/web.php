<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
// Route::get('/', function () {
//     return view('pages.home');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/all-categories', [ProductController::class, 'getAllCategories'])->name('get-category');
Route::get('/all-products', [ProductController::class, 'getAllProducts'])->name('get-product');
Route::get('/get-one-product', [ProductController::class, 'getOneProducts'])->name('get-one-product');

Route::post('/upload-image', [ProductController::class, 'uploadImageProduct'])->name('upload-image');
Route::post('/add-product', [ProductController::class, 'store'])->name('store-product');
Route::patch('/edit-product/{id}', [ProductController::class, 'update'])->name('update-product');
Route::delete('/delete-product/{id}', [ProductController::class, 'destroy'])->name('delete-product');