<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::resource('users', UserController::class);
Route::resource('users.posts', PostController::class)->only(['index', 'store']);
Route::resource('posts', PostController::class)->only(['index', 'show', 'store']);
Route::resource('posts.comments', CommentController::class)->only('store', 'index');
Route::resource('comments', CommentController::class)->only('show', 'store', 'index', 'destroy');
