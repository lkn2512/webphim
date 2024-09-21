<?php

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
Route::get('/trang-chu', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
