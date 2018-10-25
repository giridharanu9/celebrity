<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class RatingQuestion extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'rating_question';
    
    protected $fillable = [ 'id','category','skill' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
}
