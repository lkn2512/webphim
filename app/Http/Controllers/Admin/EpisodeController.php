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
            'episodeNumber' => 'required|numeric|min:1',
            'episodeDuration' => 'required|string',
            'episodeLink' => 'required|string',
            'episodeDescription' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }
        // Kiểm tra nếu số tập đã tồn tại cho movie_id đó
        $existingEpisode = Episode::where('movie_id', $request->episodeMoive)
            ->where('episode_number', $request->episodeNumber)
            ->first();

        if ($existingEpisode) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tập phim này đã tồn tại. Bạn không thể thêm lại!'
            ], 409);
        }
        // Create a new episode
        $episode = new Episode();
        $episode->movie_id = $request->episodeMoive;
        $episode->episode_number = $request->episodeNumber;
        $episode->link = $request->episodeLink;
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
    // public function show(string $id)
    // {
    //     // Lấy thông tin bộ phim theo ID
    //     $movie = Movie::findOrFail($id);

    //     // Lấy danh sách tập phim thuộc bộ phim
    //     $episodes = Episode::where('movie_id', $id)->get();

    //     // Trả về view cùng với dữ liệu phim và tập phim
    //     return view('admin.episode.movie-episode', compact('movie', 'episodes'));
    // }

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
            'episode_number' => 'sometimes|numeric|min:1',
            'link' => 'sometimes|string',
            'duration' => 'sometimes|string',
            'description' => 'sometimes|string',
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
        $episodes = Episode::where('movie_id', $movieId)->get();

        // Trả về view cùng với danh sách tập phim và phim đã chọn
        return view('admin.episode.show-movie-episode', [
            'episodes' => $episodes,
            'selectedMovie' => $movieId, // Truyền phim đã chọn
            'listMovie' => Movie::orderBy('title')->get() // Danh sách phim để hiển thị lại
        ]);
    }
}
