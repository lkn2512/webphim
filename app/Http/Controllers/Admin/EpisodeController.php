<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listMovie = Movie::orderBy('title')->get();
        return view('admin.episode.select-movie-episode', compact('listMovie'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listMovie = Movie::orderBy('title')->get();
        return view('admin.episode.create-episode', compact('listMovie'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate input fields
        $validator = Validator::make($request->all(), [
            'episodeMoive' => 'required|exists:movies,id',
            'episodeNumber' => 'required|string',
            'episodeDuration' => 'required|string',
            'episodeLink' => 'required|string',
            'episodeDescription' => 'nullable|string',
            'episodeStatus' => 'required|boolean',  // Thêm xác thực trạng thái tập phim nếu cần
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Lấy thông tin phim từ bảng movies
        $movie = Movie::findOrFail($request->episodeMoive);

        // Kiểm tra xem phim có phải là phim lẻ hay không
        if ($movie->isPhimle()) {
            // Nếu là phim lẻ, kiểm tra nếu đã tồn tại 1 tập
            $existingEpisode = Episode::where('movie_id', $movie->id)->first();

            if ($existingEpisode) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Phim lẻ chỉ có thể có 1 tập. Bạn không thể thêm tập mới!'
                ], 409);
            }
            // Nếu chưa có tập nào, thêm tập với số tập là "1" (hoặc 'Full' nếu muốn)
            $episodeNumber = 'Full';
        } else {
            // Kiểm tra nếu số tập đã tồn tại cho phim bộ
            $existingEpisode = Episode::where('movie_id', $movie->id)
                ->where('episode_number', $request->episodeNumber)
                ->first();

            if ($existingEpisode) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tập phim này đã tồn tại. Bạn không thể thêm lại!'
                ], 409);
            }

            // Nếu là phim bộ, sử dụng số tập được cung cấp từ request
            $episodeNumber = $request->episodeNumber;
        }

        // Create a new episode
        $episode = new Episode();
        $episode->movie_id = $request->episodeMoive;
        $episode->episode_number = $episodeNumber; // Sử dụng số tập đã được quyết định ở trên
        $episode->link = $request->episodeLink;
        $episode->iframe = '<iframe width="100%" height="570" src="' . $request->episodeLink . '" title="video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
        $episode->duration = $request->episodeDuration;
        $episode->description = $request->episodeDescription;
        $episode->status = $request->episodeStatus;
        $episode->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Thêm tập phim thành công.'
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $episode = Episode::findOrFail($id);

        // Xác thực dữ liệu
        $request->validate([
            'episode_number' => 'sometimes|string',
            'link' => 'sometimes|string',
            'duration' => 'sometimes|string',
            'description' => 'sometimes',
        ]);

        // Nếu có cập nhật episode_number, kiểm tra trùng lặp với movie_id hiện tại
        if ($request->has('episode_number')) {
            // Lấy movie_id của tập hiện tại
            $currentMovieId = $episode->movie_id;

            // Kiểm tra trùng lặp episode_number trong cùng movie_id
            $duplicateEpisode = Episode::where('episode_number', $request->episode_number)
                ->where('movie_id', $currentMovieId)
                ->where('id', '!=', $id) // loại bỏ tập hiện tại khỏi kiểm tra
                ->first();

            if ($duplicateEpisode) {
                return response()->json(['status' => 'error', 'message' => 'Tập phim này đã tồn tại. Bạn không thể thêm lại!'], 409);
            }

            // Cập nhật episode_number
            $episode->episode_number = $request->episode_number;
        }

        // Cập nhật các trường dữ liệu còn lại
        if ($request->has('link')) {

            $episode->link = $request->link;
            $episode->iframe = '<iframe width="100%" height="570" src="' . $request->link . '" title="video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
        }
        if ($request->has('duration')) {
            $episode->duration = $request->duration;
        }
        if ($request->has('description')) {
            $episode->description = $request->description;
        }

        $episode->save();
        return response()->json(['status' => 'success', 'message' => 'Cập nhật thành công!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $episode = Episode::find($id);
        if ($episode) {
            $episode->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Một tập phim đã bị xoá!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'tập phim không tồn tại!'
            ]);
        }
    }

    public function showEpisodes(Request $request)
    {
        // Lấy ID phim đã chọn từ form
        $movieId = $request->input('selectedMovie');

        // Lấy danh sách các tập liên quan đến phim
        $episodes = Episode::where('movie_id', $movieId)->orderByDesc('id')->get();

        // Trả về view cùng với danh sách tập phim và phim đã chọn
        return view('admin.episode.show-movie-episode', [
            'episodes' => $episodes,
            'selectedMovie' => $movieId, // Truyền phim đã chọn
            'listMovie' => Movie::orderBy('title')->get() // Danh sách phim để hiển thị lại
        ]);
    }
    public function activeEpisode($id)
    {
        try {
            $episode = Episode::findOrFail($id);
            $episode->status = 1;
            $episode->save();
            return response()->json(['status' => 'success', 'message' => 'Tập phim đã được kích hoạt!']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Không thể kích hoạt tập phim!']);
        }
    }

    public function unactiveEpisode($id)
    {
        try {
            $episode = Episode::findOrFail($id);
            $episode->status = 0;
            $episode->save();
            return response()->json(['status' => 'success', 'message' => 'Tập phim đã bị vô hiệu hóa!']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Không thể vô hiệu hóa tập phim!']);
        }
    }
}
