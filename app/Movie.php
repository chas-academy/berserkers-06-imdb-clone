<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title_id',
        'title',
        'release_year',
        'plot_summary',
        'runtime',
        'countries',
        'pg_rating',
        'trailer'
    ];

    protected $primaryKey = 'title_id';

    public $incrementing = [false];

    public function title()
    {
        return $this->belongsTo('App\Title', 'titles');
    }
}
