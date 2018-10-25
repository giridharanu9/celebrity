<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UsersFollow extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users_follow';
    
    protected $fillable = [ 'id', 'follow_to','followed_by','follow' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'remember_token' ];

    public function getFollowing()
    {
        return $this->hasOne('App\UsersInfo','user_id','follow_to');
    }

    public function getFollowers()
    {
        return $this->hasOne('App\UsersInfo','user_id','followed_by');
    }

}
