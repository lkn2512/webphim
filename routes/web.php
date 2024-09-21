<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\EpisodeController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\MovieController;


use App\Http\Controllers\IndexControler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('layout');
// });
Route::get('/', [IndexControler::class, 'home'])->name('trang-chu');
Route::get('/danh-muc', [IndexControler::class, 'category'])->name('category');
Route::get('/the-loai', [IndexControler::class, 'genre']);
Route::get('/quoc-gia', [IndexControler::class, 'country']);
Route::get('/phim', [IndexControler::class, 'movie']);
Route::get('/xem-phim', [IndexControler::class, 'watch']);
Route::get('/tap-phim', [IndexControler::class, 'episode']);


Auth::routes();

//ADMIN MANAGER
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('category', CategoryController::class);
Route::resource('genre', GenreController::class);
Route::resource('country', CountryController::class);
Route::resource('episode', EpisodeController::class);
Route::resource('movie', MovieController::class);
