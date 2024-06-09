<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [LogoutController::class, 'logout']);
Route::get('/health-news', [ArtikelController::class, 'healthNews']);

// Post routes
Route::get('/posts/user/{userId}', [PostController::class, 'getPosts']);
Route::post('/posts/user/{userId}', [PostController::class, 'createPost']);
Route::put('/posts/{postId}', [PostController::class, 'updatePost']);
Route::delete('/posts/{postId}', [PostController::class, 'deletePost']);

// Comment routes
Route::get('/posts/{postId}/comments', [CommentController::class, 'getComments']);
Route::post('/posts/{postId}/comments', [CommentController::class, 'createComment']);
Route::put('/comments/{commentId}', [CommentController::class, 'updateComment']);
Route::delete('/comments/{commentId}', [CommentController::class, 'deleteComment']);