<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //
    protected $fillable = [
        'id',
        'genre_title'
    ];

    public function movie_genres(){
        return $this->belongsToMany('App\Movie', 'movie_genre');
    }

    public function serie_genres(){
        return $this->belongsToMany('App\Serie', 'serie_genre');
    }
}
