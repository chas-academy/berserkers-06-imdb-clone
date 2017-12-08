<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $fillable = [
        'id',
        'season_id',
        'name',
        'episode_number',
        'plot_summary',
        'release_date',
    ];

    public function seasons(){
        return $this->belongsTo('App\Season', 'seasons');
    }

    public function actors() 
    {
        return $this->belongsToMany('App\Person', 'episode_actor_character');
    }

    public function characters(){
        return $this->belongsToMany('App\Character', 'episode_actor_character');
    }

    public function directors(){
        return $this->belongsToMany('App\Person', 'episode_director');
    }

    public function producers(){
        return $this->belongsToMany('App\Person', 'episode_producer');
    }

    public function screenwriters(){
        return $this->belongsToMany('App\Person', 'episode_screenwriter');
    }

    public function photos(){
        return $this->hasMany('App\Photo');
    }

    public function genres(){
        return $this->belongsToMany('App\Genre', 'serie_genre');
    }

    public function reviews(){
        return $this->hasMany('App\Review');
    }
}
