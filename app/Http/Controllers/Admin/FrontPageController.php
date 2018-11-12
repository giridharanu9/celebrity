<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Celebrity;
use App\User;
use App\UsersInfo;
use App\Favorites;
use App\UsersFollow;
use App\UserActivity;
use App\Activity;
use App\PollsRespond;
use App\Subscribe;
use App\Poll;
use App\Category;
use Log;
use App\Page;

class FrontPageController extends Controller
{
	public function actors()
	{
		$celebrity = Celebrity::where('categoryid','3')->get();
		$categories = Category::get();
		return view('Frontend.actors',compact('celebrity','categories'));
	}

	public function actress()
	{
		$celebrity = Celebrity::where('categoryid','6')->get();
		$categories = Category::get();
		return view('Frontend.actress',compact('celebrity','categories'));
	}

	public function singers()
	{
		$celebrity = Celebrity::where('categoryid','5')->get();
		$categories = Category::get();
		return view('Frontend.singers',compact('celebrity','categories'));
	}

	public function artists()
	{
		$celebrity = Celebrity::where('categoryid','1')->get();
		$categories = Category::get();
		return view('Frontend.artists',compact('celebrity','categories'));
	}

	public function politicians()
	{
		$celebrity = Celebrity::where('categoryid','4')->get();
		$categories = Category::get();
		return view('Frontend.politicians',compact('celebrity','categories'));
	}

	public function sports()
	{
		$celebrity = Celebrity::where('categoryid','2')->get();
		$categories = Category::get();
		return view('Frontend.sports',compact('celebrity','categories'));
	}

	public function music()
	{
		$celebrity = Celebrity::where('categoryid','5')->get();
		$categories = Category::get();
		return view('Frontend.music',compact('celebrity','categories'));
	}

	public function movies()
	{
		$celebrity = Celebrity::where('categoryid','3')->get();
		$categories = Category::get();
		return view('Frontend.movies',compact('celebrity','categories'));
	}

	public function viewPolls()
	{
		$polls = Poll::orderBy('created_at','desc')->get();
		$categories = Category::get();
		return view('Frontend.view_polls',compact('polls','categories'));
	}

	public function allUsers()
	{
		$users_info = UsersInfo::where('user_id','!=',\Auth::user()->id)->get();
		$categories = Category::get();
		return view('Frontend.all_users',compact('users_info','users_follow','categories'));
	}

	public function viewUsers($id)
	{
		$users_info = UsersInfo::find($id);
		$favorites = Favorites::where('user_id',$id)->where('favorite',1)->get();
		$users_follow = UsersFollow::where('follow_to',$users_info->user_id)->where('followed_by',\Auth::user()->id)->first();
		$categories = Category::get();
		//dd($users_follow);
		return view('Frontend.view_users',compact('users_info','favorites','users_follow','categories'));
	}

	public function followUser($id)
	{
		//dd($id);
		if(!$users_follow = UsersFollow::where('followed_by',\Auth::user()->id)->where('follow_to',$id)->where('follow',1)->first())
		{
			$users_follow = new UsersFollow;


	        $output = "success";

	        $users_follow->followed_by = \Auth::user()->id;
	        $users_follow->follow_to = $id;
	        $users_follow->follow = 1;

	        $users_follow->save();

	        if(!$activity = UserActivity::where('user_id',\Auth::user()->id)->where('activity_id','=','12')->first())

	        $activity = new UserActivity;
	        $activity->user_id = \Auth::user()->id;
	        $activity->activity_id = 12;
	        $activity_points = Activity::select('points')->where('id','12')->first();
	        $activity->points = $activity_points->points;
	        $activity->save();


	        if(!$activity = UserActivity::where('user_id',$id)->where('activity_id','=','11')->first())

	        $activity = new UserActivity;
	        $activity->user_id = \Auth::user()->id;
	        $activity->activity_id = 11;
	        $activity_points = Activity::select('points')->where('id','11')->first();
	        $activity->points = $activity_points->points;
	        $activity->save();

	     //user info table for followers

	     if(!$users_info = UsersInfo::where('user_id',$id)->first())
	     $users_info = new UsersInfo;
         $users_info->user_id = $id;
    	 $users_info->total_points = $users_info->total_points+1;
         $users_info->save();

	     //user info table for following

	     if(!$users_info = UsersInfo::where('user_id',\Auth::user()->id)->first())
	     $users_info = new UsersInfo;
         $users_info->user_id = \Auth::user()->id;
    	 $users_info->total_points = $users_info->total_points+1;
         $users_info->save();

    	}

	    return redirect()->back();
	}

	public function unfollowUser($id)
	{
		$users_follow = UsersFollow::where('followed_by',\Auth::user()->id)->where('follow_to',$id)->delete();


	    if(!$activity = UserActivity::where('user_id',\Auth::user()->id)->where('activity_id','=','13')->first())

	    	$activity = new UserActivity;
	        $activity->user_id = \Auth::user()->id;
	        $activity->activity_id = 13;
	        $activity_points = Activity::select('points')->where('id','13')->first();
	        $activity->points = $activity_points->points;
	        $activity->save();


	    if(!$activity = UserActivity::where('user_id',$id)->where('activity_id','=','14')->first())

	    	$activity = new UserActivity;
	        $activity->user_id = \Auth::user()->id;
	        $activity->activity_id = 14;
	        $activity_points = Activity::select('points')->where('id','14')->first();
	        $activity->points = $activity_points->points;
	        $activity->save();

	        //user info table for followers

	     if(!$users_info = UsersInfo::where('user_id',$id)->first())
	     $users_info = new UsersInfo;
         $users_info->user_id = $id;
    	 $users_info->total_points = $users_info->total_points-1;
         $users_info->save();


	     //user info table
	     if(!$users_info = UsersInfo::where('user_id',\Auth::user()->id)->first())
	     $users_info = new UsersInfo;
         $users_info->user_id = \Auth::user()->id;
    	 $users_info->total_points = $users_info->total_points-1;
         $users_info->save();


	    return redirect()->back();
	}


	public function pollsRespond(Request $request ,$id)
	{
		//dd($request);
		if(!$polls_respond = PollsRespond::where('user_id',\Auth::user()->id)->where('poll_id',$id)->first())

			$polls_respond = new PollsRespond;

        $output = "poll";

        $polls_respond->user_id = \Auth::user()->id;
        $polls_respond->poll_id = $id;
        $polls_respond->poll_option = $request->poll_option;
        //dd($polls_respond->poll_option);

        $polls_respond->save();

        $activity = new UserActivity;
        $activity->user_id = \Auth::user()->id;
        $activity->activity_id = 16;
        $activity_points = Activity::select('points')->where('id','16')->first();
        $activity->points = $activity_points->points;
        $activity->save();

	     //user info table for following

	     if(!$users_info = UsersInfo::where('user_id',\Auth::user()->id)->first())
	     $users_info = new UsersInfo;
         $users_info->user_id = \Auth::user()->id;
    	 $users_info->total_points = $users_info->total_points+1;
         $users_info->save();


        return redirect()->back()->with('output',$output);
	}

	public function saveReference(Request $request,$id)
	{
		$user = User::find($id);
	    $output = "reference";

        $user->reference_code = $request->reference_code;
        $reference_given_by = User::select('id')->where('referel_code',$user->reference_code)->first();
        $user->save();

        $activity = new UserActivity;
        $activity->user_id = $reference_given_by->id;
        $activity->activity_id = 18;
        $activity_points = Activity::select('points')->where('id','18')->first();
        $activity->points = $activity_points->points;
        $activity->save();

	    //user info table for following

	     if(!$users_info = UsersInfo::where('user_id',\Auth::user()->id)->first())
	     $users_info = new UsersInfo;
         $users_info->user_id = \Auth::user()->id;
    	 $users_info->total_points = $users_info->total_points+10;
         $users_info->save();

        return redirect()->back()->with('output',$output);
	}


	public function saveSubscribe(Request $request)
	{
		$v = \Validator::make($request->all(), [
	          'email' => 'required|unique:subscribe'
	      ]);

	      //dd($v);
	      if ($v->fails()) {
	            $output = "emailfail";
              return redirect()->back()->with('output',$output);
          }


		if(!$subscribe = Subscribe::where('user_id',\Auth::user()->id)->first())

		$subscribe = new Subscribe;
        $output = "subscribe";
        $subscribe->user_id = \Auth::user()->id;
        $subscribe->email = $request->email;
        $subscribe->save();


		if(!$activity = UserActivity::where('user_id',\Auth::user()->id)->where('activity_id','=','17')->first())

        $activity = new UserActivity;
        $activity->user_id =\Auth::user()->id;
        $activity->activity_id = 17;
        $activity_points = Activity::select('points')->where('id','17')->first();
        $activity->points = $activity_points->points;
        $activity->save();

	     //user info table for following

	     if(!$users_info = UsersInfo::where('user_id',\Auth::user()->id)->first())
	     $users_info = new UsersInfo;
         $users_info->user_id = \Auth::user()->id;
    	 $users_info->total_points = $users_info->total_points + $activity->points;
         $users_info->save();


        return redirect()->back()->with('output',$output);
	}

		public function getAboutUs()
		{
			$pageData = page::where('id', 68)-> first();
            return view('Frontend.about_us', ['pageData' => $pageData]);
			//return view('Frontend.about_us');
		}

		public function getContactUs()
		{
			$pageData = page::where('id', 69)-> first();
            return view('Frontend.contact_us', ['pageData' => $pageData]);
			//return view('Frontend.contact_us');
		}

		public function getPartner()
		{
			$pageData = page::where('id', 66)-> first();
            return view('Frontend.partner_with_us', ['pageData' => $pageData]);
			//return view('Frontend.partner_with_us');
		}

		public function getAdvertisement()
		{
			$pageData = page::where('id', 65)-> first();
            return view('Frontend.advertisement_with_us', ['pageData' => $pageData]);
			//return view('Frontend.advertisement_with_us');
		}

		public function exportCsv(Request $request){

		$file =$request->file('file');
		$filename = $file->getClientOriginalName();
		$path = $file->getPathName(); //here pass actual path of the file sothat excel class can read the file
	//  Log::info("csv file:".$filename);
		$nameonly=preg_replace('/\..+$/', '', $file->getClientOriginalName());   //this will return name without extension

		 $results = Excel::load($path,function($reader){
		 })->get();

	  Log::info("csv file ids:".$results);


			return 'true';


		}

}
