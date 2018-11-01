<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="{{url('assets/notificationToast/css/jquery.toastmessage.css')}}">
	<script type="text/javascript" src="{{url('assets/notificationToast/jquery.toastmessage.js')}}"></script>
	@include('files.files')
	<style type="text/css">
	@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
	.rating { 
		border: none;
		float: left;
		margin:0px 0px 0px 28px;
	}

	.rating > input { display: none; } 
	.rating > label:before { 
		margin-top: 2px;
		padding:0px 5px 0px 5px;
		font-size: 1.25em;
		font-family: FontAwesome;
		display: inline-block;
		content: "\f005";
	}

	.rating > .half:before { 
		content: "\f089";
		position: absolute;
	}

	.rating > label { 
		color: #fff; 
		float: right;
		margin:4px 1px 0px 0px;
		background-color:#D8D8D8;
		border-radius:15px;
		height:25px;
	}

	/***** CSS Magic to Highlight Stars on Hover *****/

	.rating:not(:checked) > label:hover, /* hover current star */
	.rating:not(:checked) > label:hover ~ label { 
		background-color:#7ED321 !important;
		cursor:pointer;
		} /* hover previous stars in list */

		.rating > input:checked + label:hover, /* hover current star when changing rating */
		.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
		.rating > input:checked ~ label:hover ~ label { 
			background-color:#7ED321 !important;
			cursor:pointer;
		} 
		.checked {
			color: orange;
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
		@include('includes.search')	
		<div class="row">
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-3">
						<h3>{{$celebrity->name}} </h3><br>
						<div class="panel" style="border:1px solid black;width: 300px;">
							<div class="panel-body text-center">
								<img class="img-fluid" src="{{url('/public/uploads/celebrity/'.$celebrity->id.'/'.$celebrity->image)}}" alt="card image" width="100%" height="300px">
							</div>
						</div>
					</div>

					<div class="col-md-9"><br><br><br><br>
						<div class="row">
							<div class="col-md-9 col-md-push-1">
								<div class="row">
									<div class="col-md-3" style="border:1px solid black;">
										<h5><i class="fa fa-heart fa-2x" style="color: red;"></i> Lovers  <b>{{\App\Celebrity::getLikesCount($celebrity->id)}} </b> </h5>
									</div>
									<div class="col-md-3">
										<h5>Weekly Count <b>{{\App\Celebrity::getLikesWeeklyCount($celebrity->id)}} % </b> </h5>
									</div>
									<div class="col-md-3">
										<h5>Monthly Count <b>{{\App\Celebrity::getLikesMonthlyCount($celebrity->id)}} % </b></h5>
									</div>
									<div class="col-md-3">
										<h5>Yearly Count <b>{{\App\Celebrity::getLikesYearlyCount($celebrity->id)}} % </b></h5>
									</div>
								</div><br>

								<div class="row">
									<div class="col-md-3" style="border:1px solid black;">
										<h5><i class="fa fa-heart fa-2x" style="color: black;"></i> Haters  <b>{{\App\Celebrity::getDisLikesCount($celebrity->id)}} </b> </h5>
									</div>
									<div class="col-md-3">
										<h5>Weekly Count <b>{{\App\Celebrity::getDisLikesWeeklyCount($celebrity->id)}} % </b> </h5>
									</div>
									<div class="col-md-3">
										<h5>Monthly Count <b>{{\App\Celebrity::getDisLikesMonthlyCount($celebrity->id)}} % </b> </h5>
									</div>
									<div class="col-md-3">
										<h5>Yearly Count <b>{{\App\Celebrity::getDisLikesYearlyCount($celebrity->id)}} % </b></h5>
									</div>
								</div>
							</div>
						</div><br><br><br><br><br><br>

						<div class="row">
							<div class="col-md-8 col-md-push-1">
								<?php $url = url()->current(); ?>
								<?php
								$Url = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
								$Url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

							//$Url = "https://www.biography.com/people/calista-flockhart-9542455";
								?>

								<div class="col-md-2"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $Url; ?>&display=popup"><button class="btn btn-primary"><i class="fa fa-facebook-square fa-2x"></i> Share</button>  </a></div>
								<div class="col-md-2"><a href="https://www.instagram.com/?url=<?php echo $Url; ?>"><button class="btn" style="background-color: #cd486b;color: white;"> <i class="fa fa-instagram fa-2x"></i> Insta</button></a></div>
								<div class="col-md-2"><a href="https://twitter.com/intent/tweet?text=<?php echo $Url; ?>"><button class="btn btn-info"> <i class="fa fa-twitter fa-2x"></i> Tweet</button></a></div>
								<div class="col-md-2"><a href="https://plus.google.com/share?url=<?php echo $Url; ?>"><button class="btn btn-danger"><i class="fa fa-google-plus fa-2x"></i> Share</button></a></div>

							</div>
						</div><br>

						<div class="row">
							<div class="col-md-8 col-md-push-1">
								 <h2>Give you feedback here</h2><br/>
								      @if ($errors->any())
								      <div class="alert alert-danger">
								          <ul>
								              @foreach ($errors->all() as $error)
								                  <li>{{ $error }}</li>
								              @endforeach
								          </ul>
								      </div><br />
								      @endif
								      @if(session('output'))
									   <div class="feedback" style="font-size:24px;color:green;">{{session('output')}}</div>
									  @endif
								      <form method="post" action="{{url('celebrity/sendFeedback')}}">
								        @csrf
								        <div class="row">
								          <div class="col-md-8"></div>
								          <div class="form-group col-md-8">
								            <label for="Name">Feedback:</label>
								            <textarea class="form-control" name="feedback">
								            	
								            </textarea>
								          </div>
								        </div>
								        <div class="row">
								          <div class="col-md-8"></div>
								          <div class="form-group col-md-8">
								             <div class="captcha">
								               <span>{!! captcha_img() !!}</span>
								               <button type="button" class="btn btn-success"><i class="fa fa-refresh" id="refresh"></i></button>
								               </div>
								            </div>
								        </div>
								        <div class="row">
								          <div class="col-md-4"></div>
								            <div class="form-group col-md-4">
								             <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha"></div>
								          </div>
								        <div class="row">
								          <div class="col-md-4"></div>
								          <div class="form-group col-md-4">
								            <button type="submit" class="btn btn-success">Submit</button>
								          </div>
								        </div>
								      </form>

							</div>
						</div><br>

						<div class="row">
							<div class="col-md-12">
								@guest
								@else
								<?php $likes = App\Likes::where('user_id',\Auth::user()->id)->where('celebrity_id',$celebrity->id)->first(); ?>

								@if($likes && $likes->likes == 1)
								<a href="" class="btn btn-success"><i class="fa fa-thumbs-up"></i> Like <b>{{\App\Celebrity::getLikesCount($celebrity->id)}}</b></a>

								<a href="{{url('celeb_dislike/'.$celebrity->id)}}" class="btn btn-default"><i class="fa fa-thumbs-down"></i> Dislike <b>{{\App\Celebrity::getDisLikesCount($celebrity->id)}}</b></a>
								@elseif(!$likes)
								<a href="{{url('celeb_like/'.$celebrity->id)}}" class="btn btn-default"><i class="fa fa-thumbs-up"></i> Like <b>{{\App\Celebrity::getLikesCount($celebrity->id)}}</b></a>

								@else($likes->likes == 0)
								<a href="{{url('celeb_like/'.$celebrity->id)}}" class="btn btn-default"><i class="fa fa-thumbs-up"></i> Like <b>{{\App\Celebrity::getLikesCount($celebrity->id)}}</b></a>

								<a href="" class="btn btn-danger"><i class="fa fa-thumbs-down"></i> Dislike <b>{{\App\Celebrity::getDisLikesCount($celebrity->id)}}</b></a>
								@endif


			              <!--   @if(isset($like))
						       <a onclick="like();" id="like" @if($like->likes==0) style="display:  none;" @endif class="btn btn-default"><i class="fa fa-thumbs-up"></i>Like <b>{{\App\Celebrity::getLikesCount($celebrity->id)}}</b></a>

						       <a onclick="dislike();" @if($like->likes==1) style="display:  none;" @endif  class="btn btn-default" id="unlike"><i class="fa fa-thumbs-down"></i>Dislike <b>{{\App\Celebrity::getDisLikesCount($celebrity->id)}}</b></a>
					       @else
						       <a onclick="like();" id="like" class="btn btn-default"><i class="fa fa-thumbs-up"></i>Like <b>{{\App\Celebrity::getLikesCount($celebrity->id)}}</b></a>
						       <a onclick="dislike();" class="btn btn-default" id="unlike"><i class="fa fa-thumbs-down"></i>Dislike <b>{{\App\Celebrity::getDisLikesCount($celebrity->id)}}</b></a>
						       @endif -->

						       <?php $follow = App\Follow::where('user_id',\Auth::user()->id)->where('celebrity_id',$celebrity->id)->first() ?>
						       @if($follow && $follow->follow == 1)
						       <a href="" class="btn btn-primary"><i class="fa fa-thumbs-up"></i> Follow <b>{{\App\Celebrity::getFollowCount($celebrity->id)}}</b></a>
						       @else
						       <a href="{{url('celeb_follow/'.$celebrity->id)}}" class="btn btn-default"><i class="fa fa-thumbs-up"></i> Follow <b>{{\App\Celebrity::getFollowCount($celebrity->id)}}</b></a>
						       @endif

						       @if($follow)

						       <a href="{{url('celeb_unfollow/'.$celebrity->id)}}" class="btn btn-default"><i class="fa fa-thumbs-down"></i> Unfollow</a>

						       @endif

					       <!-- @if(isset($follow))
						       <a onclick="follow();" id="follow" @if($follow->follow==0) style="display:  none;" @endif class="btn btn-default"><i class="fa fa-thumbs-up"></i>Follow <b>{{\App\Celebrity::getFollowCount($celebrity->id)}}</b></a>

						       <a onclick="unfollow();" @if($follow->follow==1) style="display:  none;" @endif  class="btn btn-default" id="unfollow"><i class="fa fa-thumbs-down"></i>Unfollow <b>{{\App\Celebrity::getUnFollowCount($celebrity->id)}}</b></a>
					       @else
						       <a onclick="follow();" id="follow" class="btn btn-default"><i class="fa fa-thumbs-up"></i>Follow <b>{{\App\Celebrity::getFollowCount($celebrity->id)}}</b></a>
						       <a onclick="unfollow();" class="btn btn-default" id="unfollow"><i class="fa fa-thumbs-down"></i>Unfollow <b>{{\App\Celebrity::getUnFollowCount($celebrity->id)}}</b></a>
						       @endif -->
						       <?php $favorite = App\Favorites::where('user_id',\Auth::user()->id)->where('celebrity_id',$celebrity->id)->first() ?>
						       @if($favorite && $favorite->favorite == 1)
						       <a href="" class="btn btn-info"><i class="fa fa-thumbs-up"></i> Add To Favorites <b>{{\App\Celebrity::getFavoritesCount($celebrity->id)}}</b></a>
						       @else
						       <a href="{{url('add_favorite/'.$celebrity->id)}}" class="btn btn-default"><i class="fa fa-thumbs-up"></i> Add To Favorites <b>{{\App\Celebrity::getFavoritesCount($celebrity->id)}}</b></a>
						       @endif


						       @if($favorites)

						       <a href="{{url('remove_favorite/'.$celebrity->id)}}" class="btn btn-default"><i class="fa fa-thumbs-down"></i> Remove From Favorites </a>

						       @endif

					       <!-- @if(isset($favorites))
						       <a onclick="favorites();" id="favorites" @if($favorites->favorites==0) style="display:  none;" @endif class="btn btn-default"><i class="fa fa-thumbs-up"></i>Add To Favorites <b>{{\App\Celebrity::getFavoritesCount($celebrity->id)}}</b></a>

						       <a onclick="unfavorites();" @if($favorites->favorites==1) style="display:  none;" @endif  class="btn btn-default" id="unfavorites"><i class="fa fa-thumbs-down"></i>Remove Favorites <b>{{\App\Celebrity::getUnFavoritesCount($celebrity->id)}}</b></a>
					       @else
						       <a onclick="favorites();" id="favorites" class="btn btn-default"><i class="fa fa-thumbs-up"></i>Add To Favorites <b>{{\App\Celebrity::getFavoritesCount($celebrity->id)}}</b></a>
						       <a onclick="unfavorites();" class="btn btn-default" id="unfavorites"><i class="fa fa-thumbs-down"></i>Remove Favorites <b>{{\App\Celebrity::getUnFavoritesCount($celebrity->id)}}</b></a>
						       @endif -->


						       @endguest

						   </div>
						</div>

					</div>
				</div><br>
<div class="row">
	<div class="col-md-4">
		<!-- Trigger the modal with a button -->
		<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">view like rank</button>
		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Login/Registration</h4>
					</div>
					<div class="modal-body">
						<div class="card loginsection">
							<!-- <div class="card-header">{{ __('Login') }}</div> -->
							<div class="card-body">
								<form method="POST" id="Login">
									@csrf
									<div id="loginerror"></div>
									<div class="form-group row">
										<label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

										<div class="col-md-6">
											<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

											@if ($errors->has('email'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('email') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="form-group row">
										<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

										<div class="col-md-6">
											<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

											@if ($errors->has('password'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('password') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-6 offset-md-4">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
												</label>
											</div>
										</div>
									</div>
									<div class="form-group row mb-0">
										<div class="col-md-8 offset-md-4">
                            				<button type="button" id="submitLoginForm" class="btn btn-primary btn-prime white btn-flat">Login</button>
                            			<a class="btn btn-link" href="{{ route('password.request') }}">
			                                	{{ __('Forgot Your Password?') }}
			                                </a>

			                                <!-- <a class="btn btn-link" href="{{ route('register') }}">
			                                    {{ __('Dont Have An Account?') }}
			                                </a> -->
			                                <a class="btn btn-link registerhere">
			                                	{{ __('Dont Have An Account?') }}
			                                </a>
			                            </div>
			                        </div>
		                       	<hr>
		                        <div class="form-group">
		                        	<div class="col-md-8 col-md-offset-4">
		                        		<a href="{{ url('/auth/twitter') }}" class="btn btn-twitter"><i class="fa fa-twitter"></i> Twitter</a>
		                        		<a href="{{ url('/auth/facebook') }}" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
		                        		<a href="{{ url('/auth/instagram') }}" class="btn btn-instagram"><i class="fa fa-instagram"></i> Instagram</a>
		                        		<a href="{{ url('/auth/google') }}" class="btn btn-google"><i class="fa fa-google"></i> Google</a>
		                        	</div>
		                        </div>
		                    </form>
		                </div>
		            </div>
		            <div class="card registersection" style="display:none">
		            	<!-- <div class="card-header">{{ __('Register') }}</div> -->
		            	<div id="SignUp" >
		            		<div id="success-msg" class="hide">
		            			<div class="alert alert-info alert-dismissible fade in" role="alert">
		            				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		            					<span aria-hidden="true">×</span>
		            				</button>
		            				<strong>Success!</strong> Check your mail for login confirmation!!
		            			</div>
		            		</div>
		            		<div class="col-md-offset-1 col-md-10">
		            			<form method="POST" id="Register">
		            				{{ csrf_field() }}
		            				<div class="form-group has-feedback">
		            					<input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Full name">
		            					<span class="glyphicon glyphicon-user form-control-feedback"></span>
		            					<span class="text-danger">
		            						<strong id="name-error"></strong>
		            					</span>
		            				</div>
		            				<div class="form-group has-feedback">
		            					<input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
		            					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		            					<span class="text-danger">
		            						<strong id="email-error"></strong>
		            					</span>
		            				</div>
		            				<div class="form-group has-feedback">
		            					<input type="password" name="password" class="form-control" placeholder="Password">
		            					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
		            					<span class="text-danger">
		            						<strong id="password-error"></strong>
		            					</span>
		            				</div>
		            				<div class="form-group has-feedback">
		            					<input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
		            					<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
		            				</div>
		            				<div class="row">
		            					<div class="col-xs-12 text-center">
		            						<button type="button" id="submitForm" class="btn btn-primary btn-prime white btn-flat">Register</button>
		            						<a class="btn btn-link loginhere">
		            							{{ __('Login') }}
		            						</a>
		            					</div>
		            				</div>

		            			</form>
		            		</div>
		            	</div>
		            </div>
		        </div>
		    <div class="modal-footer">
		    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div>
		</div>
		</div>
	</div>
</div>
	<a href="{{url('getlikesrank/'.$celebrity->id)}} ">view like rank</a>
	<h4>Ratings</h4><br>
	<table>

		@foreach($questions as $row)
		@php($avg1 = App\Celebrity::getRatingCount($celebrity->id,$row->id))
		<tr>
			<td><span class="field-label-header"><b>{{$row->skill}}</b></span> &emsp;</td>
			<td>
				<span class="fa fa-star @if($avg1 >= 1) checked @endif"></span>
				<span class="fa fa-star @if($avg1 >= 2) checked @endif"></span>
				<span class="fa fa-star @if($avg1 >= 3) checked @endif"></span>
				<span class="fa fa-star @if($avg1 >= 4) checked @endif"></span>
				<span class="fa fa-star @if($avg1 >= 5) checked @endif"></span>
			</td>
			<td>
				&emsp;
				@if($avg1 == 1)
				Bad
				@elseif($avg1 == 2)
				Poor
				@elseif($avg1 == 3)
				Average
				@elseif($avg1 == 4)
				Good
				@elseif($avg1 == 5)
				Excellent

				@endif

			</td>

		</tr>
		@endforeach		
	</table>		
</div>
@guest
@else
<div class="col-md-4">
	<h4>Rate Your Celebrity</h4>
	<table>
		<form class="poststars" action="{{url('rating/'.$celebrity->id)}}" id="addStar" method="POST">
		@foreach($questions as $row)
		<!-- <form class="poststars" action="{{url('rating/'.$celebrity->id)}}" id="addStar" method="POST"> -->

			<div class="star-rating">
				{{ csrf_field() }}


				<?php $ratings = App\Ratings::where('celebrity_id',$celebrity->id)->where('question_id',$row->id)->where('user_id',Auth::user()->id)->first(); 
				?>
				<input type="hidden" name="question_id[]" value="{{$row->id}}">
				<tr class="ratingrow">
					<td><br><span class="field-label-header"><b>{{$row->skill}}</b></span><br></td>
					<td><br>
						@if($ratings)
						<fieldset class="rating">
							<input type="radio" class="fivestor" id="star5{{$row->id}}" name="rating{{$row->id}}" value="5" @if($ratings->ratings >= '5')  checked @endif  /><label class = "full fivestor" for="star5{{$row->id}}" @if($ratings->ratings >= '5')  style="background-color: rgb(126, 211, 33);" @endif ></label>

							<input type="radio" id="star4{{$row->id}}" name="rating{{$row->id}}" value="4" @if($ratings->ratings >= '4' && $ratings->ratings < '5')  checked @endif /><label class = "full" for="star4{{$row->id}}" @if($ratings->ratings >= '4')  style="background-color: rgb(126, 211, 33);" @endif ></label>

							<input type="radio" id="star3{{$row->id}}" name="rating{{$row->id}}" value="3" @if($ratings->ratings >= '3' && $ratings->ratings < '4')  checked @endif /><label class = "full" for="star3{{$row->id}}" @if($ratings->ratings >= '3')  style="background-color: rgb(126, 211, 33);" @endif ></label>

							<input type="radio" id="star2{{$row->id}}" name="rating{{$row->id}}" value="2" @if($ratings->ratings >= '2' && $ratings->ratings < '3')  checked @endif /><label class = "full" for="star2{{$row->id}}" @if($ratings->ratings >= '2')  style="background-color: rgb(126, 211, 33);" @endif ></label>

							<input type="radio" id="star1{{$row->id}}" name="rating{{$row->id}}" value="1" @if($ratings->ratings >= '1' && $ratings->ratings < '2')  checked @endif /><label class = "full" for="star1{{$row->id}}" @if($ratings->ratings >= '1')  style="background-color: rgb(126, 211, 33);" @endif ></label>
						</fieldset>
						@else
						<fieldset class="rating">
							<input type="radio" class="fivestor" id="star5{{$row->id}}" name="rating{{$row->id}}" value="5" /><label class = "full fivestor"  for="star5{{$row->id}}"></label>

							<input type="radio" id="star4{{$row->id}}" name="rating{{$row->id}}" value="4" /><label class = "full" for="star4{{$row->id}}"></label>

							<input type="radio" id="star3{{$row->id}}" name="rating{{$row->id}}" value="3" /><label class = "full" for="star3{{$row->id}}"></label>

							<input type="radio" id="star2{{$row->id}}" name="rating{{$row->id}}" value="2" /><label class = "full" for="star2{{$row->id}}"></label>

							<input type="radio" id="star1{{$row->id}}" name="rating{{$row->id}}" value="1" checked /><label class = "full" for="star1{{$row->id}}"></label>
						</fieldset>
						@endif
					&emsp;</td>

					<td><br><button type="button" class="btn btn-success five-star-rating">Rate 5 Star</button></td>
				</tr>
				
		<!-- </form> -->

		@endforeach
		
		</form>
		<div>
			<tr>
				<td>
					<button type="submit" class="btn btn-success">Submit Rating</button>
				</td>
			</tr>
		</div>	
		
	</table>
</div>
@endguest


@guest
@else
<div class="col-md-3">
	<h4>Featured Polls</h4>
	@foreach($polls as $poll)
	<form method="post" action="{{url('polls_respond/'.$poll->id)}}">
		<?php $poll_respond = App\PollsRespond::where('poll_id',$poll->id)->where('user_id',Auth::user()->id)->first(); ?>
		@if($poll_respond)
		<div  style="display: none;">
			<b>{{$poll->poll_subject}} </b><br>
			<input type="hidden" name="poll_id" value="{{$poll->id}}">
			@foreach($poll->getPollOption as $pol)
			<input type="radio" id="poll_option" name="poll_option" value="{{$pol->poll_option}}"  /><b ></b> {{$pol->poll_option}}
			@endforeach<br><br>
			<button type="submit" class="btn btn-success">Submit</button><br><br>
		</div>
		@else
		<div>
			<b>{{$poll->poll_subject}} </b><br>
			<input type="hidden" name="poll_id" value="{{$poll->id}}">
			@foreach($poll->getPollOption as $pol)
			<input type="radio" id="poll_option" name="poll_option" value="{{$pol->poll_option}}"  /><b ></b> {{$pol->poll_option}}
			@endforeach<br><br>
			<button type="submit" class="btn btn-success">Submit</button><br><br>
		</div>
		@endif


	</form>

	@endforeach
	<a href="{{url('view_polls')}}" class="btn-sm btn-info">View All</a>
</div>
@endguest


</div>

<div class="row">
	<br><br>
	<h4>{{$celebrity->name}} 's Social Media</h4><br>
	<div class="col-md-4">
		<h4>FACEBOOK</h4>
		<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2F{{$celebrity->fb_frame}}%2F&tabs=timeline&&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="900px"  height="700" style="border:none;overflow:hidden;" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
	</div>
	<div class="col-md-4">
		<h4>INSTAGRAM</h4>
		<iframe src="{{$celebrity->insta_frame}}" style="width: 100%;height: 500px;"></iframe>
	</div><br>
	<div class="col-md-3 col-md-push-1" style="height: 500px;overflow: scroll;">
		<h4>TWITTER</h4>
		<p><a class="twitter-timeline" href="https://twitter.com/{{$celebrity->twitter_id}}?ref_src=twsrc%5Etfw">Tweets by {{$celebrity->twitter_id}}</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> </p>
	</div>

</div>
</div>


<div class="col-md-2"><br>
	@include('Frontend.sidebar')
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

<!-- script for autocomplete added by synergy -->
@include('script.script')
<!-- script for autocomplete added by synergy-->


<script type="text/javascript">
	function like() {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {

				$('#like').hide();
				$('#unlike').show();

      // document.getElementById("demo").innerHTML =
      // this.responseText;
  }
};
xhttp.open("GET", "{{url('celeb_like/'.$celebrity->id)}}", true);
xhttp.send();
}


function dislike() {

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			$('#unlike').hide(); 

			$('#like').show();  
      // document.getElementById("demo").innerHTML =
      // this.responseText;/
  }
};
xhttp.open("GET", "{{url('celeb_dislike/'.$celebrity->id)}}", true);
xhttp.send();
}



function follow() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {

			$('#follow').hide();
			$('#unfollow').show();

      // document.getElementById("demo").innerHTML =
      // this.responseText;
  }
};
xhttp.open("GET", "{{url('celeb_follow/'.$celebrity->id)}}", true);
xhttp.send();
}

function unfollow() {

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			$('#unfollow').hide(); 

			$('#follow').show();  
      // document.getElementById("demo").innerHTML =
      // this.responseText;/
  }
};
xhttp.open("GET", "{{url('celeb_unfollow/'.$celebrity->id)}}", true);
xhttp.send();
}



function favorites() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {

			$('#favorites').hide();
			$('#unfavorites').show();

      // document.getElementById("demo").innerHTML =
      // this.responseText;
  }
};
xhttp.open("GET", "{{url('add_favorite/'.$celebrity->id)}}", true);
xhttp.send();
}

function unfavorites() {

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			$('#unfavorites').hide(); 

			$('#favorites').show();  
      // document.getElementById("demo").innerHTML =
      // this.responseText;/
  }
};
xhttp.open("GET", "{{url('remove_favorite/'.$celebrity->id)}}", true);
xhttp.send();
}


$("label").click(function(){
	$(this).parent().find("label").css({"background-color": "#D8D8D8"});
	$(this).css({"background-color": "#7ED321"});
	$(this).nextAll().css({"background-color": "#7ED321"});
});

$(".five-star-rating").click(function(){
	console.log('click function');
	$(this).parents('.ratingrow').find('.fivestor').prop("checked", true).trigger("click");
	$(this).parents('.ratingrow').find('.fivestor').prop("checked", true).trigger("click");
	setTimeout(function(){
	 $( ".poststars" ).submit();
	  }, 2000)
});

$('#refresh').click(function(){
src = "{{ route('refreshcaptcha') }}";
  $.ajax({
     type:'GET',
     url:src,
     success:function(data){
        $(".captcha span").html(data.captcha);
     }
  });
});

</script>