<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Carbon\Carbon;
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
        $new_movie = Movie::orderBy('updated_at', 'DESC')->where('status', 1)->limit(12)->get();

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

        // Top lượt xem
        $top_view = Movie::withSum('views', 'view_count')->orderBy('views_sum_view_count', 'desc')->take(10)->get();


        return view('pages.home', compact('category', 'genre', 'country', 'new_movie', 'series_movie', 'single_movie', 'view_movie', 'rankings_day', 'rankings_week', 'rankings_month', 'top_view'));
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
