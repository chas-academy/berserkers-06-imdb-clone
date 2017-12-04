<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //
    protected $fillable = [
        'id',
        'genre_title'
    ];

    public function genres(){
        return $this->belongsTo('App\Models\Genre');
    }
}
