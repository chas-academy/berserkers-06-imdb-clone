<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieScreenwriter extends Model
{
    //
    protected $fillable = [
        'movie_id',
        'person_id'
    ];
}
