<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'id',
        'name',
        'bio',
        'b_date',
        'd_date'
    ];

    public $timestamps = false;

    public function roles()
    {
        return $this->hasOne('App\Profession');
    }

    public function characters()
    {
        return $this->belongsToMany('App\Character', 'title_actor_character');
    }

    public function actorInTitles()
    {
        return $this->belongsToMany('App\Title', 'title_actor_character');
    }

    public function directorOfTitles()
    {
        return $this->belongsToMany('App\Title', 'title_director');
    }

    public function producerOfTitles()
    {
        return $this->belongsToMany('App\Title', 'title_producer');
    }

    public function screenwriterOfTitles()
    {
        return $this->belongsToMany('App\Title', 'title_screenwriter');
    }
    
    public function creatorOfTitles()
    {
        return $this->belongsToMany('App\Title', 'title_creator');
    }

    public function photos()
    {
        return $this->morphMany('App\Photo', 'imageable');
    }
}
