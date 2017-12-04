<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieActor extends Model
{
    //
    protected $fillable = [
        'movie_id',
        'person_id'
    ];
}
