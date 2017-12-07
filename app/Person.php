<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    //
    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'birthdate',
        'deathdate',
    ];

    public function roles(){
        return $this->hasOne('App\PersonProfession');
    }

    public function actor_in_movie(){
        return $this->belongsToMany('App\Movie', 'movie_actor_character');
    }

    public function characters(){
        return $this->belongsToMany('App\Character', 'movie_actor_character');
    }

    public function director_in_movie(){
        return $this->belongsToMany('App\Movie', 'movie_director');
    }

    public function producer_in_movie(){
        return $this->belongsToMany('App\Movie', 'movie_producer');
    }

    public function screenwriter_in_movie(){
        return $this->belongsToMany('App\Movie', 'movie_screenwriter');
    }
}