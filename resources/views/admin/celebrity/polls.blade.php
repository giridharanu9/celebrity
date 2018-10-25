@extends('layouts.adminlayout')

@section('pagecontent')
<link href="{{ asset('public/admin/css/select/select2.min.css') }}" rel="stylesheet">
<div class="page-title">
	<div class="title_left">
	  <h3> Celebrity Polling</h3>
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
           <a data-toggle="modal" data-target="#add_new" class="btn-sm btn-success">Add Rating Questions</a> 
           <a href="{{url('users_rating')}}" class="btn-sm btn-success" style="margin-left: 5px;">Users Rating</a> 
        </div><br>
          <table id="dataListing" class="table table-striped table-bordered">
          	<thead>
          		<tr>
          			<td>ID</td>
                <td>Category</td>
          			<td>Skill</td>
          		</tr>
          	</thead>
          	<tbody>
          		@foreach($rating_question as $rate)
          		<tr>
                <td>{{$rate->id}}</td>
          			<td>{{$rate->category}}</td>
          			<td>{{$rate->skill}}</td>
          		</tr>
          		@endforeach
          	</tbody>
          </table>

          <!-- Primary modal -->
          <div id="add_new" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h6 class="modal-title"> Add New Polloing Questions</h6>
                </div>

                <form method="POST" data-parsley-validate class="form-horizontal form-label-left" action="{{ url('celebrity_questions') }}" enctype="multipart/form-data" files="true">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"><br>
                  <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-12" for="category">Select Category <span class="required">*</span>
                        </label>
                        <div class="col-xs-12">
                          <select required="required" class="form-control" name="category">
                            @foreach($categories as $category)
                            <option value="{{$category->categorytitle}}">{{$category->categorytitle}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div><br>

                    <div class="form-group">
                        <label class="col-md-12" for="skill">Polling Skill <span class="required">*</span>
                        </label>
                        <div class="col-xs-12">
                          <input type="text" required="required" class="form-control col-md-7 col-xs-12" name="skill">
                        </div>
                    </div><br>
                    <div align="right">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div><br>
                  </div>
                  
              </form>

              </div>
            </div>
          </div>
          <!-- /primary modal -->


        </div>
      </div>
    </div>



@stop
