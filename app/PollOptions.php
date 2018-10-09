<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PollOptions extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'poll_id', 'poll_option' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'remember_token' ];

    // if do not need to save timestamps: created_at, updated_at
    public $timestamps = false;

    public function getPoll()
    {
        return $this->hasOne('App\Poll','id','poll_id');
    }

}
