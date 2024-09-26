<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieView;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    public function movie($slug)
    {
        $slugMovie = Movie::where('slug', $slug)->where('status', 1)->first();
        $IdMovie = $slugMovie->id;

        //chi tiết phim
        $movie_detail = Movie::with(['categories', 'genres', 'countries'])->where('id', $IdMovie)->where('status', 1)->firstOrFail();

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


        // Bảng xếp hạng theo ngày
        $rankings_day = Movie::with(['views' => function ($query) {
            $query->whereDate('view_date', Carbon::today());
        }])->get()->map(function ($movie) {
            $movie->total_views = $movie->views->sum('view_count');
            return $movie;
        })->sortByDesc('total_views')->take(10);

        // Bảng xếp hạng theo tuần
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $rankings_week = Movie::with(['views' => function ($query) use ($startOfWeek, $endOfWeek) {
            $query->whereBetween('view_date', [$startOfWeek, $endOfWeek]);
        }])->get()->map(function ($movie) {
            $movie->total_views = $movie->views->sum('view_count');
            return $movie;
        })->sortByDesc('total_views')->take(10);

        // Bảng xếp hạng theo tháng
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $rankings_month = Movie::with(['views' => function ($query) use ($currentMonth, $currentYear) {
            $query->whereMonth('view_date', $currentMonth)
                ->whereYear('view_date', $currentYear);
        }])->get()->map(function ($movie) {
            $movie->total_views = $movie->views->sum('view_count');
            return $movie;
        })->sortByDesc('total_views')->take(10);

        return view('pages.movie', compact('movie_detail', 'cate_movies', 'gen_movies', 'country_movies', 'rankings_day', 'rankings_week', 'rankings_month'));
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
