<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $fillable = [
        'title_id',
        'season_id',
        'name',
        'episode_number',
        'plot_summary',
        'air_date'
    ];

    protected $primaryKey = 'title_id';
    
    public $incrementing = [false];

    public $timestamps = false;    

    public function title()
    {
        return $this->belongsTo('App\Title', 'titles');
    }

    public function season()
    {
        return $this->belongsTo('App\Season', 'season_id');
    }

    public function actors()
    {
        return $this->belongsToMany('App\Person', 'title_actor_character', 'title_id');
    }
}
