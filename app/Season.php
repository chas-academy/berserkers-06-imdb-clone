<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $fillable =[
        'title_id',
        'series_id',
        'season_number',
    ];

    protected $primaryKey = 'title_id';
    
    public $incrementing = [false];

    public $timestamps = false;    
    
    public function title()
    {
        return $this->belongsTo('App\Title', 'titles');
    }
   
    public function episodes()
    {
        return $this->hasMany('App\Episode', 'season_id');
    }

    public function series()
    {
        return $this->belongsTo('App\Series', 'series_id');
    }
}
