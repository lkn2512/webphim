<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movie = Movie::orderBy('title')->get();
        $allSlider = Slider::with('movie')->orderBy('updated_at', 'desc')->get();
        return view('admin.slider.show-slider', compact('allSlider', 'movie'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $movie = Movie::orderBy('title')->get();
        return view('admin.slider.create-slider', compact('movie'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $slider = new Slider();
            $slider->title = $data['sliderTitle'];

            $get_image = $request->file('sliderImage');
            if ($get_image) {
                $mime_type = $get_image->getClientMimeType();
                if (strpos($mime_type, 'image') !== false) {
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.', $get_name_image));
                    $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                    $get_image->move(public_path('uploads/slider/'), $new_image);
                    $slider->image = $new_image;
                }
            }

            $slider->description = $data['sliderDescription'];
            $slider->status = $data['sliderStatus'];
            $slider->movie_id = $data['movie_id'];
            $slider->save();

            return redirect()->back()->with('success', 'Slider đã được thêm thành công!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Thông tin không hợp lệ!');
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
        $slider = Slider::find($id);
        $movie = Movie::orderBy('title')->get();
        return view('admin.slider.edit-slider', compact('slider', 'movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $slider = Slider::findOrFail($id);
        $slider->title = $request->sliderTitle;
        $slider->description = $request->sliderDescription;
        $slider->status = $request->sliderStatus;
        $slider->movie_id = $request->movie_id;
        $get_image = $request->file('sliderImage');

        if ($get_image) {
            $mime_type = $get_image->getClientMimeType();
            if (strpos($mime_type, 'image') !== false) {
                $old_image_path = public_path('uploads/slider/' . $slider->image);
                if (File::exists($old_image_path)) {
                    File::delete($old_image_path);
                }
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move(public_path('uploads/slider/'), $new_image);

                $slider->image = $new_image;
            }
        }
        $slider->save();
        return redirect()->back()->with('success', 'Đã lưu các thay đổi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::find($id);

        if ($slider) {
            $slider_img = $slider->image;
            if ($slider_img && file_exists(public_path('uploads/slider/' . $slider_img))) {
                unlink(public_path('uploads/slider/' . $slider_img));
            }
            $slider->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Xoá slider thành công!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'slider không tồn tại!'
            ]);
        }
    }
    public function activeSlider($id)
    {
        try {
            $slider = Slider::findOrFail($id);
            $slider->status = 1;
            $slider->save();
            return response()->json(['status' => 'success', 'message' => 'slider đã được kích hoạt!']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Không thể kích hoạt slider!']);
        }
    }

    public function unactiveSlider($id)
    {
        try {
            $slider = Slider::findOrFail($id);
            $slider->status = 0;
            $slider->save();
            return response()->json(['status' => 'success', 'message' => 'slider đã bị vô hiệu hóa!']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Không thể vô hiệu hóa Phim!']);
        }
    }
}
