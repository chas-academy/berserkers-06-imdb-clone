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

    public function movieUsers(){
        return $this->belongsToMany('App\User', 'movie_user_rating');
    }

    public function serieUsers(){
        return $this->belongsToMany('App\User', 'serie_user_rating');
    } //kommer deta verkligen att fungera?

    public function series(){
        return $this->belongsToMany('App\Serie', 'serie_user_rating');
    }

    
}