<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable = [
        'id',
        'movie_id',
        'photo_path'
    ];

    public function movie(){
        return $this->belongsTo('App\Title');
    }
}
