<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonRole extends Model
{
    //
    protected $fillable = [
        'person_id',
        'actor',
        'director',
        'producer',
        'screenwriter',
    ];

    
    public function person(){
        return $this->belongsTo('App\Models\Person');
    }
}
