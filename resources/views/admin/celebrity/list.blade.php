@extends('layouts.adminlayout')

@section('pagecontent')
<div class="page-title">
	<div class="title_left">
	  <h3>Celebrities List</h3>
	</div>
</div>
<div class="clearfix"></div>

@if(session()->has('message.level'))
<div class="horizontal-center alert alert-{{ session('message.level') }}"> 
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    {!! session('message.content') !!}
</div>
@endif

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="">
          
          <div class="clearfix"></div>
          <a href="{{ route('celebrity.create') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add new celebrity</a>

          <a href="{{ route('celebrity.polls') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add Skill Polls</a>

        </div>
        <div id="msgContainer"></div>
        <div class="x_content">
          <table id="dataListing" class="table table-striped table-bordered"></table>
        </div>
      </div>
    </div>
   
<script>
var dataTable ;
$(document).ready(function() { 
    dataTable = $("#dataListing").DataTable( {
        "processing": true,
        "serverSide": true,
        "columns":[{ "title": "Id", "sortable": true}, { "title": "Celebrity Name", "sortable": true}, { "title": "Category", "sortable": true}, { "title": "Image", "sortable": false},{ "title": "Status", "sortable": false},{ "title": "Actions", "sortable": false}],
        "ajax":{
            url: '{{ url('/admin/celebrity/listDatatable') }}', // json datasource
            type: "POST",  // method  , by default get
            data: { _token: '{{csrf_token()}}' },
            error: function(){  // error handling
                $(".dataListing-error").html("");
                $("#dataListing").append('<tbody class="dataListing-grid-error"><tr><th class="text-center alert alert-danger" colspan="4">No data found</th></tr></tbody>');
                $("#dataListing_processing").css("display","none");
            },
        }
    } );
} );

function changeStatus(id, newstatus){
    if(!confirm('Are you sure you want to change the status?')){
        return false;
    }
    $.ajax({
        url: '{{ url('/admin/celebrity/changestatus') }}',
        type: 'post',
        data: { id: id, newstatus:newstatus, _token: '{{csrf_token()}}' },
        success: function(data){
            if(newstatus == 0){
                $('div.statusBtn'+id).html('<a href="javascript:void(0);" onclick="changeStatus('+id+', 1)" class="btn btn-danger btn-sm" title="Click here to make it active">Inactive</a>');
            }else{
                $('div.statusBtn'+id).html('<a href="javascript:void(0);" onclick="changeStatus('+id+', 0)" class="btn btn-success btn-sm" title="Click here to make it inactive">Active</a>');

            }
            $('#msgContainer').show().html('<div class="alert alert-success">Celebrity status have been updated successfully!!</div>').fadeOut(5000);
        },
        error: function (data, textStatus, errorThrown) {
            alert('Error Occurred');
        },
    })
}

</script>
@stop