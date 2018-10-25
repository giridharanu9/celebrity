<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserActivity extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user_activity';

    protected $fillable = [ 'user_id','activity_id','points','celebrity_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'remember_token' ];

    public function getActivity()
    {
        return $this->hasOne('App\Activity','id','activity_id');
    }
}
