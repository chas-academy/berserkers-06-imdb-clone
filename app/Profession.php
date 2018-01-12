<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Maybe we could rename this model to position instead? - anna
class Profession extends Model
{
    protected $fillable = [
        'person_id',
        'actor',
        'director',
        'producer',
        'screenwriter',
        'creator'
    ];

    public function person()
    {
        return $this->belongsTo('App\Person');
    }
}
