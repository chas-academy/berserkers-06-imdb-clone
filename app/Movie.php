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
        return $this->hasMany('App\Models\MovieActor');
    }

    public function directors(){
        return $this->hasMany('App\Models\MovieDirector');
    }

    public function producers(){
        return $this->hasMany('App\Models\MovieProducer');
    }

    public function screenwriters(){
        return $this->hasMany('App\Models\MovieScreenwriter');
    }

    public function ratings(){
        return $this->hasMany('App\Models\MovieUserRating');
    }

    public function photos(){
        return $this->hasMany('App\Models\Photo');
    }

    public function genres(){
        return $this->hasMany('App\Models\MovieGenre');
    }

    public function reviews(){
        return $this->hasMany('App\Models\Review');
    }
}
