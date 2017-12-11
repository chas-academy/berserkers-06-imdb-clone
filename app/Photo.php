<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'id',
        'title_id',
        'photo_path'
    ];

    public function title(){
        return $this->belongsTo('App\Title');
    }
}
