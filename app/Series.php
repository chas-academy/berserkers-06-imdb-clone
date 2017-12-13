<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $fillable = [
        'title',
        'release_year',
        'end_date',
        'plot_summary',
        'countries',
        'pg_rating',
        'trailer',
        'num_of_seasons',
        'num_of_episodes'
    ];

    protected $primaryKey = ['title_id'];
    
    public $incrementing = [false];
    
    public function title()
    {
        return $this->belongsTo('App\Title', 'titles');
    }

    public function seasons()
    {
        return $this->hasMany('App\Season', 'seasons');
    }
}
