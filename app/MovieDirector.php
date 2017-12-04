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

    public function person(){
        return $this->belongsTo('App\Models\Person');
    }

    public function movie(){
        return $this->belongsTo('App\Models\Movie');
    }
}
