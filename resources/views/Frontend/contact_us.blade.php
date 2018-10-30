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
  <style>

.contact-form-inner{
	background: #f1f1f1;
	padding: 30px;
	margin: 20px 0;
}

.about-top h2 {
    font-weight:  bold;
    color: #c30757;
}

.about-top {text-align: center;line-height: 24px;margin-bottom: 20px;}

.about-top p {
    max-width:  1000px;
    margin:  0 auto;
}

.icon-info {
	padding: 20px;
	font-size: 15px;
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
								<a href="{{url('all_users')}}" class="btn btn-default">Users</a>
            @endguest
				</div>
			</div>
		</div><br><br><br>

   <div class="row">
     <div class="col-md-12">
       <div class="about-top">
         <h2>Contact Us</h2>
       </div>
     </div>
   </div>
 </div>

 <div class="contact-form">
   <div class="container">
     <div claas="row">
        <div class="col-md-12">
          <form action="{{url('save_user')}}" method="post" enctype="multipart/form-data">

            <div class="row">
              <!-- <div class="col-md-6">
								<div class="contact-form-inner">
									<input type="hidden" name="id" value="">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label> First Name </label>
												<input type="text" name="name"  value=""  class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label> Last Name </label>
												<input type="text" name="name"  value=""  class="form-control">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label> Mobile Number </label>
												<input type="email" name="email" value="" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label> Email </label>
												<input type="email" name="email" value="" class="form-control">
											</div>
										</div>
									</div>

									<div class="form-group">
                    <label> Message </label>
                    <textarea type="date" rows="5" name="date_of_birth" value="" class="form-control">
                    </textarea>
                  </div>

                   <button type="submit" class="btn btn-primary">Submit</button>
								</div> -->
                </div>
                <div class="col-md-6">
								<div class="icon-info">
								<p><i class="fa fa-envelope"></i> exampl@gmail.com</p>
								<p><i class="fa fa-phone"></i> (+1) 8999-909-900</p>
                <br/>
								<h5>Social Touch</h5>

								<p><i class="fa fa-facebook"></i>
								<i class="fa fa-google-plus-official"></i>
					  		<i class="fa fa-twitter"></i>
								<i class="fa fa-linkedin"></i></p>
						  	</div>
                </div>
          </form>
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
				<li><a href="{{url('advertisement_with_us')}}">ADVERTISEMNET WITH US</a></li>>
				<li><a href="{{url('partner_with_us')}}">PARTNER WITH US</a></li>
				<li><a href="{{url('about_us')}}"> SOCIAL MEDIA </a></li>
				<li><a href="{{url('about_us')}}"> ABOUT US </a></li>
				<li><a href="{{url('contact_us')}}"> CONTACT US </a></li>
			</ul>
		</div>
	</div>


</body>
</html>
