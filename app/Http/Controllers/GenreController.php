<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function genre($slug)
    {
        try {
            $slugGenre = Genre::where('slug', $slug)->first();
            if (!$slugGenre) {
                abort(404);
            }
            $IdGenre = $slugGenre->id;

            $GenreAllMovie = Movie::whereHas('genres', function ($query) use ($IdGenre) {
                $query->where('genres.id', $IdGenre);
            })->where('status', 1)->orderBy('updated_at', 'desc')->paginate(30);
        } catch (\Throwable $th) {
            abort(404);
        }

        $meta_title = $slugGenre->title;
        $meta_description = $slugGenre->description;
        $meta_image = '';
        $meta_url = url('the-loai/' . $slug);

        return view('pages.genre', compact('slugGenre', 'GenreAllMovie', 'meta_title', 'meta_description', 'meta_image', 'meta_url'));
    }
}
