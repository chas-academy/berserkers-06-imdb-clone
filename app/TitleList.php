<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TitleList extends Model
{
    protected $fillable = [
        'id',
        'title_id',
        'user_list_id',
        'list_index'
    ];

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function userList()
    {
        return $this->belongsTo('App\UserList', 'user_list_id');
    }

    public function title()
    {
        return $this->hasOne('App\Title', 'id', 'title_id');
    }
  }