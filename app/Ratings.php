<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ratings extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'ratings';
    
    protected $fillable = [ 'id', 'user_id','celebrity_id','question_id','ratings' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function getQuestion()
    {
        return $this->hasOne('App\RatingQuestion','id','question_id');
    }

    public function getUser()
    {
        return $this->hasOne('App\User','id','user_id');
    }
    
}
