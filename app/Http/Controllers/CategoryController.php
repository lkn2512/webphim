<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
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
}
