@extends('layouts.adminlayout')

@section('pagecontent')
<div class="page-title">
	<div class="title_left">
	  <h3>Polls List</h3>
	</div>
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="">
          
          <div class="clearfix"></div>
          <a href="{{ route('poll.create') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add new poll</a>
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
        //"order": [[ 1, "desc" ]],
        /*"columns":[
            { "sortable": true },
            { "sortable": true },
            { "sortable": false },
            { "sortable": false },
        ],*/
        "columns":[{ "title": "Poll Subject", "sortable": true}, { "title": "Poll Options", "sortable": true},{ "title": "Status", "sortable": false},{ "title": "Actions", "sortable": false}],
        "ajax":{
            url: '{{ url('/admin/poll/listDatatable') }}', // json datasource
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

function changeStatus(pollid, newstatus){
    if(!confirm('Are you sure you want to chage the status?')){
        return false;
    }
    $.ajax({
        url: '{{ url('/admin/poll/changestatus') }}',
        type: 'post',
        data: { pollid: pollid, newstatus:newstatus, _token: '{{csrf_token()}}' },
        success: function(data){
            if(newstatus == 0){
                $('div.statusBtn'+pollid).html('<a href="javascript:void(0);" onclick="changeStatus('+pollid+', 1)" class="btn btn-danger btn-sm" title="Click here to make it active">Inactive</a>');
            }else{
                $('div.statusBtn'+pollid).html('<a href="javascript:void(0);" onclick="changeStatus('+pollid+', 0)" class="btn btn-success btn-sm" title="Click here to make it inactive">Active</a>');

            }
            $('#msgContainer').show().html('<div class="alert alert-success">Poll status have been updated successfully!!</div>').fadeOut(5000);
        },
        error: function (data, textStatus, errorThrown) {
            alert('Error Occurred');
        },
    })
}

function deleteRecord(pollid){
    if(!confirm('Are you sure you want to delete the poll record?')){
        return false;
    }
    $.ajax({
        url: '{{ url('/admin/poll') }}/'+pollid,
        type: 'DELETE',
        data: {
            "id": pollid,
            "_method": 'DELETE',
            "_token": '{{csrf_token()}}',
        },
        success: function (data){
            if(data.status == 'success'){
                $('#msgContainer').show().html('<div class="alert alert-success">'+data.msg+'</div>').fadeOut(5000);
            }else{
                $('#msgContainer').show().html('<div class="alert alert-danger">'+data.msg+'</div>').fadeOut(5000);
            }
            setTimeout(function(){
                window.location.reload();
            }, 3000);
            
        },
        error: function (data, textStatus, errorThrown) {
            alert('Error Occurred');
        }
    });
}
</script>
@stop