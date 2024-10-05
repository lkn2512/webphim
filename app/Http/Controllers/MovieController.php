<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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
            $series_movie = Movie::with('series')->where('series_id', $movie_detail->series_id)->where('id', '!=', $movie_detail->id)->Where('series_id', '>', 0)->orderBy('id', 'desc')->get();

            //Các tập phim
            $episode_movie = Episode::where('movie_id', $IdMovie)
                ->where('status', 1)->orderBy('id', 'desc')
                ->get();

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
        // $episode_movie = Episode::where('movie_id', $movie_id)
        //     ->where('status', 1)
        //     ->orderByRaw('REGEXP_REPLACE(episode_number, "[^0-9]", "") + 0 DESC')
        //     ->get();
        $episode_movie = Episode::where('movie_id', $movie_id)
            ->where('status', 1)
            ->orderByDesc('id')
            ->get();

        //Các phần liên quan
        $series_movie = Movie::with('series')->where('series_id', $movie->series_id)->where('id', '!=', $movie->id)->Where('series_id', '>', 0)->orderBy('id', 'desc')->get();

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

    public function load_comment(Request $request)
    {
        $movie_id = $request->movie_id;
        $ipAddress = request()->ip();

        $comments = Comment::with('movie')
            ->where('movie_id', $movie_id)
            ->orderBy('id', 'DESC')
            ->paginate(6);

        $output = '';
        if ($comments->isEmpty()) {
            $output .= '<div class="no-comments">Hiện không có bình luận nào!</div>';
        } else {
            foreach ($comments as $comment) {
                $output .= '<div class="comment-item">
                <div class="row">
                    <div class="col-lg-1 col-md-2 col-sm-3 col-2 mb-1 mt-1">';
                if (!is_null($comment->avatar)) {
                    $output .= '<img class="img-comment" src="' . asset('Frontend/image/' . $comment->avatar) . '" alt="Avatar">';
                } else {
                    $output .= '<img class="img-comment" src="' . asset('Frontend/image/avatar.png') . '" alt="Avatar">';
                }
                $output .= '</div>
                    <div class="col-lg-11 col-md-10 col-sm-9 col-12 mb-1 mt-1">
                        <div class="comment-author">
                            <span class="comment-name">' . htmlspecialchars($comment->author) . '</span> 
                            <span class="time"><i class="fa-regular fa-clock"></i> ' . $comment->created_at->diffForHumans() . '</span>
                        </div>
                        <div class="comment-content">
                            ' . nl2br(htmlspecialchars($comment->content)) . '</br>';

                // Chỉ hiển thị thẻ <a> xoá bình luận nếu địa chỉ IP trùng khớp
                if ($ipAddress == $comment->ip_address) {
                    $output .= '<a type="button" class="recall-comment" data-comment_id="' . htmlspecialchars($comment->id) . '">Xoá bình luận</a>';
                }
                $output .= '</div>
                        </div>
                    </div>
                </div>';
            }


            // Thêm phân trang
            $output .= '<div class="pagination">';
            // Trang trước
            if ($comments->currentPage() > 1) {
                $output .= '<a href="?page=' . ($comments->currentPage() - 1) . '">Trước</a>';
            }
            // Số trang hiển thị trước và sau trang hiện tại
            $range = 2; // Số trang trước và sau trang hiện tại
            // Hiển thị trang đầu tiên
            if ($comments->currentPage() > $range + 1) {
                $output .= '<a href="?page=1">1</a>';
                if ($comments->currentPage() > $range + 2) {
                    $output .= '<span class="page-disable">...</span>'; // Hiển thị dấu ba chấm
                }
            }
            // Hiển thị các trang xung quanh trang hiện tại
            for ($i = max(1, $comments->currentPage() - $range); $i <= min($comments->lastPage(), $comments->currentPage() + $range); $i++) {
                if ($i == $comments->currentPage()) {
                    $output .= '<span class="page-now">' . $i . '</span>'; // Trang hiện tại
                } else {
                    $output .= '<a href="?page=' . $i . '">' . $i . '</a>'; // Các trang khác
                }
            }
            // Hiển thị trang cuối cùng
            if ($comments->currentPage() < $comments->lastPage() - $range) {
                if ($comments->currentPage() < $comments->lastPage() - $range - 1) {
                    $output .= '<span class="page-disable">...</span>'; // Hiển thị dấu ba chấm
                }
                $output .= '<a href="?page=' . $comments->lastPage() . '">' . $comments->lastPage() . '</a>'; // Trang cuối cùng
            }
            // Trang tiếp theo
            if ($comments->hasMorePages()) {
                $output .= '<a href="?page=' . ($comments->currentPage() + 1) . '">Sau</a>';
            }
            $output .= '</div>';
        }
        return response()->json(['output' => $output]);
    }

    public function send_comment(Request $request)
    {
        // Lưu bình luận vào bảng Comment
        $comment = new Comment();
        $ipAddress = request()->ip();
        $comment->ip_address = $ipAddress;
        $comment->avatar =  $request->avatar;
        $comment->movie_id = $request->movie_id;
        $comment->author = $request->author;
        $comment->content = $request->content;

        $comment->save();

        return response()->json(['success' => true]);
    }
    public function recall_comment(Request $request)
    {
        $comment = Comment::where('id', $request->comment_id)->first();
        if ($comment) {
            // $comment_replies = Comment::where('comment_parent_comment', $request->comment_id)->get();
            // foreach ($comment_replies as $com_rep) {
            //     $com_rep->delete();
            // }
            $comment->delete();
        }
    }
}
