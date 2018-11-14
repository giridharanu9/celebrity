<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Celebrity;
use App\Category;
use App\User;
use App\UsersInfo;
use App\Favorites;
use App\Likes;
use App\Follow;
use App\RatingQuestion;
use App\Ratings;
use App\UserActivity;
use App\Activity;
use App\Poll;
use App\PollOptions;
use App\UsersFollow;
use App\CelebActivity;
use Illuminate\Mail\Mailer;
use Mail;
class FrontEndController extends Controller
{
	public function home()
	{
		$celebrity = Celebrity::get();
		$categories = Category::get();
		$likes = Likes::get();
		return view('Frontend.home',compact('celebrity','likes','categories'));
	}

	public function viewCelebrity($id)
	{
		$celebrity = Celebrity::find($id);
		// $like = Likes::where('celebrity_id',$id)->where('user_id',\Auth::user()->id)->first();
		// $follow = Follow::where('celebrity_id',$id)->where('user_id',\Auth::user()->id)->first();
		// $favorites = Favorites::where('celebrity_id',$id)->where('user_id',\Auth::user()->id)->first();
       // dd($celebrity);
       // echo "<pre>";
        //print_r($celebrity->comments);

		$like = Likes::where('celebrity_id',$id)->first();
		$categories = Category::get();
		$follow = Follow::where('celebrity_id',$id)->first();
		$favorites = Favorites::where('celebrity_id',$id)->first();
		$category_name = $celebrity->getCategory->categorytitle;
		$questions = RatingQuestion::where('category',$category_name)->get();
		$polls = Poll::orderBy('created_at','desc')->where('isactive','1')->get()->take('3');

		return view('Frontend.view_celebrity',compact('celebrity','favorites','like','follow','questions','polls','categories'));
	}

	public function user($id)
	{
		$users = User::find($id);
		$users_info = UsersInfo::where('user_id',$id)->first();
		$users_following = UsersFollow::where('followed_by',$id)->get();
		$users_followers = UsersFollow::where('followed_by','!=',$id)->where('follow_to',$id)->get();
		$favorites = Favorites::where('user_id',$id)->where('favorite',1)->get();

		$categories = Category::get();
		$celebrities = Celebrity::where('categoryid','=','1')->get();
		return view('Frontend.user',compact('users','users_info','celebrities','favorites','users_following','users_followers','categories'));
	}

	public function saveUser(Request $request)
	{
        //user info table
		if(isset($request->id))
        {
            $users = UsersInfo::find($request->id);
            $output = "update";
        }
        else
        {
		$users = new UsersInfo;
    	}
        $users->fill($request->all());

        
        $file = $request->profile;
        if($file)
        {
          $filename = time() . '.' . $file->getClientOriginalExtension();
          $file->move('images/' , $filename);
          $users->profile = 'images/'. $filename;
        }
        $output = "success";

        $users->save();

        //user activity table

        if(!$activity = UserActivity::where('user_id',\Auth::user()->id)->where('activity_id','=','4')->first())

        $activity = new UserActivity;
        $activity->user_id = \Auth::user()->id;
        $activity->activity_id = 4;
        $activity_points = Activity::select('points')->where('id','4')->first();
        $activity->points = $activity_points->points;
        $activity->save();

	    return redirect()->back()->with('output',$output);
		
	}

	public function userProfile($id)
	{
		$users_info = UsersInfo::where('user_id',$id)->first();
		$users = User::where('id',$id)->first();
		$celebrities = Celebrity::where('categoryid','=','1')->get();
		$categories = Category::get();
		//dd($users_info);

		return view('Frontend.user_profile',compact('users_info','celebrities','users','categories'));
	}

	public function searchCelebrity(Request $request)
    {
    	//dd($request->age);
        $searchText = $request;
        $celebrity =Celebrity::where('name','LIKE','%'.$request->name.'%');

    	if($request->categoryid) 
   			$celebrity->where('categoryid',$request->categoryid);
    	if($request->gender) 
       		$celebrity->where('gender',$request->gender);
       	if($request->age) 
       		$celebrity->where('age','>',$request->age);
		if($request->activity == 'like')
       		$celebrity->orderBy('like_count','desc');
       	if($request->activity == 'dislike')
       		$celebrity->orderBy('like_count','asc');
       	if($request->activity == 'follow')
       		$celebrity->orderBy('follow_count','desc');


       	$celebrity = $celebrity->get();
        return view('Frontend.view_search',compact('celebrity'))->withDetails($celebrity)->withQuery ( $searchText );
       		    
	}

    public function autoSearchCelebrity(Request $request)
    {
       // dd($request->term);
        $searchText = $request;
        $celebrities =Celebrity::where('name','LIKE','%'.$request->term.'%')->get();;

        if($request->categoryid) 
            $celebrity->where('categoryid',$request->categoryid);
        if($request->gender) 
            $celebrity->where('gender',$request->gender);
        if($request->age) 
            $celebrity->where('age','<',$request->age);
        if($request->activity == 'like')
            $celebrity->orderBy('like_count','desc');
        if($request->activity == 'dislike')
            $celebrity->orderBy('like_count','asc');
        if($request->activity == 'follow')
            $celebrity->orderBy('follow_count','desc');

        $data=array();
        foreach ($celebrities as $celebrity) {
                $data[]=array('value'=>$celebrity->name,'id'=>$celebrity->id);
        }
        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>''];

        //$celebrity = $celebrity->get();
        //return view('Frontend.view_search',compact('celebrity'))->withDetails($celebrity)->withQuery ( $searchText );
                
    }

    public function refreshCaptcha()
    {
       // die;
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function sendFeedback(Request $request)
    {
        $request->validate([
            'feedback' => 'required',
           'captcha' => 'required|captcha'
        ]);
        //echo "suceeess";
        //return response()->json(['captcha'=> captcha_img()]);
        $feedback = $request->input('feedback');
        Mail::send('emails.welcome', ['feedback' => $feedback], function($message)
        {
            $message->to('ashishk.synergytop@gmail.com', 'ashish')->subject('Welcome!');
        });
        $output = "Feedback sent succesfully";
        return redirect()->back()->with('output',$output);
    }

	public function addFavorite($id)
	{
		if(!$favorites = Favorites::where('user_id',\Auth::user()->id)->where('celebrity_id',$id)->first())
			$favorites = new Favorites;

        $output = "favorite";

        $favorites->user_id = \Auth::user()->id;
        $favorites->celebrity_id = $id;
        $favorites->favorite = 1;

        $favorites->save();

	    return redirect()->back()->with('output',$output);
	}

	public function removeFavorite($id)
	{
		$favorites = Favorites::where('user_id',\Auth::user()->id)->where('celebrity_id',$id)->delete();
        $output = "unfavorite";

	    return redirect()->back()->with('output',$output);
	}

	public function celebLike($id)
	{
		//likes table
		if(!$likes = Likes::where('user_id',\Auth::user()->id)->where('celebrity_id',$id)->first())
			$likes = new Likes;

        $output = "like";

        $likes->user_id = \Auth::user()->id;
        $likes->celebrity_id = $id;
        $likes->likes = 1;

        $likes->save();

        //celebactivity table

       if(!$celebrity_activity = CelebActivity::where('celebrity_id',$id)->where('user_id',\Auth::user()->id)->first())
       	$celebrity_activity = new CelebActivity;
        $celebrity_activity->total_likes = 1;
        $celebrity_activity->user_id = \Auth::user()->id;
        $celebrity_activity->celebrity_id = $id;

        $celebrity_activity->save();

        //celebrity table


        if(!$celebrity = Celebrity::where('id',$id)->first())
        $celebrity = new Celebrity;
        $celebrity->like_count = $celebrity->like_count +1;

        $celebrity->save();

	    return redirect()->back()->with('output',$output);
	}

	public function celebDislike($id)
	{
        //likes table
		if(!$likes = Likes::where('user_id',\Auth::user()->id)->where('celebrity_id',$id)->first())
			$likes = new Likes;
		
        $output = "unlike";

        $likes->user_id = \Auth::user()->id;
        $likes->celebrity_id = $id;
        $likes->likes = 0;

        $likes->save();

        //celebrity activity table

       if(!$celebrity_activity = CelebActivity::where('celebrity_id',$id)->where('user_id',\Auth::user()->id)->first()) 
        $celebrity_activity = new CelebActivity;
        $celebrity_activity->total_likes =  0;
        $celebrity_activity->user_id = \Auth::user()->id;
        $celebrity_activity->celebrity_id = $id;

        $celebrity_activity->save();

        //celebrity table

        if(!$celebrity = Celebrity::where('id',$id)->first())
        $celebrity = new Celebrity;
        $celebrity->like_count = $celebrity->like_count -1;

        $celebrity->save();

	    return redirect()->back()->with('output',$output);
		
	}

	public function celebFollow($id)
	{
		//follow table
		if(!$follow = Follow::where('user_id',\Auth::user()->id)->where('celebrity_id',$id)->where('follow',1)->first())
		
		$follow = new Follow;
	

        $output = "follow";

        $follow->user_id = \Auth::user()->id;
        $follow->celebrity_id = $id;
        $follow->follow = 1;

        $follow->save();

        //user activity table

        if(!$activity = UserActivity::where('user_id',\Auth::user()->id)->where('activity_id','=','2')->where('celebrity_id',$id)->first())

        $activity = new UserActivity;
        $activity->user_id = \Auth::user()->id;
        $activity->activity_id = 2;
        $activity_points = Activity::select('points')->where('id','2')->first();
        $activity->points = $activity_points->points;
        $activity->save();

        //user info table

	     if(!$users_info = UsersInfo::where('user_id',\Auth::user()->id)->first())
	     $users_info = new UsersInfo;

         $users_info->user_id = \Auth::user()->id;
    	 $users_info->total_points = $users_info->total_points+10;
         $users_info->save();

         //celeb activity table

    	if(!$celebrity_activity = CelebActivity::where('celebrity_id',$id)->where('user_id',\Auth::user()->id)->first())
        $celebrity_activity = new CelebActivity;
        $celebrity_activity->total_followers = 1;
        $celebrity_activity->user_id = \Auth::user()->id;
        $celebrity_activity->celebrity_id = $id;
        $celebrity_activity->save();

        //celebrity table

        if(!$celebrity = Celebrity::where('id',$id)->first())
        $celebrity = new Celebrity;
        $celebrity->follow_count = $celebrity->follow_count +1;
        $celebrity->save();

	    return redirect()->back()->with('output',$output);
	}

	public function celebUnfollow($id)
	{
		Follow::where('user_id',\Auth::user()->id)->where('celebrity_id',$id)->delete();
		//user activity table

        if(!$activity = UserActivity::where('user_id',\Auth::user()->id)->where('activity_id','=','3')->where('celebrity_id',$id)->first())

        $activity = new UserActivity;
        $activity->user_id = \Auth::user()->id;
        $activity->activity_id = 3;
        $activity_points = Activity::select('points')->where('id','3')->first();
        $activity->points = $activity_points->points;
        //dd($activity->points);
        $activity->save();
        	
        //celeb activity table

        if(!$celebrity_activity = CelebActivity::where('celebrity_id',$id)->where('user_id',\Auth::user()->id)->first())
        $celebrity_activity = new CelebActivity;
        $celebrity_activity->total_followers = 0;
        $celebrity_activity->user_id = \Auth::user()->id;
        $celebrity_activity->celebrity_id = $id;

        $celebrity_activity->save();

        //celebrity table

        if(!$celebrity = Celebrity::where('id',$id)->first())
        $celebrity = new Celebrity;
        $celebrity->follow_count = $celebrity->follow_count -1;

        $celebrity->save();

        //userinfo table

        if(!$users_info = UsersInfo::where('user_id',\Auth::user()->id)->first())
        	$users_info = new UsersInfo;

    	$users_info->total_points = $users_info->total_points + $activity_points->points;
        $users_info->save();


	    return redirect()->back();
	}


	public function inviteFriends($id)
	{
		if(!$activity = UserActivity::where('user_id',\Auth::user()->id)->where('activity_id','=','1')->first())
        	$activity = new UserActivity;
       

        $output = "success";

		$activity->user_id = \Auth::user()->id;
        $activity->activity_id = 1;
        $activity->points = $activity->getActivity->points;

        $activity->save();

        if(!$users_info = UsersInfo::where('user_id',\Auth::user()->id)->first())
        if(!$activity = UserActivity::where('user_id',\Auth::user()->id)->where('activity_id','=','1')->first())
        	$users_info = new UsersInfo;


        $output = "success";

    	$users_info->total_points = $users_info->total_points+10;

        $users_info->save();  

	    return redirect()->back()->with('output',$output);
	}


	public function CelebrityQuestion(Request $request)
	{
		$questions = new RatingQuestion;
        $output = "success";

        $questions->skill = $request->skill;
        $questions->category = $request->category;
		//dd($questions->category);
        $questions->save();

	    return redirect()->back()->with('output',$output);
		
	}

	public function rating_old(Request $request,$id)
	{
      
		//rating table entry
		if(!$ratings = Ratings::where('user_id',\Auth::user()->id)->where('celebrity_id',$id)->where('question_id',$request->question_id)->first()){
            $ratings = new Ratings;

            $users_info = UsersInfo::where('user_id',\Auth::user()->id)->first();
            $users_info->total_points = $users_info->total_points+1;
            $users_info->save();
        }

        
        $output = "rate";

        $ratings->user_id = \Auth::user()->id;
        $ratings->ratings = \Input::get('rating'.$request->question_id);
        // dd('rating'.$request->question_id);
        $ratings->celebrity_id = $id;
        $ratings->question_id = $request->question_id;

        $ratings->save();

        //user activity table entry

        $activity = new UserActivity;
        $activity->user_id = \Auth::user()->id;
        $activity->activity_id = 15;
        $activity_points = Activity::select('points')->where('id','15')->first();
        $activity->points = $activity_points->points;
        $activity->save();

	    return redirect()->back()->with('output',$output);
		
	}

    public function rating(Request $request,$id)
        {
           // print_r($request->Input('question_id'));
           // dd($request->all());
           foreach ($request->Input('question_id') as $question_id) {
            //echo $question_id;die;
                //rating table entry
                if(!$ratings = Ratings::where('user_id',\Auth::user()->id)->where('celebrity_id',$id)->where('question_id',$question_id)->first()){
                    $ratings = new Ratings;

                    $users_info = UsersInfo::where('user_id',\Auth::user()->id)->first();
                    $users_info->total_points = $users_info->total_points+1;
                    $users_info->save();
                }

                $output = "rate";

                $ratings->user_id = \Auth::user()->id;
                $ratings->ratings = \Input::get('rating'.$question_id);
                // dd('rating'.$request->question_id);
                $ratings->celebrity_id = $id;
                $ratings->question_id = $question_id;

                $ratings->save();

                //user activity table entry

                $activity = new UserActivity;
                $activity->user_id = \Auth::user()->id;
                $activity->activity_id = 15;
                $activity_points = Activity::select('points')->where('id','15')->first();
                $activity->points = $activity_points->points;
                $activity->save();

               
            }
             return redirect()->back()->with('output',$output);
    }
}