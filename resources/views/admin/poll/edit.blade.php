@extends('layouts.adminlayout')

@section('pagecontent')

<div class="page-title">
	<div class="title_left">
	  <h3>Edit poll</h3>
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
          <h2>Poll details update </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form id="demo-form2" method="POST" data-parsley-validate class="form-horizontal form-label-left" action="{{ url('admin/poll/'.$polldata->id) }}">
          	<input name="_method" type="hidden" value="PUT">
          	<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Poll Subject <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="first-name" required="required" value="{{ $polldata->poll_subject }}" class="form-control col-md-7 col-xs-12" name="subject">
					<div class="error">{{ $errors->first('subject') }}</div>
	            </div>

            </div>
            
            <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Poll Options 1 <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="option1" value="{{ $polloptions[0]->poll_option }}">
					<input type="hidden" name="option1_dbId" value="{{ $polloptions[0]->id }}">
					<div class="error">{{ $errors->first('option1') }}</div>
	            </div>
            </div>
            <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Poll Options 2 <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="option2" value="{{ $polloptions[1]->poll_option }}">
					<input type="hidden" name="option2_dbId" value="{{ $polloptions[1]->id }}">
					<div class="error">{{ $errors->first('option2') }}</div>
	            </div>
            </div>
            <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Poll Options 3 <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="option3" value="{{ $polloptions[2]->poll_option }}">
					<input type="hidden" name="option3_dbId" value="{{ $polloptions[2]->id }}">
					<div class="error">{{ $errors->first('option3') }}</div>
	            </div>
            </div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Poll Options 4<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="option4" value="{{ $polloptions[3]->poll_option }}">
					<input type="hidden" name="option4_dbId" value="{{ $polloptions[3]->id }}">
					<div class="error">{{ $errors->first('option4') }}</div>
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


@stop