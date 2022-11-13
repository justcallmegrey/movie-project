<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;

    public $table = 'movies';

    protected $fillable = [
        'title',
        'genre',
        'released_date',
        'is_rented',
    ];
}
