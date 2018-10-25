<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\UsersFollow;

class UsersInfo extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users_info';

    protected $fillable = [ 'user_id','gender','date_of_birth','city','pin_code','mobile','profile','total_points' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'remember_token' ];

    public function getUser()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public static function getFollowersCount($id)
    {
        return UsersFollow::where('follow_to',$id)->where('follow',1)->count();
    }

    public static function getUnFollowingCount($id)
    {
        return UsersFollow::where('followed_by',$id)->where('follow',1)->count();
    }

}
