<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'name'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function titles()
    {
        return $this->belongsToMany('App\Title', 'title_list');
    }

}
