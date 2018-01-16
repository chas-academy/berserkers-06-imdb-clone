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
        return $this->hasOne('App\Movie', 'title_id');
    }

    public function series()
    {
        return $this->hasOne('App\Series', 'title_id');
    }

    public function season()
    {
        return $this->hasMany('App\Season', 'title_id');
    }

    public function episode()
    {
        return $this->hasMany('App\Episode', 'title_id');
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

    public function photos()
    {
        return $this->morphMany('App\Photo', 'imageable');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Genre', 'title_genre');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function ratings()
    {
        return $this->belongsToMany('App\Rating', 'title_user_rating');
    } // all 1 - 10 ratings this title recieved

    public function users()
    {
        return $this->belongsToMany('App\User', 'title_user_rating');
    } // all users that have rated this title

}
