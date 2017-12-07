<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonProfession extends Model
{
    //
    protected $fillable = [
        'person_id',
        'actor',
        'director',
        'producer',
        'screenwriter',
        'creator'
    ];

    
    public function person(){
        return $this->belongsTo('App\Person');
    }
}
