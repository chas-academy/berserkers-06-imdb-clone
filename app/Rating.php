<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'id',
        'rating'
    ];

    public function titles()
    {
        return $this->belongsToMany('App\Title', 'title_user_rating');
    } // all titles with ungiven rating
    
}