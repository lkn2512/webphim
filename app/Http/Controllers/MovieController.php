<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    public function movie($slug)
    {
        $slugMovie = Movie::where('slug', $slug)->where('status', 1)->first();
        $IdMovie = $slugMovie->id;

        //chi tiết phim
        $movie_detail = Movie::with(['categories', 'genres', 'countries'])->where('id', $IdMovie)->where('status', 1)->firstOrFail();

        //top lượt xem
        $view_movie = Movie::orderBy('id', 'DESC')->where('status', 1)->limit(6)->get();

        // Lấy danh mục của phim hiện tại
        $getCategory = $movie_detail->categories->pluck('id');

        // Lấy thể loại của phim hiện tại
        $getGenre = $movie_detail->genres->pluck('id');

        // Lấy quốc gia của phim hiện tại
        $getCountry = $movie_detail->countries->pluck('id');

        //phim cùng danh mục
        $cate_movies = Movie::whereHas('categories', function ($query) use ($getCategory) {
            $query->whereIn('categories.id', $getCategory);
        })->where('id', '!=', $movie_detail->id)->where('status', 1)->inRandomOrder()->get();

        //phim cùng thể loại
        $gen_movies = Movie::whereHas('genres', function ($query) use ($getGenre) {
            $query->whereIn('genres.id', $getGenre);
        })->where('id', '!=', $movie_detail->id)->where('status', 1)->inRandomOrder()->get();

        //phim cùng quốc gia
        $country_movies = Movie::whereHas('countries', function ($query) use ($getCountry) {
            $query->whereIn('countries.id', $getCountry);
        })->where('id', '!=', $movie_detail->id)->where('status', 1)->inRandomOrder()->get();

        return view('pages.movie', compact('movie_detail', 'view_movie', 'cate_movies', 'gen_movies', 'country_movies'));
    }
}
