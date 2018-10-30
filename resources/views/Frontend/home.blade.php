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
	<!-- CSS and JS for autocomplete added by synergy -->
	@include('files.files')
	<!--  CSS and JS for autocomplete added by synergy-->
	<script type="text/javascript" src="{{url('assets/notificationToast/jquery.toastmessage.js')}}"></script></head>
<body>
@include('notification.notify')
	<?php $celebrity = App\Celebrity::get(); 
	$categories = App\Category::get();?>
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

					<a href="{{url('all_users')}}" class="btn btn-default">Users</a>

                        @endguest
				</div>
			</div>
		</div><br>

	@include('includes.search')

		
		<div class="row">
			<div class="col-xs-12">
				<div  style="padding-left: 12px;">
					<a href="{{url('/')}}" class="btn btn-default">ALL</a>
					<a href="{{url('actors')}}" class="btn btn-default">ACTORS</a>
					<a href="{{url('actress')}}" class="btn btn-default">ACTRESS</a>
					<a href="{{url('singers')}}" class="btn btn-default">SINGERS</a>
					<a href="{{url('artists')}}" class="btn btn-default">ARTIST</a>
					<a href="{{url('politicians')}}" class="btn btn-default">POLITICIAN</a>
					<a href="{{url('sports')}}" class="btn btn-default">SPORTS</a>
					<a href="{{url('music')}}" class="btn btn-default">MUSIC</a>
					<a href="{{url('movies')}}" class="btn btn-default">MOVIES</a>
				</div><br><br>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-6">
				<div class="row">
					<div class="col-xs-6">
						ACTRESS  &emsp; <a href="{{url('actress')}}">VIEW ALL</a>
					</div>
				</div><br>
				@foreach($celebrity->where('categoryid',6)->take('4') as $celeb)
					<div class="col-md-3">
						<div class="panel" style="border:1px solid black; height: 250px;">
		               		<div class="panel-body text-center">
			                   <a href="{{url('view_celebrity/'.$celeb->id)}}"><p><img class="img-fluid" src="{{url('/public/uploads/celebrity/'.$celeb->id.'/'.$celeb->image)}}" alt="card image" height="150px" width="100%"></p>
			                    <h4 class="panel-title"  style="color: black;">{{$celeb->name}}</h4><br> </a> 
							  	<?php $like = App\Likes::where('likes','1')->where('celebrity_id',$celeb->id)->count(); ?>
							  	<?php $unlike = App\Likes::where('likes','0')->where('celebrity_id',$celeb->id)->count(); ?>
							  	<a href="{{url('celeb_like/'.$celeb->id)}}"><i class="fa fa-thumbs-up"></i></a> {{$like}}
			                    <a href="{{url('celeb_dislike/'.$celeb->id)}}"><i class="fa fa-thumbs-down"></i></a> {{$unlike}}
		                	</div>
		            	</div>
					</div>
				@endforeach
			</div>

			<div class="col-xs-6">
				<div class="row">
					<div class="col-xs-6">
						ACTORS  &emsp; <a href="{{url('actors')}}">VIEW ALL</a>
					</div>
				</div><br>
				@foreach($celebrity->where('categoryid',3)->take('4') as $celeb)
					<div class="col-md-3">
						<div class="panel" style="border:1px solid black; height: 250px;">
		               		<div class="panel-body text-center">
			                   <a href="{{url('view_celebrity/'.$celeb->id)}}"><p><img class="img-fluid" src="{{url('/public/uploads/celebrity/'.$celeb->id.'/'.$celeb->image)}}" alt="card image" height="150px" width="100%"></p>
			                    <h4 class="panel-title"  style="color: black;">{{$celeb->name}}</h4><br> </a> 
							  	<?php $like = App\Likes::where('likes','1')->where('celebrity_id',$celeb->id)->count(); ?>
							  	<?php $unlike = App\Likes::where('likes','0')->where('celebrity_id',$celeb->id)->count(); ?>
							  	<a href="{{url('celeb_like/'.$celeb->id)}}"><i class="fa fa-thumbs-up"></i></a> {{$like}}
			                    <a href="{{url('celeb_dislike/'.$celeb->id)}}"><i class="fa fa-thumbs-down"></i></a> {{$unlike}}
		                	</div>
		            	</div>
					</div>
				@endforeach
			</div>
		</div>


		<div class="row">
			<div class="col-xs-6">
				<div class="row">
					<div class="col-xs-6">
						SINGERS  &emsp; <a href="{{url('singers')}}">VIEW ALL</a>
					</div>
				</div><br>
				@foreach($celebrity->where('categoryid',5)->take('4') as $celeb)
					<div class="col-md-3">
						<div class="panel" style="border:1px solid black; height: 250px;">
		               		<div class="panel-body text-center">
			                   <a href="{{url('view_celebrity/'.$celeb->id)}}"><p><img class="img-fluid" src="{{url('/public/uploads/celebrity/'.$celeb->id.'/'.$celeb->image)}}" alt="card image" height="150px" width="100%"></p>
			                    <h4 class="panel-title"  style="color: black;">{{$celeb->name}}</h4><br> </a> 
							  	<?php $like = App\Likes::where('likes','1')->where('celebrity_id',$celeb->id)->count(); ?>
							  	<?php $unlike = App\Likes::where('likes','0')->where('celebrity_id',$celeb->id)->count(); ?>
							  	<a href="{{url('celeb_like/'.$celeb->id)}}"><i class="fa fa-thumbs-up"></i></a> {{$like}}
			                    <a href="{{url('celeb_dislike/'.$celeb->id)}}"><i class="fa fa-thumbs-down"></i></a> {{$unlike}}
		                	</div>
		            	</div>
					</div>
				@endforeach
			</div>

			<div class="col-xs-6">
				<div class="row">
					<div class="col-xs-6">
						SPORTS  &emsp; <a href="{{url('sports')}}">VIEW ALL</a>
					</div>
				</div><br>
				@foreach($celebrity->where('categoryid',2)->take('4') as $celeb)
					<div class="col-md-3">
						<div class="panel" style="border:1px solid black; height: 250px;">
		               		<div class="panel-body text-center">
			                   <a href="{{url('view_celebrity/'.$celeb->id)}}"><p><img class="img-fluid" src="{{url('/public/uploads/celebrity/'.$celeb->id.'/'.$celeb->image)}}" alt="card image" height="150px" width="100%"></p>
			                    <h4 class="panel-title"  style="color: black;">{{$celeb->name}}</h4><br> </a> 
							  	<?php $like = App\Likes::where('likes','1')->where('celebrity_id',$celeb->id)->count(); ?>
							  	<?php $unlike = App\Likes::where('likes','0')->where('celebrity_id',$celeb->id)->count(); ?>
							  	<a href="{{url('celeb_like/'.$celeb->id)}}"><i class="fa fa-thumbs-up"></i></a> {{$like}}
			                    <a href="{{url('celeb_dislike/'.$celeb->id)}}"><i class="fa fa-thumbs-down"></i></a> {{$unlike}}
		                	</div>
		            	</div>
					</div>
				@endforeach
			</div>
		</div>


		<div class="row">
			<div class="col-xs-6">
				<div class="row">
					<div class="col-xs-6">
						ARTIST  &emsp; <a href="{{url('artists')}}">VIEW ALL</a>
					</div>
				</div><br>
				@foreach($celebrity->where('categoryid',1)->take('4') as $celeb)
					<div class="col-md-3">
						<div class="panel" style="border:1px solid black; height: 250px;">
		               		<div class="panel-body text-center">
			                   <a href="{{url('view_celebrity/'.$celeb->id)}}"><p><img class="img-fluid" src="{{url('/public/uploads/celebrity/'.$celeb->id.'/'.$celeb->image)}}" alt="card image" height="150px" width="100%"></p>
			                    <h4 class="panel-title"  style="color: black;">{{$celeb->name}}</h4><br> </a> 
							  	<?php $like = App\Likes::where('likes','1')->where('celebrity_id',$celeb->id)->count(); ?>
							  	<?php $unlike = App\Likes::where('likes','0')->where('celebrity_id',$celeb->id)->count(); ?>
							  	<a href="{{url('celeb_like/'.$celeb->id)}}"><i class="fa fa-thumbs-up"></i></a> {{$like}}
			                    <a href="{{url('celeb_dislike/'.$celeb->id)}}"><i class="fa fa-thumbs-down"></i></a> {{$unlike}}
		                	</div>
		            	</div>
					</div>
				@endforeach
			</div>

			<div class="col-xs-6">
				<div class="row">
					<div class="col-xs-6">
						POLITICIAN &emsp; <a href="{{url('politicians')}}">VIEW ALL</a>
					</div>
				</div><br>
				@foreach($celebrity->where('categoryid',4)->take('4') as $celeb)
					<div class="col-md-3">
						<div class="panel" style="border:1px solid black; height: 250px;">
		               		<div class="panel-body text-center">
			                   <a href="{{url('view_celebrity/'.$celeb->id)}}"><p><img class="img-fluid" src="{{url('/public/uploads/celebrity/'.$celeb->id.'/'.$celeb->image)}}" alt="card image" height="150px" width="100%"></p>
			                    <h4 class="panel-title"  style="color: black;">{{$celeb->name}}</h4><br> </a> 
							  	<?php $like = App\Likes::where('likes','1')->where('celebrity_id',$celeb->id)->count(); ?>
							  	<?php $unlike = App\Likes::where('likes','0')->where('celebrity_id',$celeb->id)->count(); ?>
							  	<a href="{{url('celeb_like/'.$celeb->id)}}"><i class="fa fa-thumbs-up"></i></a> {{$like}}
			                    <a href="{{url('celeb_dislike/'.$celeb->id)}}"><i class="fa fa-thumbs-down"></i></a> {{$unlike}}
		                	</div>
		            	</div>
					</div>
				@endforeach
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
				<li><a href="{{url('advertisement_with_us')}}">ADVERTISEMNET WITH US</a></li>
				<li><a href="{{url('partner_with_us')}}">PARTNER WITH US</a></li>
				<li><a href="{{url('about_us')}}"> SOCIAL MEDIA </a></li>
				<li><a href="{{url('about_us')}}"> ABOUT US </a></li>
				<li><a href="{{url('contact_us')}}"> CONTACT US </a></li>
			</ul>
		</div>
	</div>


</body>
</html>

<script type="text/javascript">
	
$(function()
{
	 $( "#search" ).searchCelebrity({
	  source: "celebrity/search",
	  minLength: 3,
	  select: function(event, ui) {
	  	$('#search').val(ui.item.value);
	  }
	});
});

</script>
<!-- script for autocomplete added by synergy -->
	@include('script.script')
<!-- script for autocomplete added by synergy-->