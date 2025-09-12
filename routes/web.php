<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiDemoController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/posts', [ApiDemoController::class, 'posts']);
// Route::get('/posts/{id}', [ApiDemoController::class, 'post']);

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
