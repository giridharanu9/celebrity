@extends('layouts.adminlayout')

@section('pagecontent')
<link href="{{ asset('public/admin/css/select/select2.min.css') }}" rel="stylesheet">
<div class="page-title">
	<div class="title_left">
	  <h3> Users Activity</h3>
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
           <a data-toggle="modal" data-target="#add_new" class="btn-sm btn-success">Add New Activity</a> 
        </div><br>
          <table id="dataListing" class="table table-striped table-bordered">
          	<thead>
          		<tr align="center">
          			<td>ID</td>
          			<td>Activity</td>
                <td>Alloted Points</td>
                <td>Actions</td>
          		</tr>
          	</thead>
          	<tbody>
          		@foreach($activity as $active)
          		<tr align="center">
          			<td>{{$active->id}}</td>
          			<td>{{$active->name}}</td>
                <td>{{$active->points}}</td>
                <td><a data-toggle="modal" data-target="#edit_points{{$active->id}}" class="btn-sm btn-success"><i class="fa fa-pencil"></i></a> </td>
          		</tr>


                  <!-- Primary modal -->
          <div id="edit_points{{$active->id}}" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h6 class="modal-title"> Update Points</h6>
                </div>
                <form method="post" action="{{url('add_activity')}}"  enctype="multipart/form-data">
                <div class="modal-body">
                <input type="hidden" name="id" value="{{$active->id}}">
                    <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label><b>Update Points* </b> </label>
                            <input type="hidden" name="name" value="{{$active->name}}">
                              <input type="text" name="points" class="form-control" value="{{$active->points}}" required="">
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!-- /primary modal -->





          		@endforeach
          	</tbody>
          </table>

          <!-- Primary modal -->
          <div id="add_new" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h6 class="modal-title"> Add New Activity</h6>
                </div><br><br>

                <form method="POST" data-parsley-validate class="form-horizontal form-label-left" action="{{ url('add_activity')}}" enctype="multipart/form-data" files="true">
                  <div class="modal-body">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="name">Activity Name <span class="required">*</span>
                              </label>
                                <input type="text" required="required" class="form-control" name="name">
                          </div>

                          <div class="form-group">
                              <label for="points">Alloted Points <span class="required">*</span>
                              </label>
                                <input type="text" required="required" class="form-control" name="points">
                          </div><br>
                          <div align="right">
                              <button type="submit" class="btn btn-success">Submit</button>
                          </div><br>
                      </div>
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
