<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'id',
        'imageable_id',
        'imageable_type',
        'photo_path',
        'photo_type',
        'width',
        'ratio'
    ];

    public $timestamps = false;
    
    public function imageable()
    {
        return $this->morphTo();
    }


}
