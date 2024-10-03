<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $category_count = Category::count();
        $genre_count = Genre::count();
        $country_count = Country::count();
        $movie_count = Movie::count();

        return view('admin.dashboard', compact('category_count', 'genre_count', 'country_count', 'movie_count'));
    }
}
