<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Movie;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function country($slug)
    {
        try {
            $slugCountry = Country::where('slug', $slug)->first();
            if (!$slugCountry) {
                abort(404);
            }
            $IdCountry = $slugCountry->id;

            $CountryAllMovie = Movie::whereHas('countries', function ($query) use ($IdCountry) {
                $query->where('countries.id', $IdCountry);
            })->where('status', 1)->orderBy('updated_at', 'desc')->paginate(30);
        } catch (\Throwable $th) {
            abort(404);
        }

        $meta_title = $slugCountry->title;
        $meta_description = $slugCountry->description;
        $meta_image = '';
        $meta_url = url('quoc-gia/' . $slug);

        return view('pages.Country', compact('slugCountry', 'CountryAllMovie', 'meta_title', 'meta_description', 'meta_image', 'meta_url'));
    }
}
