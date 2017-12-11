<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title_id',
        'title',
        'release_year',
        'plot_summary',
        'runtime',
        'countries',
        'pg_rating',
        'trailer'
    ];

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

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
}
