@extends('backend.layouts.layout')
@section('content')

<div id="app_header_shadowing"></div>
<div id="app_content">
    <div id="content_header">
        <h3 class="user"> Menu</h3>
    </div>
        <div id="content_body">
            
            <div class = 'row'>

                <div class = 'col-md-8'>

                    @include('backend.common.errors')

                    {!! Form::model($model,['files' => true]) !!} 
					
					<div class="form-group">
						<label>Name</label>
                        {!! Form::text('name' , $model->name ,['class' => 'form-control']) !!}
					</div>
                      
					<div class="form-group">
                        <label>File Path</label>
                        {!! Form::text('file' , $model->file ,['class' => 'form-control']) !!}
					</div>
					  
					<div class="form-group">
						<label>Status</label>
						{!! Form::select('status' , ['publish' => 'Publish' , 'unpublish' => 'Un Publish'] , null ,['class' => 'form-control']) !!}
					</div>

					<button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
                    
                    {!! Form::close() !!}

                </div>

            </div>

        </div>
    </div>
	@include('backend.popElfinder');
@endsection
@section('script')
<script type="text/javascript">
  
  window.onload = function()
  {
		CKEDITOR.replace( 'description',{
		filebrowserBrowseUrl: '{{ urlBackend("image/lib")}}'});
		
  }
</script>
@endsection