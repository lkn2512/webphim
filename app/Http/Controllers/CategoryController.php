<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category($slug)
    {
        $slugCategory = Category::where('slug', $slug)->first();
        if (!$slugCategory) {
            abort(404);
        }
        $IdCategory = $slugCategory->id;
        $titleCategory = $slugCategory->title;

        $categoryAllMovie = Movie::whereHas('categories', function ($query) use ($IdCategory) {
            $query->where('categories.id', $IdCategory);
        })->where('status', 1)->orderBy('updated_at', 'desc')->paginate(20);

        $bxh_movie = Movie::whereHas('categories', function ($query) use ($IdCategory) {
            $query->where('categories.id', $IdCategory);
        })->whereHas('views', function ($query) {
            $query->where('view_count', '>', 0);
        })->withSum('views', 'view_count')->where('status', 1)->orderBy('views_sum_view_count', 'desc')->paginate(10);

        $meta_title = $slugCategory->title;
        $meta_description = $slugCategory->description;
        $meta_image = '';
        $meta_url = url('danh-muc/' . $slug);

        return view('pages.category', compact('slugCategory', 'titleCategory', 'categoryAllMovie', 'bxh_movie', 'meta_title', 'meta_description', 'meta_image', 'meta_url'));
    }
}
