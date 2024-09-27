<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allseries = Series::withCount('movies')->get();
        return view('admin.series.show-series')->with(compact('allseries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $series = Series::orderBy('title')->get();
        return view('admin.series.create-series', compact('series'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $series = new Series();
            $series->title = $data['seriesName'];
            $series->description = $data['seriesDescription'];
            $series->save();
            session()->flash('success', 'Thêm series thành công!');
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
        $series = Series::find($id);
        return response()->json($series);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        try {
            $series = Series::findOrFail($id);
            $series->title = $data['seriesName'];
            $series->description = $data['seriesDescription'];
            $series->save();
            return response()->json(['status' => 'success', 'message' => 'Cập nhật series phim thành công']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Thông tin không hợp lệ!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $series = Series::find($id);

        if ($series) {
            $series->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Một series phim đã bị xoá!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'series không tồn tại!'
            ]);
        }
    }
}
