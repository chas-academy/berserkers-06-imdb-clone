<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'id',
        'rating'
    ];

    public function titles()
    {
        return $this->belongsToMany('App\Movie', 'title_user_rating');
    }

    public function titleUsers()
    {
        return $this->belongsToMany('App\User', 'title_user_rating');
    }

    public function seriesUsers()
    {
        return $this->belongsToMany('App\User', 'series_user_rating');
    } // kommer detta verkligen att fungera?

    public function series()
    {
        return $this->belongsToMany('App\Series', 'title_user_rating');
    }
    
}