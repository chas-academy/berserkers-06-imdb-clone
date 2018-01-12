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

    public function actor()
    {
        return $this->belongsToMany('App\Person', 'title_actor_character');
    }
}
