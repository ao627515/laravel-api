<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('posts', [PostController::class, 'index']);

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

// Route::resource('post',PostController::class);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', function () {
        return auth()->user();
    });
    Route::post('posts', [PostController::class, 'store']);
    Route::put('posts/{post}', [PostController::class, 'update']);
    Route::delete('posts/{post}', [PostController::class, 'destroy']);
});
