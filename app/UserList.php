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

    public function titleLists() 
    {
        return $this->hasMany('App\TitleList', 'user_list_id');
    }
}
