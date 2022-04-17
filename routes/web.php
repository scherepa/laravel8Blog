<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\AUth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
})->name('home');
/* before production don't forget to set app debug to false in .env
use middleware in controller(__construct) */
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
Route::get('/dashboard/liked', [DashboardController::class, 'show'])
    ->name('dashboard.liked');
Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])
    ->name('users.posts');
Route::get('/users/{user:username}/profile', [UserProfileController::class, 'index'])
    ->name('users.show')->middleware('auth');
Route::put('/users/profile/update', [UserProfileController::class, 'change'])
    ->name('users.update')->middleware('auth');
/*or add just here:
 Route::get('/dashboard', [DashboardController::class, 'index'])
->name('dashboard')
->middleware('auth'); */
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts', [PostController::class, 'store']);
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.del');
Route::get('/posts/edit/{post}', [PostController::class, 'showEdit'])->name('posts.edit');
Route::put('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.editing');
Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');
Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])->name('posts.likes');

/* Route::get('/posts', function () {
    return view('posts.index');
}); */
