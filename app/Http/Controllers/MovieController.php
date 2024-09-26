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

        /*Lấy ra các phần liên quan*/
        $currentTitle = $movie_detail->title;
        $position = strpos(mb_strtolower($currentTitle), 'phần');
        if ($position !== false) {
            $baseTitle = trim(substr($currentTitle, 0, $position));
        } else {
            $baseTitle = $currentTitle;
        }
        $related_seasons = Movie::where('title', 'LIKE', '%' . $baseTitle . '%')
            ->where('id', '!=', $IdMovie)
            ->where('status', 1)
            ->get();
        /*Lấy ra các phần liên quan*/

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


        $top_view = Movie::withSum('views', 'view_count')->orderBy('views_sum_view_count', 'desc')->take(6)->get();

        return view('pages.movie', compact('movie_detail', 'cate_movies', 'gen_movies', 'country_movies', 'top_view', 'related_seasons'));
    }

    // public function trackView($movie_id)
    // {
    //     $today = Carbon::today();
    //     $movieView = MovieView::where('movie_id', $movie_id)
    //         ->where('view_date', $today)
    //         ->first();

    //     if ($movieView) {
    //         $movieView->increment('view_count');
    //     } else {
    //         MovieView::create([
    //             'movie_id' => $movie_id,
    //             'view_date' => $today,
    //             'view_count' => 1
    //         ]);
    //     }
    // }
}
