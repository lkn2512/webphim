<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

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
        $category = Category::all();
        $genre = Genre::all();
        $country = Country::all();
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
