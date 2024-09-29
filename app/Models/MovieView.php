<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieView extends Model
{
    use HasFactory;
    protected $fillable = ['movie_id', 'view_date', 'view_count',];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
