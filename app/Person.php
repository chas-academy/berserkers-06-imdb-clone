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
        return $this->hasOne('App\Models\PersonRole');
    }
}
