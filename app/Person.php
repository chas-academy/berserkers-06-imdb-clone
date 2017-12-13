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

    public function roles()
    {
        return $this->hasOne('App\PersonProfession');
    }

    public function actor_in_title()
    {
        return $this->belongsToMany('App\Title', 'title_actor_character');
    }

    public function title_characters()
    {
        return $this->belongsToMany('App\Character', 'title_actor_character');
    }

    public function director_of_title()
    {
        return $this->belongsToMany('App\Title', 'title_director');
    }

    public function producer_of_title()
    {
        return $this->belongsToMany('App\Title', 'title_producer');
    }

    public function screenwriter_of_title()
    {
        return $this->belongsToMany('App\Title', 'title_screenwriter');
    }
    
    public function creator_of_title()
    {
        return $this->belongsToMany('App\Title', 'title_creator');
    }
}
