<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allCategory = Category::all();
        return view('admin.category.show-category')->with(compact('allCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create-category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $category = new Category();
            $category->title = $data['categoryName'];
            $category->slug = $data['categorySlug'];
            $category->description = $data['categoryDescription'];
            $category->status = $data['categoryStatus'];
            $category->save();
            session()->flash('success', 'Thêm danh mục thành công!');
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
        $category = Category::find($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        try {
            $category = Category::findOrFail($id);
            $category->title = $data['categoryName'];
            $category->slug = $data['categorySlug'];
            $category->description = $data['categoryDescription'];
            $category->status = $data['categoryStatus'];
            $category->save();
            return response()->json(['status' => 'success', 'message' => 'Cập nhật danh mục phim thành công']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Thông tin không hợp lệ!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if ($category) {
            $category->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Một danh mục phim đã bị xoá!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Danh mục không tồn tại!'
            ]);
        }
    }

    public function activeCategory($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->status = 1; // Kích hoạt danh mục
            $category->save();
            return response()->json(['status' => 'success', 'message' => 'Danh mục đã được kích hoạt!']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Không thể kích hoạt danh mục!']);
        }
    }

    public function unactiveCategory($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->status = 0; // Vô hiệu hóa danh mục
            $category->save();
            return response()->json(['status' => 'success', 'message' => 'Danh mục đã bị vô hiệu hóa!']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Không thể vô hiệu hóa danh mục!']);
        }
    }
}
