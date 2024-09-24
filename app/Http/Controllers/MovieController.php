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

        $movie_detail = Movie::with(['categories', 'genres', 'countries'])->where('id', $IdMovie)->where('status', 1)->firstOrFail();

        $view_movie = Movie::orderBy('id', 'DESC')->where('status', 1)->limit(6)->get();

        return view('pages.movie', compact('movie_detail', 'view_movie'));
    }
}
