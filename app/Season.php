<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $fillable =[
        'id',
        'serie_id',
        'season_number',
    ];


    public function episodes(){
        return $this->hasMany('App\Episode', 'episodes');
    }

    public function series(){
        return $this->belongsTo('App\Serie', 'series');
    }
}
