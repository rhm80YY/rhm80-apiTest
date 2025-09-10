<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiDemoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [ApiDemoController::class, 'posts']);
Route::get('/posts/{id}', [ApiDemoController::class, 'post']);
