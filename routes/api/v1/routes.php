<?php

use App\Code\V1\Auth\Controllers\AuthController;
use App\Code\V1\Comments\Controllers\CommentController;
use App\Code\V1\Posts\Controllers\PostController;
use App\Code\V1\Users\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::prefix('v1')->group(function() {
    Route::get('users', [UserController::class, 'getUsers']);
});

Route::middleware('auth:sanctum')->prefix('v1')->group(function() {
    Route::get('posts', [PostController::class, 'getPosts']);
    Route::get('comments', [CommentController::class, 'getComments']);
});