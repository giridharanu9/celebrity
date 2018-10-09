@extends('layouts.adminlayout')

@section('pagecontent')
<link href="{{ asset('public/admin/css/select/select2.min.css') }}" rel="stylesheet">
<div class="page-title">
	<div class="title_left">
	  <h3>Add new celebrity</h3>
	</div>
</div>
<div class="clearfix"></div>
<!--
@if(count($errors) > 0)
@foreach ($errors->all() as $error)
<div class="horizontal-center alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{$error}}
</div>
@break
@endforeach
@endif
-->

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
          <form id="demo-form2" method="POST" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('celebrity.store') }}" enctype="multipart/form-data" files="true">
          	<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="celebrityname">Celebrity Full Name <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="celebrityname" required="required" value="{{ old('celebrityname') }}" class="form-control col-md-7 col-xs-12" name="celebrityname">
					<div class="error">{{ $errors->first('celebrityname') }}</div>
	            </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">Celebrity Gender <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                    </select>
                    <div class="error">{{ $errors->first('gender') }}</div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_of_birth">Date Of Birth <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="date" id="date_of_birth" required="required" value="{{ old('date_of_birth') }}" class="form-control col-md-7 col-xs-12" name="date_of_birth">
                    <div class="error">{{ $errors->first('date_of_birth') }}</div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="celebritydetails">Celebrity Details <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea  id="celebritydetails" required="required"  class="form-control col-md-7 col-xs-12" name="celebritydetails">{{ old('celebritydetails') }}</textarea>
                    <div class="error">{{ $errors->first('celebritydetails') }}</div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="celebritydetails">Select Category <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    
                    <select class="form-control col-md-7 col-xs-12" name="category" id="category">
                        <option value="">Please select category</option>
                        @if($categoryData)
                        @foreach($categoryData as $row){
                            <option value="{{$row->id}}">{{ ucfirst($row->categorytitle) }}</option>
                        }
                        @endforeach
                        @endif
                    </select>
                    <div class="error">{{ $errors->first('category') }}</div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="celebritydetails">Select Skill Set <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    
                    <select class="form-control col-md-7 col-xs-12" name="skills[]" id="skills" multiple="multiple">
                        <option value="">Please select skill</option>
                        @if($skillsData)
                        @foreach($skillsData as $row){
                            <option value="{{$row->id}}">{{ ucfirst($row->skilltitle) }}</option>
                        }
                        @endforeach
                        @endif
                    </select>
                    <div class="error">{{ $errors->first('skills') }}</div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="twitter_id">Celebrity Twitter ID <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="twitter_id" required="required" value="{{ old('twitter_id') }}" class="form-control col-md-7 col-xs-12" name="twitter_id">
                    <div class="error">{{ $errors->first('twitter_id') }}</div>
                </div>
            </div>

             <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="insta_frame">Celebrity Insta Frame <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="insta_frame" required="required" value="{{ old('insta_frame') }}" class="form-control col-md-7 col-xs-12" name="insta_frame">
                    <div class="error">{{ $errors->first('insta_frame') }}</div>
                </div>
            </div>

             <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fb_frame">Celebrity Facebook Frame <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="fb_frame" required="required" value="{{ old('fb_frame') }}" class="form-control col-md-7 col-xs-12" name="fb_frame">
                    <div class="error">{{ $errors->first('fb_frame') }}</div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="celebritydetails">Celebrity Profile Picture <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="col-md-12 col-sm-2 col-xs-12">
                        <label class="btn-bs-file btn-sm btn btn-lg btn-primary">
                            Browse
                            <input type="file" name="userpic" id="userpic" style="display:none;" onchange="showMyImage(this)" accept="image/*" >
                        </label>
                        <img id="thumbnil" style="width:90px; margin-top:10px;display: none;"  src="" alt="image"/>
                    </div>
                    <div class="error">{{ $errors->first('userpic') }}</div>
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
    for (var i = 0; i < files.length; i++) {           
        var file = files[i];
        var imageType = /image.*/;     
        if (!file.type.match(imageType)) {
            continue;
        }           
        var img=document.getElementById("thumbnil");            
        img.file = file;    
        var reader = new FileReader();
        reader.onload = (function(aImg) { 
            return function(e) { 
                aImg.src = e.target.result; 
            }; 
        })(img);
        reader.readAsDataURL(file);
        $('#thumbnil').show();
    }    
}
</script>
@stop