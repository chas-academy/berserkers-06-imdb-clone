<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'id',
        'review_id',
        'user_id',
        'body',
        'created_at',
        'status'
    ];

    public function review(){
        return $this->belongsTo('App\Review');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
