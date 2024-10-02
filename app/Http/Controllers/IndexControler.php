<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Information_web;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexControler extends Controller
{
    public function home()
    {
        $information = Information_web::first();
        $meta_title = $information->title;
        $meta_description = $information->description;
        $meta_image = url(asset('uploads/informations_web/' . $information->logo));
        $meta_url = url(route('trang-chu'));

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
        $new_movie = Movie::with(['latestEpisode', 'categories'])->where('status', 1)->orderBy('updated_at', 'DESC')->limit(16)->get();

        //phim bộ
        $series_movie = Movie::whereHas('categories', function ($query) {
            $query->where('slug', 'phim-bo');
        })->where('status', 1)->orderBy('updated_at', 'desc')->limit(16)->get();

        //phim lẻ
        $single_movie = Movie::whereHas('categories', function ($query) {
            $query->where('slug', 'phim-le');
        })->where('status', 1)->orderBy('updated_at', 'desc')->limit(16)->get();

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

        return view('pages.home', compact('category', 'genre', 'country', 'new_movie', 'series_movie', 'single_movie', 'view_movie', 'rankings_day', 'rankings_week', 'rankings_month', 'top_view', 'meta_title', 'meta_description', 'meta_image', 'meta_url'));
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

        $meta_title = 'Tìm kiếm phim: ' . $keyWord;
        $meta_description = 'Tìm kiếm phim: ' . $keyWord;
        $meta_image =  '';
        $meta_url = url('tim-kiem?tu_khoa=' . $keyWord);

        return view('pages.search.search-page', compact('keyWord', 'movie', 'count_movie', 'meta_title', 'meta_description', 'meta_image', 'meta_url'));
    }

    public function loc_phim_page()
    {
        $movies = Movie::where('status', 1)->paginate(30);

        $meta_title = 'Lọc phim';
        $meta_description = 'Lọc phim';
        $meta_image =  '';
        $meta_url = url('loc-phim');

        return view('pages.filter-movie.loc-phim', compact('movies', 'meta_title', 'meta_description', 'meta_image', 'meta_url'));
    }

    public function filter_movie()
    {
        $sap_xep = request('sap-xep', '');
        $the_loai = request('the-loai', '');
        $danh_muc = request('danh-muc', '');
        $quoc_gia = request('quoc-gia', '');
        $namSX = request('namSX', '');

        if ($sap_xep == '' && $the_loai == '' && $quoc_gia == '' && $namSX == '') {
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
            if (!empty($namSX)) {
                $query->where('release_year', $namSX);
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

            $meta_title = 'Kết quả lọc';
            $meta_description = 'Kết quả lọc: sap-xep=' . $sap_xep . '&danh-muc=' . $danh_muc . '&the-loai=' . $the_loai . '&quoc-gia=' . $quoc_gia . '&namSX=' . $namSX;
            $meta_image =  '';
            $meta_url = url('loc-phim/ket-qua?sap-xep=' . $sap_xep . '&danh-muc=' . $danh_muc . '&the-loai=' . $the_loai . '&quoc-gia=' . $quoc_gia . '&namSX=' . $namSX);

            return view('pages.filter-movie.loc-phim', compact('movies', 'sap_xep', 'the_loai', 'danh_muc', 'quoc_gia', 'namSX', 'meta_title', 'meta_description', 'meta_image', 'meta_url'));
        }
    }
}
