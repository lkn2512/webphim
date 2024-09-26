<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_movie');
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie');
    }
    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_movie');
    }
    public function views()
    {
        return $this->hasMany(MovieView::class);
    }
}
