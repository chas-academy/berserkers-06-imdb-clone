<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = [
        'character_name'
    ];

    public $timestamps = false;
    
    public function title()
    {
        return $this->belongsToMany('App\Title', 'title_actor_character');
    }

    public function titleActors()
    {
        return $this->belongsToMany('App\Title', 'title_actor_character');
    }
}
