<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    protected $fillable = [
        'id',
        'rating'
    ];

    public function movies(){
        return $this->belongsToMany('App\Movie', 'movie_user_rating');
    }

    public function users(){
        return $this->belongsToMany('App\User', 'movie_user_rating');
    }
    
}