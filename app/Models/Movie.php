<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'sub_title', 'series_id', 'slug', 'description', 'translation', 'release_year', 'status', 'image'];

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
    public function series()
    {
        return $this->belongsTo(Series::class);
    }
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    //phim mới nhất
    public function latestEpisode()
    {
        return $this->hasOne(Episode::class)->latest();
    }

    // Hàm kiểm tra phim lẻ
    public function isPhimle()
    {
        return $this->categories->contains('slug', 'phim-le');
    }

    // Hàm kiểm tra phim bộ
    public function isPhimbo()
    {
        return $this->categories->contains('slug', 'phim-bo');
    }
}
