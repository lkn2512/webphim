<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information_web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $information = Information_web::first();
        return view('admin.information_web.infomation', compact('information'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

        $information = Information_web::find($id);
        // Cập nhật dữ liệu phim
        $information->title = $request->infoTitle;
        $information->description = $request->infoDescription;
        $information->copyright = $request->infoCopyright;

        $get_image = $request->file('informationImage');
        if ($get_image) {
            // Kiểm tra loại file
            $mime_type = $get_image->getClientMimeType();
            if (strpos($mime_type, 'image') !== false) {
                // Xóa ảnh cũ nếu tồn tại
                $old_image_path = public_path('uploads/informations_web/' . $information->logo);
                if (File::exists($old_image_path)) {
                    File::delete($old_image_path);
                }
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move(public_path('uploads/informations_web/'), $new_image);
                // Cập nhật tên ảnh mới vào cơ sở dữ liệu
                $information->logo = $new_image;
            }
        }
        $information->save();

        return redirect()->back()->with('success', 'Đã lưu các thay đổi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
