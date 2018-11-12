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

  .about-full {
    background: #f1f1f1;
    padding: 55px 0;
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
         <h2>{{$pageData->name}}</h2>
         <p>{!! $pageData->description !!}
          </p>
       </div>
     </div>
   </div>
 </div>

 <div class="about-full">
   <div class="container">
     <div claas="row">
        <div class="col-md-12">
          <div class="col-md-4">
          <img src="images/1537443788.jpg" class="img-responsive" />
          </div>
          <div class="col-md-4">
            <img src="images/1537443788.jpg" class="img-responsive"/>
          </div>
          <div class="col-md-4">
            <img src="images/1537443788.jpg" class="img-responsive"/>
          </div>
        </div>
     </div>
   </div>
 </div>
<br><br><br>
@include('includes.footer')
</body>
</html>
