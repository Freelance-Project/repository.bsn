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
						<label>File XLS</label>
                        {!! Form::file('penelitian', ['class' => 'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
						<input type ='hidden' name='category' value='penelitian'>
						<input type ='hidden' name='status' value='publish'>
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
		CKEDITOR.replace( 'intro',{
		filebrowserBrowseUrl: '{{ urlBackend("image/lib")}}'});
		
		CKEDITOR.replace( 'description',{
		filebrowserBrowseUrl: '{{ urlBackend("image/lib")}}'});

		CKEDITOR.replace( 'purpose',{
		filebrowserBrowseUrl: '{{ urlBackend("image/lib")}}'});

  		CKEDITOR.replace( 'summary',{
		filebrowserBrowseUrl: '{{ urlBackend("image/lib")}}'});

  		CKEDITOR.replace( 'recomendation',{
		filebrowserBrowseUrl: '{{ urlBackend("image/lib")}}'});
  }
</script>
@endsection