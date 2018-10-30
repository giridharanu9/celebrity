<!DOCTYPE html>
<html>
<head>
	<title></title>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  <link rel="stylesheet" href="{{url('assets/notificationToast/css/jquery.toastmessage.css')}}">
	 	<script type="text/javascript" src="{{url('assets/notificationToast/jquery.toastmessage.js')}}"></script>
	 	<!-- CSS and JS for autocomplete added by synergy -->
		@include('files.files')
		<!--  CSS and JS for autocomplete added by synergy-->

	<style>
	.search-result{
		background: #f1f1f1;
    padding: 25px 15px 15px 15px;
    margin: 22px 0px;
    max-height: 835px;
    overflow-y: scroll;
	}
	</style>


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
							<a href="{{ url('/user/'.Auth::user()->id) }}" class="btn btn-default">Your Profile</a>
            @endguest
				</div>
			</div>
		</div><br>

	<!-- @include('includes.search')
  <div class="row">
		<div class="col-xs-12">
				@if(count($celebrity) == 0)
					<div align="center">
						<h4>No Details found. Try to search again !</h4>
					</div>
				@endif
				@foreach($celebrity as $celeb)
				<div class="col-md-2">
					<div class="panel" style="border:1px solid black; height: 250px;">
	       		<div class="panel-body text-center">
	             <a href="{{url('view_celebrity/'.$celeb->id)}}"><p><img class="img-fluid" src="{{url('/public/uploads/celebrity/'.$celeb->id.'/'.$celeb->image)}}" alt="card image" height="150px" width="100%"></p>
	              <h4 class="panel-title"  style="color: black;">{{$celeb->name}}</h4><br> </a>
	              <a href=""><i class="fa fa-thumbs-down"></i></a> 2k
	              <a href=""><i class="fa fa-thumbs-up"></i></a> 200
	        	</div>
	        </div>
			  </div>
				@endforeach
    </div>
 </div> -->


   <div class="row">
		 <div class="col-md-3">
			 <h4>Search Over Here</h4>
		 			<form  role="form" method="get" action="{{url('celebrity/search')}}">
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
		 				<div class="row advance-search" style="margin-top:30px;display:none;">

							<div class="col-md-6">
								<div class="form-group">
									<select class="form-control search-panel" name="activity">
										<option value="{{NULL}}">Sort By</option>
										<option value="like">Likes</option>
										<option value="dislike">Dislikes</option>
										<option value="follow">Followers</option>
									</select>
								</div>
							</div>

		 					<div class="col-md-6">
		 						<div class="form-group">
		 							<select class="form-control search-panel" name="categoryid">
		 								<option value="{{NULL}}">Category</option>
		 								<?php $categories = App\Category::get(); ?>
		 								@foreach($categories as $category)
		 								<option value="{{$category->id}}">{{$category->categorytitle}}</option>
		 								@endforeach
		 							</select>
		 						</div>
		 					</div>

		 					<div class="col-md-6">
		 						<div class="form-group">
		 							<select class="form-control search-panel" name="gender">
		 								<option value="{{NULL}}">Gender</option>
		 								<option value="Male">Male</option>
		 								<option value="Female">Female</option>
		 								<option value="Others">Others</option>
		 							</select>
		 						</div>
		 					</div>
		 					<div class="col-md-6">
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
		 			</form>
				 </div>

			 <div class="col-md-9">
				 <div class="search-result">
				 <div class="row">
				  	<div class="col-xs-12">
							@if(count($celebrity) == 0)
								<div align="center">
									<h4>No Details found. Try to search again !</h4>
								</div>
							@endif
							@foreach($celebrity as $celeb)
							<div class="col-md-4">
								<div class="panel" style="border:1px solid black; height: 250px;">
									<div class="panel-body text-center">
										 <a href="{{url('view_celebrity/'.$celeb->id)}}"><p><img class="img-fluid" src="{{url('/public/uploads/celebrity/'.$celeb->id.'/'.$celeb->image)}}" alt="card image" height="150px" width="100%"></p>
											<h4 class="panel-title"  style="color: black;">{{$celeb->name}}</h4><br> </a>
											<a href=""><i class="fa fa-thumbs-down"></i></a> 2k
											<a href=""><i class="fa fa-thumbs-up"></i></a> 200
									</div>
								</div>
							</div>
							@endforeach
					 </div>
			  	</div>
		  	</div>
      </div>
	  </div>
</div>
	<br><br><br><br><br><br><br>

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
				<li><a href="{{url('advertisement_with_us')}}">ADVERTISEMNET WITH US</a></li>
				<li><a href="{{url('partner_with_us')}}">PARTNER WITH US</a></li>
				<li><a href="{{url('about_us')}}"> SOCIAL MEDIA </a></li>
				<li><a href="{{url('about_us')}}"> ABOUT US </a></li>
				<li><a href="{{url('contact_us')}}"> CONTACT US </a></li>
			</ul>
		</div>
	</div>

<!-- script for autocomplete added by synergy -->
	@include('script.script')
<!-- script for autocomplete added by synergy-->
</body>
</html>
