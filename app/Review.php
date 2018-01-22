<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $fillable = [
        'id',
        'movie_id',
        'user_id',
        'title',
        'body',
        'created_at',
        'status'
    ];

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function title(){
        return $this->belongsTo('App\Movie');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
