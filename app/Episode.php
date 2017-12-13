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

    protected $primaryKey = ['title_id'];
    
    public $incrementing = [false];

    public function title()
    {
        return $this->belongsTo('App\Title', 'titles');
    }

    public function seasons()
    {
        return $this->belongsTo('App\Season', 'seasons');
    }
}
