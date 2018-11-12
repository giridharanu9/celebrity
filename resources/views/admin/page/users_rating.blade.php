@extends('layouts.adminlayout')

@section('pagecontent')
<link href="{{ asset('public/admin/css/select/select2.min.css') }}" rel="stylesheet">
<div class="page-title">
	<div class="title_left">
	  <h3> Users Rating</h3>
	</div>
</div>
<div class="clearfix"></div>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
       
      <div class="x_panel">
        <div class="">
          
          <div class="clearfix"></div>
        </div>
        <div id="msgContainer"></div>
        <div class="x_content">
        <div align="right">
           <a href="{{url('/celebrity/polls/'.$celebrity->id)}}" class="btn-sm btn-success" style="margin-left: 5px;">Back</a> 
        </div><br>
          <table id="dataListing" class="table table-striped table-bordered">
          	<thead>
          		<tr>
          			<td>ID</td>
          			<td>Questions</td>
          			<td>User Name</td>
          			<td>User Ratings</td>
          		</tr>
          	</thead>
          	<tbody>
          		@foreach($ratings as $rate)
          		<tr>
          			<td>{{$rate->id}}</td>
          			<td>{{$rate->getQuestion->question}}</td>
          			<td>{{$rate->getUser->name}}</td>
          			<td>{{$rate->ratings}}</td>
          		</tr>
          		@endforeach
          	</tbody>
          </table>

        </div>
      </div>
    </div>



@stop
