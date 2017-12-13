<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $fillable = [
        'id',
        'type'
    ];

    public function movie()
    {
        return $this->hasOne('App\Movie', 'movies');
    }

    public function series()
    {
        return $this->hasOne('App\Series', 'series');
    }

    public function season()
    {
        return $this->hasOne('App\Season', 'seasons');
    }

    public function episode()
    {
        return $this->hasOne('App\Episode', 'episodes');
    }

    /******** */
    public function actors()
    {
        return $this->belongsToMany('App\Person', 'title_actor_character');
    }

    public function characters()
    {
        return $this->belongsToMany('App\Character', 'title_actor_character');
    }

    public function directors()
    {
        return $this->belongsToMany('App\Person', 'title_director');
    }

    public function producers()
    {
        return $this->belongsToMany('App\Person', 'title_producer');
    }

    public function screenwriters()
    {
        return $this->belongsToMany('App\Person', 'title_screenwriter');
    }
    
    public function creators()
    {
        return $this->belongsToMany('App\Person', 'title_creator');
    }

    public function ratings()
    {
        return $this->belongsToMany('App\Rating', 'title_user_rating');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Genre', 'title_genre');
    }

}
