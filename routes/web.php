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
Route::get('/danh-muc/{slug}', [IndexControler::class, 'category']);
Route::get('/the-loai/{slug}', [IndexControler::class, 'genre']);
Route::get('/quoc-gia/{slug}', [IndexControler::class, 'country']);
Route::get('/phim', [IndexControler::class, 'movie']);
Route::get('/xem-phim', [IndexControler::class, 'watch']);
Route::get('/tap-phim', [IndexControler::class, 'episode']);


Auth::routes();

//ADMIN MANAGER
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Category - danh mục phim*/
Route::resource('category', CategoryController::class);
Route::get('category/active/{id}', [CategoryController::class, 'activeCategory']);
Route::get('category/unactive/{id}', [CategoryController::class, 'unactiveCategory']);
/*genre - thể loại phim*/
Route::resource('genre', GenreController::class);
Route::get('genre/active/{id}', [GenreController::class, 'activeGenre']);
Route::get('genre/unactive/{id}', [GenreController::class, 'unactiveGenre']);
/*country - quốc gia*/
Route::resource('country', CountryController::class);
Route::get('country/active/{id}', [CountryController::class, 'activeCountry']);
Route::get('country/unactive/{id}', [CountryController::class, 'unactiveCountry']);

Route::resource('episode', EpisodeController::class);

/*movie - phim*/
Route::resource('movie', MovieController::class);
Route::get('movie/active/{id}', [MovieController::class, 'activeMovie']);
Route::get('movie/unactive/{id}', [MovieController::class, 'unactiveMovie']);
