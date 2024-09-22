<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allGenre = Genre::all();
        return view('admin.genre.show-genre')->with(compact('allGenre'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.genre.create-genre');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $genre = new Genre();
            $genre->title = $data['genreName'];
            $genre->slug = $data['genreSlug'];
            $genre->description = $data['genreDescription'];
            $genre->status = $data['genreStatus'];
            $genre->save();
            session()->flash('success', 'Thêm thể loại thành công!');
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('error', 'Thông tin không hợp lệ!');
            return redirect()->back();
        }
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
        $genre = Genre::find($id);
        return response()->json($genre);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        try {
            $genre = Genre::findOrFail($id);
            $genre->title = $data['genreName'];
            $genre->description = $data['genreDescription'];
            $genre->slug = $data['genreSlug'];
            $genre->status = $data['genreStatus'];
            $genre->save();
            return response()->json(['status' => 'success', 'message' => 'Cập nhật thể loại phim thành công']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Thông tin không hợp lệ!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $genre = Genre::find($id);
        if ($genre) {
            $genre->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Một thể loại phim đã bị xoá!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'thể loại không tồn tại!'
            ]);
        }
    }
    public function activegenre($id)
    {
        try {
            $genre = Genre::findOrFail($id);
            $genre->status = 1;
            $genre->save();
            return response()->json(['status' => 'success', 'message' => 'thể loại đã được kích hoạt!']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Không thể kích hoạt thể loại!']);
        }
    }

    public function unactivegenre($id)
    {
        try {
            $genre = Genre::findOrFail($id);
            $genre->status = 0;
            $genre->save();
            return response()->json(['status' => 'success', 'message' => 'thể loại đã bị vô hiệu hóa!']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Không thể vô hiệu hóa thể loại!']);
        }
    }
}
