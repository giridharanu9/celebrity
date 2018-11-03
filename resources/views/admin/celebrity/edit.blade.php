@extends('layouts.adminlayout')

@section('pagecontent')
<link href="{{ asset('public/admin/css/select/select2.min.css') }}" rel="stylesheet">
<div class="page-title">
	<div class="title_left">
	  <h3>Edit celebrity</h3>
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
          <h2>Celebrity details update </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form id="demo-form2" method="POST" data-parsley-validate class="form-horizontal form-label-left" action="{{ url('admin/celebrity/'.$celebrityData->id) }}" enctype="multipart/form-data" files="true">
          	<input name="_method" type="hidden" value="PUT">
          	<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="celebrityname">Celebrity Full Name <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" id="celebrityname" required="required" value="{{ $celebrityData->name }}" class="form-control col-md-7 col-xs-12" name="celebrityname">
          <div class="error">{{ $errors->first('celebrityname') }}</div>
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="celebritydetails">Celebrity Details <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea  id="celebritydetails" required="required"  class="form-control col-md-7 col-xs-12" name="celebritydetails">{{ $celebrityData->description }}</textarea>
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
                        @foreach($categoryData as $row)
                            <option value="{{$row->id}}" {{ ($row->id == $celebrityData->categoryid || $row->id == $celebrityData->parent_category_id) ? 'selected="selected"' : '' }}>{{ ucfirst($row->categorytitle) }}</option>
                        @endforeach
                        @endif
                    </select>
                    <div class="error">{{ $errors->first('category') }}</div>
                </div>
            </div>

            <div class="form-group select-sub-category" id="subcategory" @if(empty($celebrityData->parent_category_id))  @endif>
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="celebritydetails">Select Sub Category <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    
                    <select class="form-control col-md-7 col-xs-12" name="sub_category" id="sub_category">
                        <option value="">Please select Sub category</option>
                        @if($subCategoryData)
                        @foreach($subCategoryData as $row)
                            <option value="{{$row->id}}" {{ ($row->id == $celebrityData->categoryid) ? 'selected="selected"' : '' }}>{{ ucfirst($row->categorytitle) }}</option>
                        @endforeach
                        @endif
                    </select>
                    <div class="error">{{ $errors->first('subcategory') }}</div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="celebritydetails">Select Skill Set <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php
                        $skillsArr = [];
                        $skillsArr = explode(',', $celebrityData->skills);
                        ?>
                    <select class="form-control col-md-7 col-xs-12" name="skills[]" id="skills" multiple="multiple">
                        <option value="">Please select skill</option>
                        @if($skillsData)

                        @foreach($skillsData as $row){
                            <option value="{{$row->id}}" {{ in_array($row->id, $skillsArr) ? 'selected="selected"' :'' }} >{{ ucfirst($row->skilltitle) }}</option>
                        }
                        @endforeach
                        @endif
                    </select>
                    <div class="error">{{ $errors->first('skills') }}</div>
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
                        @if($celebrityData->image)
                            <img id="thumbnil"  style="width:90px; margin-top:10px;"  src="{{ url('/') }}/public/uploads/celebrity/{{ $celebrityData->id.'/'.$celebrityData->image }}" alt="image"/>
                        @else
                            <img id="thumbnil"  style="width:90px; margin-top:10px;"  src="{{ url('/') }}/public/admin/images/user2.png" alt="image"/>
                        @endif
                        
                    </div>
                    <div class="error">{{ $errors->first('userpic') }}</div>
                </div>
            </div>
            
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success">Update</button>
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

//get subcateogries according to sector selection
  $("#category").change(function(){
    $('#subcategory').hide();
    $('#subcategory').find('option:not(:first)').remove();
    $url = '{{url("admin/celebrity/getSubCategories")}}';
    $.get($url+"/"+ $(this).val(), function(data){
        $element = $("#sub_category");
       if(data[0])
       {
        $('#subcategory').show();
       }
        $(data).each(function(){
          $element.append("<option value='"+ this.id +"'>"+ this.categorytitle +"</option>");
        });
    });
  })

</script>
@stop