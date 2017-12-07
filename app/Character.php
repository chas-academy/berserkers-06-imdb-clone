<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    //
    protected $fillable = [
        'id',
        'character_name'
    ];

    public function movies(){
        return $this->belongsToMany('App\Movie', 'movie_actor_character');
    }

    public function movieActors(){
        return $this->belongsToMany('App\Person', 'movie_actor_character');
    }

    public function serieActors(){
        return $this->belongsToMany('App\Person', 'serie_actor_character');
    }
}
