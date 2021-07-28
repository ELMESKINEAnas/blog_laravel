<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LikeController;

use App\Http\Controllers\PostController;

use App\Http\Controllers\CommentController;

use App\Http\Controllers\UserPostController;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\login\LoginController;

use App\Http\Controllers\login\LogoutController;
use App\Http\Controllers\auth\RegisterController;

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

Route::get('/home', function () {
    return view('home');
})->name('home');


Route::post('/posts/{posts}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/update', [PostController::class, 'update'])->name('posts.update');


Route::get('/comments/{posts}', [CommentController::class, 'index'])->name('comments');
Route::post('/comments/{posts}', [CommentController::class, 'store']);

Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])->name('posts.user');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/register', [RegisterController::class, 'index'])->name('register');

Route::post('/register', [RegisterController::class, 'store']);


// Route::get('/posts', function () {
//     // return view('welcome');
//     return view('posts.index');
// });

Route::get('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/login', [LoginController::class, 'store']);



Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::post('/posts', [PostController::class, 'store']);


Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');


Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes');

Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes');
