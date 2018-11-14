<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Likes;
use App\Favorites;
use App\Follow;
use App\Ratings;
use Carbon\Carbon;
use App\Comment;
class Celebrity extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'id', 'categoryid' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'remember_token' ];

    public function getCategory()
    {
        return $this->hasOne('App\Category','id','categoryid');
    }
    

    public static function getLikesCount($id)
    {
        return Likes::where('celebrity_id',$id)->where('likes',1)->count();
    }

    public static function getLikesWeeklyCount($id)
    {
        
         $sum = Likes::where('celebrity_id',$id)->where('likes',1)->whereBetween('created_at', [Carbon::parse('last monday')->startOfDay(),Carbon::parse('next friday')->endOfDay(),])->sum('likes');

         $total_sum = Likes::where('celebrity_id',$id)->whereBetween('created_at', [Carbon::parse('last monday')->startOfDay(),Carbon::parse('next friday')->endOfDay(),])->count();
         if($total_sum != 0)
            $avg = $sum / $total_sum * 100;
         else
            $avg = 0;
         return round($avg);
    }

    public static function getLikesMonthlyCount($id)
    {
        $first_day_this_month = date('Y-m-01 00:00:00'); // hard-coded '01' for first day
        $last_day_this_month  = date('Y-m-t 12:59:59');

        $sum = Likes::where('celebrity_id',$id)->where('likes',1)->whereBetween('created_at', [$first_day_this_month, $last_day_this_month])->count();

        $total_sum = Likes::where('celebrity_id',$id)->whereBetween('created_at', [$first_day_this_month, $last_day_this_month])->count();
         if($total_sum != 0)
            $avg = $sum / $total_sum * 100;
         else
            $avg = 0;
         return round($avg);

    }

    public static function getLikesYearlyCount($id)
    {
        $timestemp = date("Y-m-d H:s:i");
        $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestemp)->year;

        $sum = Likes::where('celebrity_id',$id)->where('likes',1)->whereYear('created_at',$year)->count();

        $total_sum = Likes::where('celebrity_id',$id)->whereYear('created_at',$year)->count();
         if($total_sum != 0)
            $avg = $sum / $total_sum * 100;
         else
            $avg = 0;
         return round($avg);
    }

    public static function getDisLikesCount($id)
    {
       return Likes::where('celebrity_id',$id)->where('likes',0)->count();
    }

    public static function getDisLikesWeeklyCount($id)
    {
        
        $sum = Likes::where('celebrity_id',$id)->where('likes',0)->whereBetween('created_at', [Carbon::parse('last monday')->startOfDay(),Carbon::parse('next friday')->endOfDay(),])->count();

        $total_sum = Likes::where('celebrity_id',$id)->whereBetween('created_at', [Carbon::parse('last monday')->startOfDay(),Carbon::parse('next friday')->endOfDay(),])->count();
         if($total_sum != 0)
            $avg = $sum / $total_sum * 100;
         else
            $avg = 0;
         return round($avg);
    }

    public static function getDisLikesMonthlyCount($id)
    {
        $first_day_this_month = date('Y-m-01 00:00:00'); // hard-coded '01' for first day
        $last_day_this_month  = date('Y-m-t 12:59:59');

        $sum = Likes::where('celebrity_id',$id)->where('likes',0)->whereBetween('created_at', [$first_day_this_month, $last_day_this_month])->count();

        $total_sum = Likes::where('celebrity_id',$id)->whereBetween('created_at', [$first_day_this_month, $last_day_this_month])->count();
         if($total_sum != 0)
            $avg = $sum / $total_sum * 100;
         else
            $avg = 0;
         return round($avg);

    }

    public static function getDisLikesYearlyCount($id)
    {
        $timestemp = date("Y-m-d H:s:i");
        $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestemp)->year;

        $sum = Likes::where('celebrity_id',$id)->where('likes',0)->whereYear('created_at',$year)->count();

        $total_sum = Likes::where('celebrity_id',$id)->whereYear('created_at',$year)->count();
         if($total_sum != 0)
            $avg = $sum / $total_sum * 100;
         else
            $avg = 0;
         return round($avg);
    }

    public static function getFollowCount($id)
    {
        return Follow::where('celebrity_id',$id)->where('follow',1)->count();
    }

    public static function getUnFollowCount($id)
    {
        return Follow::where('celebrity_id',$id)->where('follow',0)->count();
    }

    public static function getFavoritesCount($id)
    {
        return Favorites::where('celebrity_id',$id)->where('favorite',1)->count();
    }

    public static function getUnFavoritesCount($id)
    {
        return Favorites::where('celebrity_id',$id)->where('favorite',0)->count();
    }

     public static function getRatingCount($id,$question_id)
    {
        return round( Ratings::where('celebrity_id',$id)->where('question_id',$question_id)->avg('ratings') );
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comments()
    {
        //echo "ashish";;
        return $this->morphMany(Comment::class, 'commentable')
        ->whereNull('parent_id');
        //->AWhere('parent_id', 0);
        //->orWhere('parent_id', 0);
       // return $this->hasMany('App\Comment', 'commentable_id')->whereNull('parent_id');
    }
}
