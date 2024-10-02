<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    protected $table = 'episodes';
    protected $fillable = ['movie_id', 'episode_number', 'link', 'slug', 'iframe', 'duration', 'status'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    // Hàm hiển thị tập phim - tự động sinh ra thuộc tính episode_display 
    public function getEpisodeDisplayAttribute()
    {
        if ($this->movie->isPhimle()) {
            return 'Full';  // Phim lẻ thì hiện 'Full'
        }
        return $this->episode_number;  // Phim bộ thì hiện số tập
    }
}
