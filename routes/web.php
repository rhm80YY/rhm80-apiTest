<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiDemoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/posts', [ApiDemoController::class, 'posts']);
// Route::get('/posts/{id}', [ApiDemoController::class, 'post']);

// api publica
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

//api con credenciales
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::post('/articles/sync', [ArticleController::class, 'sync'])->name('articles.sync');
