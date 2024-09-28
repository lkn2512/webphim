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
    public function index()
    {
        return view('admin.episode.all-episode');
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
                'message' => 'Tập này đã được thêm cho phim này rồi.'
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
