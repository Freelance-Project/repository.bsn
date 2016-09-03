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
						<label>Judul</label>
                        {!! Form::text('title' , $model->title ,['class' => 'form-control']) !!}
					</div>
                      
					<div class="form-group">
                        <label>Ringkasan</label>
                        {!! Form::text('intro' , $model->intro ,['class' => 'form-control']) !!}
					</div>
					  
					<div class="form-group">
						<label>Deskripsi</label>
						{!! Form::textarea('description' , $model->description ,['class' => 'form-control','id'=>'description']) !!}
					</div>
					
					<div class="form-group">
						<label>File</label>
						<div>
							<a class="Wbutton" onclick = "return browseElfinder('image'  , 'image_tempel' , 'elfinder_browse1' , 'cancelBrowse')" >Browse</a>
							Suggestion Image Size (726,449)
						</div>
						<input type = 'hidden' name = 'image' id = 'image' />
						
					</div>
					<div id="image_tempel" style = 'margin-top:30px;'>
						@if(!empty($model->image))
							<img src="{{ asset('contents/news/thumbnail').'/'.$model->image }}" width="200" height="200" />
						@endif
					</div>

					<div class="form-group">
						<label>Date</label>
						{!!  Form::text('date', $date , ['id' => 'datepicker', 'class'=>'form-control']) !!}
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