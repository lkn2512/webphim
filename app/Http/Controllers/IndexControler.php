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
        $new_movie = Movie::with(['latestEpisode', 'categories'])->where('status', 1)->orderBy('updated_at', 'DESC')->limit(12)->get();

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


    public function search()
    {
        if (isset($_GET['tu_khoa'])) {
            $keyWord = $_GET['tu_khoa'];
            $movie = Movie::where('title', 'LIKE', '%' . $keyWord . '%')->orWhere('description', 'LIKE', '%' . $keyWord . '%')->orderBy('updated_at', 'DESC')->paginate(30);
            $count_movie = $movie->count();
        } else {
            return redirect()->to('/');
        }
        return view('pages.search.search-page', compact('keyWord', 'movie', 'count_movie'));
    }

    public function loc_phim_page()
    {
        $movies = Movie::where('status', 1)->paginate(30);
        return view('pages.filter-movie.loc-phim', compact('movies'));
    }

    public function filter_movie()
    {
        $sap_xep = $_GET['sap-xep'];
        $the_loai = $_GET['the-loai'];
        $danh_muc = $_GET['danh-muc'];
        $quoc_gia = $_GET['quoc-gia'];
        $nam = $_GET['nam'];

        if ($sap_xep == '' && $the_loai == '' && $quoc_gia == '' && $nam == '') {
            return redirect()->back();
        } else {
            // Khởi tạo query phim với trạng thái là '1' (phim đang hiển thị)
            $query = Movie::where('status', 1);
            if (!empty($the_loai)) {
                $query->whereHas('genres', function ($q) use ($the_loai) {
                    $q->where('genres.id', $the_loai);
                });
            }
            if (!empty($danh_muc)) {
                $query->whereHas('categories', function ($q) use ($danh_muc) {
                    $q->where('categories.id', $danh_muc);
                });
            }
            if (!empty($quoc_gia)) {
                $query->whereHas('countries', function ($q) use ($quoc_gia) {
                    $q->where('countries.id', $quoc_gia);
                });
            }
            if (!empty($nam)) {
                $query->whereYear('release_year', $nam);
            }

            if (!empty($sap_xep)) {
                switch ($sap_xep) {
                    case 'date':
                        $query->orderBy('updated_at', 'DESC');
                        break;
                    case 'year_release':
                        $query->orderBy('release_year', 'DESC');
                        break;
                    case 'name_a_z':
                        $query->orderBy('title', 'ASC');
                        break;
                    case 'watch_views':
                        $query->withSum('views', 'view_count')->orderBy('views_sum_view_count', 'DESC');
                        break;
                    default:
                        $query->orderBy('updated_at', 'DESC');
                }
            }

            $movies = $query->paginate(30);
            return view('pages.filter-movie.loc-phim', compact('movies'));
        }
    }
}
