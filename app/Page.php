<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Likes;
use App\Favorites;
use App\Follow;
use App\Ratings;
use Carbon\Carbon;

class Page extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   // protected $fillable = [ 'id' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   
}
