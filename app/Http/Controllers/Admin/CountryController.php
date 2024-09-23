<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\country;
use Illuminate\Http\Request;

class countryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allcountry = Country::withCount('movies')->get(); //tự động sinh ra thuộc tính moives_count
        return view('admin.country.show-country')->with(compact('allcountry'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.country.create-country');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $country = new Country();
            $country->title = $data['countryName'];
            $country->slug = $data['countrySlug'];
            $country->description = $data['countryDescription'];
            $country->status = $data['countryStatus'];
            $country->save();
            session()->flash('success', 'Thêm quốc gia thành công!');
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
        $country = Country::find($id);
        return response()->json($country);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        try {
            $country = Country::findOrFail($id);
            $country->title = $data['countryName'];
            $country->description = $data['countryDescription'];
            $country->slug = $data['countrySlug'];
            $country->status = $data['countryStatus'];
            $country->save();
            return response()->json(['status' => 'success', 'message' => 'Cập nhật tên quốc gia thành công']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Thông tin không hợp lệ!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country = Country::find($id);
        if ($country) {
            $country->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Một tên quốc gia đã bị xoá!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'quốc gia không tồn tại!'
            ]);
        }
    }
    public function activecountry($id)
    {
        try {
            $country = Country::findOrFail($id);
            $country->status = 1;
            $country->save();
            return response()->json(['status' => 'success', 'message' => 'Quốc gia đã được kích hoạt!']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Không thể kích hoạt quốc gia!']);
        }
    }

    public function unactivecountry($id)
    {
        try {
            $country = Country::findOrFail($id);
            $country->status = 0;
            $country->save();
            return response()->json(['status' => 'success', 'message' => 'Quốc gia đã bị vô hiệu hóa!']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Không thể vô hiệu hóa quốc gia!']);
        }
    }
}
