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
        return $this->belongsTo('App\Title', 'title_id');
    }

    public function season()
    {
        return $this->belongsTo('App\Season', 'season_id');
    }

    public function actors()
    {
        return $this->belongsToMany('App\Person', 'title_actor_character', 'title_id');
    }

    public function directors()
    {
        return $this->belongsToMany('App\Person', 'title_director', 'title_id');
    }

    public function producers()
    {
        return $this->belongsToMany('App\Person', 'title_producer', 'title_id');
    }

    public function screenwriters()
    {
        return $this->belongsToMany('App\Person', 'title_screenwriter', 'title_id' );
    }
}
