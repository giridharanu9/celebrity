<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserActivity;
use App\UsersInfo;
use App\Activity;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$activity = UserActivity::where('user_id',\Auth::user()->id)->where('activity_id',10)->where('created_at','>=',date("Y-m-d"))->first())
        {    
            $activity = new UserActivity;
            $activity->user_id = \Auth::user()->id;
            $activity->activity_id = 10;
            $activity_points = Activity::select('points')->where('id','10')->first();
            $activity->points = $activity_points->points;
            $activity->save();


            if(!$users_info = UsersInfo::where('user_id',\Auth::user()->id)->first())
             $users_info = new UsersInfo;
             $users_info->user_id = \Auth::user()->id;
             $users_info->total_points = $users_info->total_points + $activity_points->points;
             $users_info->save();
            // dd($users_info);
        }

        if(!$activity = UserActivity::where('user_id',\Auth::user()->id)->where('activity_id',4)->where('created_at','>=',date("Y-m-d"))->first())
        {    
            $activity = new UserActivity;
            $activity->user_id = \Auth::user()->id;
            $activity->activity_id = 4;
            $activity_points = Activity::select('points')->where('id','4')->first();
            $activity->points = $activity_points->points;
            $activity->save();


            if(!$users_info = UsersInfo::where('user_id',\Auth::user()->id)->first())
             $users_info = new UsersInfo;
             $users_info->user_id = \Auth::user()->id;
             $users_info->total_points = $users_info->total_points + $activity_points->points;
             $users_info->save();
            // dd($users_info);
        }


         if(\Auth::user()->type == 1)
            return redirect('admin/category');
         else
            return redirect('/');
        // return view('home');
    }
}
