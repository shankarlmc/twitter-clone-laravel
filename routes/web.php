<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/{user:username}', [ProfileController::class, 'index'])->name('profile');
Route::post('/posts', [PostController::class, 'store'])->name('post');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.destroy');
Route::post('/posts/{post:id}/like', [PostLikeController::class, 'store'])->name('posts.likes');
Route::delete('/posts/{post:id}/like', [PostLikeController::class, 'destroy'])->name('posts.likes');
