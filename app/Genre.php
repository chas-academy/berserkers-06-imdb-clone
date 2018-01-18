<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'id',
        'name'
    ];

    public $timestamps = false;

    public function titles()
    {
        return $this->belongsToMany('App\Title', 'title_genre' );
    }
    
}
