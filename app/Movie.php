<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //
    protected $fillable = [
        'id',
        'title',
        'release_year',
        'plot_summary',
        'runtime',
        'countries',
        'pg_rating',
        'trailer'
    ];

    public function actors(){
        return $this->belongsToMany('App\Person', 'movie_actor');
    }

    public function directors(){
        return $this->belongsToMany('App\Person', 'movie_director');
    }

    public function producers(){
        return $this->belongsToMany('App\Person', 'movie_producer');
    }

    public function screenwriters(){
        return $this->belongsToMany('App\Person', 'movie_screenwriter');
    }

    public function ratings(){
        return $this->hasMany('App\MovieUserRating');
    }

    public function photos(){
        return $this->hasMany('App\Photo');
    }

    public function genres(){
        return $this->belongsToMany('App\Genre', 'movie_genre');
    }

    public function reviews(){
        return $this->hasMany('App\Review');
    }
}
