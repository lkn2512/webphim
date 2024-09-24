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
        $new_movie = Movie::orderBy('id', 'DESC')->where('status', 1)->limit(8)->get();

        //phim bộ
        $series_movie = Movie::whereHas('categories', function ($query) {
            $query->where('title', 'Phim bộ');
        })->orderBy('title')->where('status', 1)->limit(12)->get();

        //phim lẻ
        $single_movie = Movie::whereHas('categories', function ($query) {
            $query->where('title', 'Phim lẻ');
        })->orderBy('title')->where('status', 1)->limit(12)->get();

        //phim hot
        $view_movie = Movie::orderBy('id', 'DESC')->where('status', 1)->get();

        return view('pages.home', compact('category', 'genre', 'country', 'new_movie', 'series_movie', 'single_movie', 'view_movie'));
    }
    public function category($slug)
    {
        try {
            $slugCategory = Category::where('slug', $slug)->first();
            if (!$slugCategory) {
                abort(404);
            }
            $IdCategory = $slugCategory->id;

            $categoryAllMovie = Movie::whereHas('categories', function ($query) use ($IdCategory) {
                $query->where('categories.id', $IdCategory);
            })->where('status', 1)->paginate(20);

            $random_movie = Movie::whereHas('categories', function ($query) use ($IdCategory) {
                $query->where('categories.id', $IdCategory);
            })->where('status', 1)->inRandomOrder()->limit(6)->get();
        } catch (\Throwable $th) {
            abort(404);
        }

        return view('pages.category', compact('slugCategory', 'categoryAllMovie', 'random_movie'));
    }
    public function genre($slug)
    {
        try {
            $slugGenre = Genre::where('slug', $slug)->first();
            if (!$slugGenre) {
                abort(404);
            }
            $IdGenre = $slugGenre->id;

            $GenreAllMovie = Movie::whereHas('genres', function ($query) use ($IdGenre) {
                $query->where('genres.id', $IdGenre);
            })->where('status', 1)->get();
        } catch (\Throwable $th) {
            abort(404);
        }

        return view('pages.genre', compact('slugGenre', 'GenreAllMovie'));
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
