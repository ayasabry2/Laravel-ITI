<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index']);
Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed'); 
Route::resource('posts', PostController::class);
Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
Route::patch('posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');