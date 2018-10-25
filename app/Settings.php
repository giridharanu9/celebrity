<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Settings extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'settings';
    
    protected $fillable = [ 'id', 'host_name','host_email','host_password','host','host_enc','FACEBOOK_ID' ,'FACEBOOK_SECRET','FACEBOOK_URL','INSTAGRAM_KEY','INSTAGRAM_SECRET','INSTAGRAM_REDIRECT_URI','TWITTER_ID','GOOGLE_CLIENT_ID','GOOGLE_CLIENT_SECRET','GOOGLE_REDIRECT'];

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
