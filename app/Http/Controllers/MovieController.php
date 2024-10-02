<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Movie;
use App\Models\MovieView;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    public function movie($slug)
    {
        try {
            $slugMovie = Movie::where('slug', $slug)->where('status', 1)->first();
            $IdMovie = $slugMovie->id;

            //chi tiết phim
            $movie_detail = Movie::with(['categories', 'genres', 'countries', 'episodes'])->where('id', $IdMovie)->where('status', 1)->withCount('episodes')->firstOrFail();

            //Các phần liên quan
            $series_movie = Movie::with('series')->where('series_id', $movie_detail->series_id)->where('id', '!=', $movie_detail->id)->Where('series_id', '>', 0)->orderBy('title')->get();

            //Các tập phim
            $episode_movie = Episode::where('movie_id', $IdMovie)->where('status', 1)->orderBy('episode_number', 'desc')->get();

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

            $top_view = Movie::withSum('views', 'view_count')->orderBy('views_sum_view_count', 'desc')->take(10)->get();

            $meta_title = $slugMovie->title;
            $meta_description = $slugMovie->description;
            $meta_image =  url(asset('uploads/movies/' . $movie_detail->image));
            $meta_url = url('phim/' . $slug);

            return view('pages.movie', compact('movie_detail', 'series_movie', 'cate_movies', 'gen_movies', 'country_movies', 'top_view', 'episode_movie', 'meta_title', 'meta_description', 'meta_image', 'meta_url'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function watchEpisode($slug, $tap)
    {
        $movie = Movie::where('slug', $slug)->where('status', 1)->firstOrFail();
        $movie_id = $movie->id;

        $episode = $movie->episodes()->where('episode_number', $tap)->firstOrFail();

        //Các tập phim
        $episode_movie = Episode::where('movie_id', $movie_id)->where('status', 1)->orderBy('episode_number', 'desc')->get();

        //Các phần liên quan
        $series_movie = Movie::with('series')->where('series_id', $movie->series_id)->where('id', '!=', $movie->id)->Where('series_id', '>', 0)->orderBy('title')->get();

        //tăng view
        $today = Carbon::today();
        $movieView = MovieView::where('movie_id', $movie_id)
            ->where('view_date', $today)
            ->first();

        if ($movieView) {
            $movieView->increment('view_count');
        } else {
            MovieView::create([
                'movie_id' => $movie_id,
                'view_date' => $today,
                'view_count' => 1
            ]);
        }

        $meta_title = 'Xem phim ' . $movie->title . ' ' . $episode->episode_number;
        $meta_description = $movie->description;
        $meta_image =  url(asset('uploads/movies/' . $movie->image));
        $meta_url = url('phim/' . $slug);

        return view('pages.watch', compact('movie', 'episode', 'episode_movie', 'series_movie', 'meta_title', 'meta_description', 'meta_image', 'meta_url'));
    }
}
