<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'id',
        'genre_title'
    ];

    public function title_genre()
    {
        return $this->belongsToMany('App\Title', 'title_genre');
    }
}
