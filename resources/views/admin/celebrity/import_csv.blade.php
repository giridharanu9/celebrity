@extends('layouts.adminlayout')

@section('pagecontent')
<link href="{{ asset('public/admin/css/select/select2.min.css') }}" rel="stylesheet">
<div class="page-title">
	<div class="title_left">
	  <h3>Import CSV</h3>
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
        <div class="x_title">
          <h2>Celebrity details </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form id="demo-form2" method="POST" data-parsley-validate class="form-horizontal form-label-left" action="{{ url('celebrity/upload_csv') }}" enctype="multipart/form-data" files="true">
          	<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="celebritydetails">Import Csv File <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="col-md-12 col-sm-2 col-xs-12">
                        <label class="btn-bs-file btn-sm btn btn-lg btn-primary">
                            Browse
                            <input type="file" name="file" id="file" style="" onchange="showMyImage(this)" >
                        </label>
                        <label id="thumbnil" style="width:90px; margin-top:10px;display: none;"></label>
                    </div>
										<div class="error">{{ $errors->first('file') }}</div>
                </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

<script src="{{ asset('public/admin/js/select/select2.full.js') }}"></script>
<script>
    $(document).ready(function() {
      $("select#skills").select2({
        maximumSelectionLength: 4,
        placeholder: "Please select skill set",
        allowClear: true
      });
    });

function showMyImage(fileInput) {
    var files = fileInput.files;
    console.log(files)
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var fileType = "text/csv";
        if (!file.type.match(fileType)) {
            continue;
        }
        var csv=document.getElementById("thumbnil");
        console.log(file.name)
        csv = file.name;

        $('#thumbnil').show();
    }
}
</script>
@stop
