<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class IndexControler extends Controller
{
    public function home()
    {
        $category = Category::whereHas('movies', function ($query) {
            $query->where('status', 1);
        })->orderBy('title')->get();
        $genre = Genre::whereHas('movies', function ($query) {
            $query->where('status', 1);
        })->orderBy('title')->get();
        $country = Country::whereHas('movies', function ($query) {
            $query->where('status', 1);
        })->orderBy('title')->get();

        //phim mới
        $new_movie = Movie::orderBy('updated_at', 'DESC')->where('status', 1)->limit(8)->get();

        //phim bộ
        $series_movie = Movie::whereHas('categories', function ($query) {
            $query->where('slug', 'phim-bo');
        })->where('status', 1)->orderBy('updated_at', 'desc')->limit(12)->get();

        //phim lẻ
        $single_movie = Movie::whereHas('categories', function ($query) {
            $query->where('slug', 'phim-le');
        })->where('status', 1)->orderBy('updated_at', 'desc')->limit(12)->get();

        //phim hot
        $view_movie = Movie::orderBy('id', 'DESC')->where('status', 1)->get();

        return view('pages.home', compact('category', 'genre', 'country', 'new_movie', 'series_movie', 'single_movie', 'view_movie'));
    }



    public function watch()
    {
        return view('pages.watch');
    }
    public function episode()
    {
        return view('pages.episode');
    }
}
