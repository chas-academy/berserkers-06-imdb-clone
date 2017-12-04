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
}
