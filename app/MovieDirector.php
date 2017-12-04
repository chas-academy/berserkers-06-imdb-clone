<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieDirector extends Model
{
    //
    protected $fillable = [
        'movie_id',
        'person_id'
    ];
}
