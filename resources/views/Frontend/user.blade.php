<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="{{url('assets/notificationToast/css/jquery.toastmessage.css')}}">
	<script type="text/javascript" src="{{url('assets/notificationToast/jquery.toastmessage.js')}}"></script>

	<script src="http://connect.facebook.net/en_US/all.js"></script>
	<script>
	FB.init({
	appId:'153586761739300',
	cookie:true,
	status:true,
	xfbml:true
	});

	function FacebookInviteFriends()
	{
	FB.ui({
	method: 'apprequests',
	message: 'Your Message diaolog'
	});
	}

	</script>
	
</head>
<body>
@include('notification.notify')
<div class="container" style="width: 1500px;">
	<div class="row">
			<div class="col-md-12">
				<div class="col-md-6"><br>
					<a href="{{url('/')}}"><img src="{{url('assets/2.png')}}" height="100px" width="200px"></a>
				</div>
				<div class="col-md-6" align="right"><br>
					
					 @guest
                            <a href="{{ route('login') }}"  class="btn btn-default">Login</a>
                            <a href="{{ route('register') }}"  class="btn btn-default">Register</a>
                        @else
					<a href="{{ url('/logout') }}" class="btn btn-default">Logout</a>
                          
					<a href="{{ url('user_profile/'.Auth::user()->id) }}" class="btn btn-default">Complete Your  Profile</a>

                        @endguest
				</div>
			</div>
		</div><br>

		<div class="row" align="center">
        <div class="col-md-8 col-md-push-2">
    		<h4>Search Over Here</h4>
                <form  role="form" method="get" action="{{url('celebrity/search')}}">
		                	<div class="row">
		                		<div class="col-md-2">
		                			<div class="form-group">
				                    	<select class="form-control search-panel" name="activity">
					                    	<option value="{{NULL}}">Sort By</option>
					                    	<option value="like">Likes</option>
					                    	<option value="dislike">Dislikes</option>
					                    	<option value="follow">Followers</option>
					                    </select>
						             </div>
		                		</div>

		                		<div class="col-md-2">
		                			<div class="form-group">
				                    	<select class="form-control search-panel" name="categoryid">
					                    	<option value="{{NULL}}">Category</option>
				                    		@foreach($categories as $category)
					                    	<option value="{{$category->id}}">{{$category->categorytitle}}</option>
					                    	@endforeach
					                    </select>
						             </div>
		                		</div>

		                		<div class="col-md-2">
		                			<div class="form-group">
				                    	<select class="form-control search-panel" name="gender">
					                    	<option value="{{NULL}}">Gender</option>
					                    	<option value="Male">Male</option>
					                    	<option value="Female">Female</option>
					                    	<option value="Others">Others</option>
					                    </select>
						             </div>
		                		</div>

		                		<div class="col-md-2">
		                			<div class="form-group">
				                    	<select class="form-control search-panel" name="age">
					                    	<option value="{{NULL}}">Age</option>
					                    	<option value="20"> >=20 </option>
					                    	<option value="30"> >=30 </option>
					                    	<option value="40"> >=40 </option>
					                    	<option value="50"> >=50 </option>
					                    	<option value="60"> >=60 </option>
					                    	<option value="70"> >=70 </option>
					                    	<option value="80"> >=80 </option>
					                    	<option value="90"> >=90 </option>
					                    </select>
						             </div>
		                		</div>
		                	</div>

		            <div id="custom-search-input">
		                <div class="input-group col-md-12">
		                    <input type="text" name="name" id="search" value="{{isset($searchText->name) ? $searchText->name : null}}" class="form-control input-lg" placeholder="Search" />
		                    <span class="input-group-btn">
		                        <button class="btn btn-info btn-lg" type="submit">
		                            <i class="glyphicon glyphicon-search"></i>
		                        </button>
		                    </span>
		                </div>
		            </div>
		        </form>
        </div>
	</div><br><br><br>


	<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-3">
				<h3> {{Auth::user()->name}} </h3><br>
				<div class="panel" style="border:1px solid black;width: 350px;">
		       		<div class="panel-body text-center">
		       			@if($users_info && $users_info->id)
		               <img src="{{url('/'.$users_info->profile ?? null)}}" alt="img not found" width="100%">
		               @else
		               <h5>Please Complete Your Profile To Let People Know More About You And To Get Followed By People And Follow People.</h5>
		               @endif
		           	</div>
	       		</div>
	       		<div class="row">
					<div class="col-md-8">
						@guest
						<a href="" class="btn-sm btn-primary">Follow</a>
						@endguest
						
		       			<b>Followers </b>@if($users_info && $users_info->id) {{\App\UsersInfo::getFollowersCount($users_info->user_id)}}
		       			@endif
		       			<b>Following </b>@if($users_info && $users_info->id)  {{\App\UsersInfo::getUnFollowingCount($users_info->user_id)}} @endif
	       			</div>
	       		</div><br>

		       	@if($users_info && $users_info->id)

	       		<?php if($users_info->profile)
	       		$users_info->profile = 20;
	       		else
	       		$users_info->profile = 0;

	       		if($users_info->mobile)
	       		$users_info->mobile = 20;
	       		else
	       		$users_info->mobile = 0;

	       		if($users_info->city)
	       		$users_info->city = 20;
	       		else
	       		$users_info->city = 0;

	       		if($users_info->pin_code)
	       		$users_info->pin_code = 20;
	       		else
	       		$users_info->pin_code = 0;

	       		if($users_info->date_of_birth)
	       		$users_info->date_of_birth = 20;
	       		else
	       		$users_info->date_of_birth = 0;

	       		$total = $users_info->profile+$users_info->mobile+$users_info->city+$users_info->pin_code+$users_info->date_of_birth;
	       		 ?>
	       		<h4>Profile Completion : {{$total}} %</h4>
	       		@else

	       		<h4>Profile Completion : 0 %</h4>

		        @endif
	       		
   			</div>
   			<div class="col-md-3">
				<h4><br>Your Favorites<br><br></h4>
					@foreach($favorites as $fav)
					<div class="col-md-4">
						<img src="{{url('/public/uploads/celebrity/'.$fav->getCelebrity->id.'/'.$fav->getCelebrity->image ?? '')}}" width="100px" height="100px" style="margin:5px; margin-left: 2px;">
					</div>
					@endforeach
   			</div>

   			<div class="col-md-3">
				<h4><br>Your Followings <br><br></h4>
					@foreach($users_following as $follow)
					<div class="col-md-4">
					<img src="{{url('/'.$follow->getFollowing->profile ?? null)}}" alt="img not found" width="100%">
					</div>
					@endforeach
   			</div>

   			<div class="col-md-3">
				<h4><br>Your Followers <br><br></h4>
					@foreach($users_followers as $follow)
					<div class="col-md-4">
					<img src="{{url('/'.$follow->getFollowers->profile ?? null)}}" alt="img not found" width="100%">
					</div>
					@endforeach
   			</div>
   			


   		</div>
   		<div class="row">
			<div class="col-md-4">
				<h3> Referrals </h3><br>
				<a href="#" class="btn-sm btn-primary" onclick="FacebookInviteFriends();">Invite Your Friends</a>
				<a href="" class="btn-sm btn-success">Invite Gmail Contact</a>
				<h4><br>Your Unique Referel Code </h4>{{$users->referel_code}}
				<h4><br>Registration Reference Number </h4>
				@if($users->reference_code)
				{{$users->reference_code}}
				@else
				<h5>Please Enter Your Reference Number</h5>
				@endif
   			</div>

   		<div class="col-md-3 col-md-push-1">
			<h4>How To Gain Points. ?</h4>
			<li>Daily Login streaks</li>
			<li>Writing a blog post</li>
			<li>Adding new Celebrities</li>
			<li>Adding Blog Post</li>
			<li>Creating Poll</li>
			<li>Participating in Polls</li>
			<li>Creating a Quiz</li>
			<li>Answering Quiz</li>
			<li>Submitting new celebs</li>
			<li>Voting for Celebrity</li>
			<li>Rating celebrities</li>
			<li>Celebrity Follows</li>
			<li>Commenting</li>
			<li>Reporting a bug</li>
			<li>Submitting a tip/idea</li>
			<li>Subscribing to newsletter</li>
			<li>Sharing on Social Media</li>
		</div>
   		</div>
 
   	</div>

   	<div class="col-md-2"><br>
	</div>
</div>
   </div>

</div>


	<br><br><br>

	<div class="footer col-xs-12" align="center" style="background-color: #3575d3;" >
		@guest
		@else
		<?php $subscribe = App\Subscribe::where('user_id',Auth::user()->id)->first(); ?>
		@if($subscribe)
		<li><h4 style="color: white;"><br> Thank You For Subscribing... <br><br></h4></li>
		@else
		<div class="col-md-4 col-md-push-1">
			<ul class="nav navbar-nav">
				<li><h4 style="color: white;"><br> Subscribe To Get More Information About Us </h4></li>
			</ul>
		</div>
		<div class="col-md-6">
			<ul class="nav navbar-nav">
				<form method="post" action="{{url('save_subscribe')}}">
					<li><br>
						<input type="email" name="email" required="required" placeholder="Enter Your Email Id" style="width: 250px;">&emsp;&emsp;
						<button type="submit" class="btn btn-success">Subscribe Now</button><br><br>
					</li>
				</form>
			</ul>
		</div>
		@endif
		@endif
	</div>

	
	<div class="footer col-xs-12" align="center" style="background-color: #1b3b4b;" >
		<div class="col-md-8 col-md-push-3">
			<ul class="nav navbar-nav">
				<li><a href="{{url('home')}}">HOME</a></li>
				<li><a href="{{url('home')}}">ADVERTISEMNET WITH US</a></li>
				<li><a href="{{url('home')}}">PARTNER WITH US</a></li>
				<li><a href="{{url('about_us')}}"> SOCIAL MEDIA </a></li>
				<li><a href="{{url('about_us')}}"> ABOUT US </a></li>
				<li><a href="{{url('contact_us')}}"> CONTACT US </a></li>
			</ul>
		</div>
	</div>
</body>
</html>

