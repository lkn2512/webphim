<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*Admin*/
use App\Http\Controllers\Admin\CountryController as Admin_CountryController;
use App\Http\Controllers\Admin\EpisodeController as Admin_EpisodeController;
use App\Http\Controllers\Admin\GenreController as Admin_GenreController;
use App\Http\Controllers\Admin\MovieController as Admin_MovieController;
use App\Http\Controllers\Admin\CategoryController as Admin_CategoryController;
use App\Http\Controllers\Admin\SeriesController as Admin_SeriesController;
use App\Http\Controllers\Admin\InformationController as Admin_InformationController;
use App\Http\Controllers\Admin\DashboardController as Admin_DashboardController;
use App\Http\Controllers\Admin\SliderController as Admin_SliderController;
use App\Http\Controllers\Admin\CommentController as Admin_CommentController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\IndexControler;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SitemapController;


// Route::get('/', function () {
//     return view('layout');
// });

Route::get('/sitemap', [SitemapController::class, 'index']);
Route::get('/', [IndexControler::class, 'home'])->name('trang-chu');
Route::get('/danh-muc/{slug}', [CategoryController::class, 'category']);
Route::get('/the-loai/{slug}', [GenreController::class, 'genre']);
Route::get('/quoc-gia/{slug}', [CountryController::class, 'country']);
Route::get('/phim/{slug}', [MovieController::class, 'movie']);
Route::get('xem-phim/{slug}/{tap}', [MovieController::class, 'watchEpisode']);
Route::get('/tap-phim', [IndexControler::class, 'episode']);
Route::get('/tim-kiem', [IndexControler::class, 'search'])->name('tim-kiem');
Route::get('/loc-phim', [IndexControler::class, 'loc_phim_page']);
Route::get('/loc-phim/ket-qua', [IndexControler::class, 'filter_movie']);

/*comment*/
Route::post('/load-comment', [MovieController::class, 'load_comment'])->name('load.comment');

Route::post('/send-comment', [MovieController::class, 'send_comment']);
Route::post('/recall-comment', [MovieController::class, 'recall_comment']);
Auth::routes();


//ADMIN MANAGER
Route::get('/home', [Admin_DashboardController::class, 'dashboard'])->name('home');

/*Category - danh mục phim*/
Route::resource('category', Admin_CategoryController::class);
Route::get('category/active/{id}', [Admin_CategoryController::class, 'activeCategory']);
Route::get('category/unactive/{id}', [Admin_CategoryController::class, 'unactiveCategory']);

/*genre - thể loại phim*/
Route::resource('genre', Admin_GenreController::class);
Route::get('genre/active/{id}', [Admin_GenreController::class, 'activeGenre']);
Route::get('genre/unactive/{id}', [Admin_GenreController::class, 'unactiveGenre']);

/*country - quốc gia*/
Route::resource('country', Admin_CountryController::class);
Route::get('country/active/{id}', [Admin_CountryController::class, 'activeCountry']);
Route::get('country/unactive/{id}', [Admin_CountryController::class, 'unactiveCountry']);

//tập phim
Route::resource('episode', Admin_EpisodeController::class);
Route::post('/episode/show-episodes', [Admin_EpisodeController::class, 'showEpisodes'])->name('episode.showEpisodes');
Route::get('episode/active/{id}', [Admin_EpisodeController::class, 'activeEpisode']);
Route::get('episode/unactive/{id}', [Admin_EpisodeController::class, 'unactiveEpisode']);

/*series phim - loạt phim (các phần) */
Route::resource('series', Admin_SeriesController::class);

/*movie - phim*/
Route::resource('movie', Admin_MovieController::class);
Route::get('movie/active/{id}', [Admin_MovieController::class, 'activeMovie']);
Route::get('movie/unactive/{id}', [Admin_MovieController::class, 'unactiveMovie']);

/*information -  thông tin website*/
Route::resource('information', Admin_InformationController::class);

/*Slider*/
Route::resource('slider', Admin_SliderController::class);
Route::get('slider/active/{id}', [Admin_SliderController::class, 'activeSlider']);
Route::get('slider/unactive/{id}', [Admin_SliderController::class, 'unactiveSlider']);


/*Comment - bình luận*/
Route::resource('comment', Admin_CommentController::class);
Route::get('comment/active/{id}', [Admin_CommentController::class, 'activeComment']);
Route::get('comment/unactive/{id}', [Admin_CommentController::class, 'unactiveComment']);
Route::post('/comment/delete-multiple', [Admin_CommentController::class, 'deleteMultiple'])->name('comment.deleteMultiple');
