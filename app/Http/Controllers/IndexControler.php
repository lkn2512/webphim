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
        $category = Category::orderBy('title')->where('status', 1)->get();
        $genre = Genre::orderBy('title')->where('status', 1)->get();
        $country = Country::orderBy('title')->where('status', 1)->get();

        // Lấy danh mục và kèm theo các phim thuộc từng danh mục
        // $category_home = Category::whereHas('movies', function ($movieQuery) {
        //     $movieQuery->where('status', 1);
        // })
        //     ->with(['movies' => function ($movieQuery) {
        //         $movieQuery->where('status', 1);
        //     }])->orderBy('title')->limit(12)->get();

        //phim mới
        $new_movie = Movie::orderBy('id', 'DESC')->where('status', 1)->limit(8)->get();

        //phim bộ
        $series_movie = Movie::whereHas('categories', function ($query) {
            $query->where('title', 'Phim bộ');
        })->orderBy('title')->where('status', 1)->limit(12)->get();

        //phim lẻ
        $single_movie = Movie::whereHas('categories', function ($query) {
            $query->where('title', 'Phim lẻ');
        })->orderBy('title')->where('status', 1)->limit(12)->get();

        return view('pages.home', compact('category', 'genre', 'country', 'new_movie', 'series_movie', 'single_movie'));
    }
    public function category($slug)
    {
        $nameCategory = Category::where('slug', $slug)->first();
        $IdCategory = $nameCategory->id;
        return view('pages.category', compact('nameCategory'));
    }
    public function genre($slug)
    {
        return view('pages.genre');
    }
    public function country($slug)
    {
        return view('pages.country');
    }
    public function movie()
    {
        return view('pages.movie');
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
