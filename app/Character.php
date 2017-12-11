<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = [
        'id',
        'character_name'
    ];

    public function title()
    {
        return $this->belongsToMany('App\Movie', 'title_actor_character');
    }

    public function titleActors()
    {
        return $this->belongsToMany('App\Person', 'title_actor_character');
    }
}
