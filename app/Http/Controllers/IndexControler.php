<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use Illuminate\Http\Request;

class IndexControler extends Controller
{
    public function home()
    {
        $category = Category::orderBy('title')->where('status', 1)->get();
        $genre = Genre::orderBy('title')->where('status', 1)->get();
        $country = Country::orderBy('title')->where('status', 1)->get();
        return view('pages.home', compact('category', 'genre', 'country'));
    }
    public function category($slug)
    {
        return view('pages.category');
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
