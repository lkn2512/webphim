<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listMovie = Movie::with(['categories', 'genres', 'countries'])->orderBy('id', 'DESC')->get();
        return view('admin.movie.all-movie', compact('listMovie'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::orderBy('title')->get();
        $genre = Genre::orderBy('title')->get();
        $country = Country::orderBy('title')->get();
        return view('admin.movie.create-movie', compact('category', 'genre', 'country'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $movie = new Movie();
            $movie->title = $data['movieName'];
            $movie->slug = $data['movieSlug'];

            $get_image = $request->file('movieImage');
            if ($get_image) {
                $mime_type = $get_image->getClientMimeType();
                if (strpos($mime_type, 'image') !== false) {
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.', $get_name_image));
                    $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                    $get_image->move(public_path('uploads/movies/'), $new_image);
                    $movie->image = $new_image;
                }
            }

            $movie->description = $data['movieDescription'];
            $movie->status = $data['movieStatus'];
            $movie->save();

            // Xử lý các phân loại, thể loại, và quốc gia
            if (isset($data['movieCategory'])) {
                $movie->categories()->attach($data['movieCategory']);
            }

            if (isset($data['movieGenre'])) {
                $movie->genres()->attach($data['movieGenre']);
            }

            if (isset($data['movieCountry'])) {
                $movie->countries()->attach($data['movieCountry']);
            }

            return redirect()->back()->with('success', 'Phim đã được thêm thành công!');
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
        $category = Category::orderBy('title')->get();
        $genre = Genre::orderBy('title')->get();
        $country = Country::orderBy('title')->get();

        $editMovie = Movie::with(['categories', 'genres', 'countries'])->where('id', $id)->firstOrFail();
        return view('admin.movie.edit-movie', compact('editMovie', 'category', 'genre', 'country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $movie = Movie::find($id);
            // Cập nhật dữ liệu phim
            $movie->title = $request->movieName;
            $movie->slug = $request->movieSlug;
            $movie->description = $request->movieDescription;
            $movie->status = $request->movieStatus;

            $get_image = $request->file('movieImage');
            if ($get_image) {
                // Kiểm tra loại file
                $mime_type = $get_image->getClientMimeType();
                if (strpos($mime_type, 'image') !== false) {
                    // Xóa ảnh cũ nếu tồn tại
                    $old_image_path = public_path('uploads/movies/' . $movie->image);
                    if (File::exists($old_image_path)) {
                        File::delete($old_image_path);
                    }
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.', $get_name_image));
                    $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                    $get_image->move(public_path('uploads/movies/'), $new_image);
                    // Cập nhật tên ảnh mới vào cơ sở dữ liệu
                    $movie->image = $new_image;
                }
            }
            $movie->save();

            // Cập nhật danh mục, thể loại, quốc gia
            $movie->categories()->sync($request->movieCategory);
            $movie->genres()->sync($request->movieGenre);
            $movie->countries()->sync($request->movieCountry);

            return redirect()->back()->with('success', 'Đã lưu các thay đổi');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Dữ liệu không hợp lệ');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::find($id);

        if ($movie) {
            $movie_img = $movie->image;
            if ($movie_img && file_exists(public_path('uploads/movies/' . $movie_img))) {
                unlink(public_path('uploads/movies/' . $movie_img));
            }
            $movie->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Xoá phim thành công!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Phim không tồn tại!'
            ]);
        }
    }

    public function activeMovie($id)
    {
        try {
            $movie = Movie::findOrFail($id);
            $movie->status = 1;
            $movie->save();
            return response()->json(['status' => 'success', 'message' => 'Phim đã được kích hoạt!']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Không thể kích hoạt Phim!']);
        }
    }

    public function unactiveMovie($id)
    {
        try {
            $movie = Movie::findOrFail($id);
            $movie->status = 0;
            $movie->save();
            return response()->json(['status' => 'success', 'message' => 'Phim đã bị vô hiệu hóa!']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Không thể vô hiệu hóa Phim!']);
        }
    }
}
