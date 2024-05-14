<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('posts', [PostController::class, 'index']);
Route::post('posts', [PostController::class, 'store']);
Route::put('posts/{post}', [PostController::class, 'update']);
Route::put('posts/{post}', [PostController::class, 'destroy']);

Route::post('/register', [UserController::class, 'register']);

// Route::resource('post',PostController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

