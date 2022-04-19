<?php

use Illuminate\Support\Facades\Route;
use App\Models\Creater;//ここを追記
use Illuminate\Http\Request;//ここを追記

use App\Http\Controllers\CreaterController;//追記
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
Route::get('/', [App\Http\Controllers\WebController::class, 'index']);

  Route::get('users/mypage', [App\Http\Controllers\UserController::class, 'mypage'])->name('mypage');
  Route::get('users/mypage/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('mypage.edit');
  Route::get('users/mypage/address/edit', [App\Http\Controllers\UserController::class, 'edit_address'])->name('mypage.edit_address');
  Route::put('users/mypage', [App\Http\Controllers\UserController::class, 'upadate'])->name('mypage.update');
  Route::get('users/mypage/favorite', [App\Http\Controllers\UserController::class, 'favorite'])->name('mypage.favorite');

Route::post('creaters/{creater}/reviews', [App\Http\Controllers\ReviewController::class, 'store']);

Route::get('creaters/{creater}/favorite', [App\Http\Controllers\CreaterController::class, 'favorite'])->name('creaters.favorite');
Route::get('reviews/like/{id}',  [App\Http\Controllers\ReviewController::class, 'like'])->name('reviews.like');
Route::get('reviews/unlike/{id}', [App\Http\Controllers\ReviewController::class, 'unlike'])->name('reviews.unlike');
Route::get('creaters', [App\Http\Controllers\CreaterController::class, 'index'])->name('creaters.index');
Route::get('creaters/{creater}', [App\Http\Controllers\CreaterController::class, 'show'])->name('creaters.show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);

  Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
      Route::get('login', [App\Http\Controllers\Dashboard\Auth\LoginController::class, 'showLoginForm'])->name('login');
      Route::post('login', [App\Http\Controllers\Dashboard\Auth\LoginController::class, 'login'])->name('login');
      Route::resource('categories', App\Http\Controllers\Dashboard\CategoryController::class);
      Route::resource('creaters', App\Http\Controllers\Dashboard\CreaterController::class);
  });
