<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'firstname',
        'lastname',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function reviews(){
        return $this->hasMany('App\Review');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function ratedTitles(){
        return $this->belongsToMany('App\Title', 'title_user_rating');
    } // all titles a user have rated
}
