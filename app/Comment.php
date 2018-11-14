<?php

// Comment.php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use App\User;
class Comment extends Model
{
    public function user()
    {
       // return $this->belongsTo('App\User');
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany('App\Comment', 'parent_id');
    }
}
