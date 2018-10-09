<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Likes extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'likes';
    
    protected $fillable = [ 'id', 'user_id','celebrity_id','likes','unlike' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'remember_token' ];

    public function getCelebrity()
    {
        return $this->hasOne('App\Celebrity','id','celebrity_id');
        # code...
    }
    
}
