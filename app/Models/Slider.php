<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $table = 'sliders';
    protected $fillable = ['title', 'image', 'description', 'movie_id', 'status'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
