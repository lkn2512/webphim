<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = ['movie_id', 'ip_address', 'author', 'avatar', 'content', 'parent_id', 'status'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
