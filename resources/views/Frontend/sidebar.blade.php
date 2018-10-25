<?php $celebrities = App\Celebrity::where('categoryid','=',$celebrity->categoryid)->where('id','!=',$celebrity->id)->take(10)->get(); ?>
<h4>Related Search </h4><br>
<div>
	@foreach($celebrities as $celeb)
	<a href="{{url('view_celebrity/'.$celeb->id)}}">
	<div>
		<h5>{{$celeb->name}}</h5>
		<img class="img-fluid" src="{{url('/public/uploads/celebrity/'.$celeb->id.'/'.$celeb->image)}}" alt="card image" width="70%" height="100px"><br><br>
		<a href="{{url('celeb_like/'.$celeb->id)}}" class="btn btn-default"><i class="fa fa-thumbs-up"></i>Like <b>{{\App\Celebrity::getLikesCount($celeb->id)}}</b></a>
		<a href="{{url('celeb_dislike/'.$celeb->id)}}" class="btn btn-default"><i class="fa fa-thumbs-down"></i>Dislike <b>{{\App\Celebrity::getDisLikesCount($celeb->id)}}</b></a>
	</div>
</a>
		<br>
	@endforeach
</div>