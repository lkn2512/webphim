<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information_web extends Model
{
    use HasFactory;
    protected $table = 'infomation_web';
    protected $fillable = ['title', 'copyright', 'logo', 'description'];
}
