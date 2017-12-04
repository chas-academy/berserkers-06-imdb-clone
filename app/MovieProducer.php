<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieProducer extends Model
{
    //
    protected $fillable = [
        'movie_id',
        'person_id'
    ];
}
