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
					
					<div class="form-group col-md-12">
						<label>Judul</label>
                        {!! Form::text('title' , $model->title ,['class' => 'form-control', 'required']) !!}
					</div>
                    
					<div class="form-group col-md-6">
						<label>Tahun</label>
                        {!! Form::text('year' , $model->year ,['class' => 'form-control', 'required']) !!}
					</div>
			
					<div class="form-group col-md-6">
						<label>Bentuk File</label><br>
                        {!!  Form::select('availability',['softcopy'=>'Softcopy','hardcopy'=>'Hardcopy'], null, ['class'=>'form-control', 'required']) !!}
					</div>
					<div class="form-group col-md-12">
						<label>File</label>
						<div>
							<a class="Wbutton" onclick = "return browseElfinder('file'  , 'file_tempel' , 'elfinder_browse1' , 'cancelBrowse')" >Browse</a>
							Suggestion Ms. Word / Excel / PDF / JPG / MP3  Size (726,449)
						</div>
						<input type = 'hidden' name = 'file' id = 'file' />
					</div>
					
					<div class="form-group col-md-6">
						<label>Status</label><br>
                        {!!  Form::select('status',['unpublish'=>'unpublish','publish'=>'publish'], null, ['class'=>'form-control', 'required']) !!}
					</div>
										
					<div class="form-group col-md-12">
						<button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
                    </div>
					
					
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