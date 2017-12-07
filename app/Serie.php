<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $fillable = [
        'id',
        'title',
        'release_year',
        'end_date',
        'plot_summary',
        'countries',
        'pg_rating',
        'trailer',
        'num_of_seasons',
        'num_of_episodes',
    ];

    public function creators(){
        return $this->belongsToMany('App\Person', 'serie_creator');
    }

    public function ratings(){
        return $this->belongsToMany('App\Rating', 'serie_user_rating');
    }

    public function seasons(){
        return $this->hasMany('App\Season', 'seasons');
    }
    

}
