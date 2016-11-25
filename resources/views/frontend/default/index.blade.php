@extends('frontend.layouts.layout')

@section('content')
    <!-- middle -->

    <div id="middle-content" class="intro-landing">
		<div class="container container-table">
	    	<div class="row vertical-center-row">
	            <div class="text-center col-md-7 col-md-offset-3">
	                <div id="imaginary_container">
	                	
	                	{!! Form::open(['url'=>'search/find','method'=>'get']) !!} 
	                    <div class="input-group stylish-input-group">
	                    	
	                        <input type="text" name="request" class="form-control"  placeholder="Search" >
	                        <span class="input-group-addon">
	                            <button type="submit">
	                                <span class="glyphicon glyphicon-search"></span>
	                            </button>  
	                        </span>
	                       
	                    </div><!--end.search--input-->
	                    {!! Form::close() !!}
	                    <div class="cat-search text-center">
	                    	<a href="{{url('search/research')}}" class="btn btn-primary">Penelitian</a>
	                        <a href="{{url('search/publikasi')}}" class="btn btn-success">Publikasi</a>
	                        <a href="{{url('search/pendukung')}}" class="btn btn-info">Data Pendukung</a>
	                        <a href="{{url('search/personel')}}" class="btn btn-warning">Data Personel</a>
	                        <a href="{{url('program')}}" class="btn btn-danger">Program Pendukung</a>
	                    </div>
	                </div><!--end.imaginary-->
	            </div><!--end.col6-->
	            <div class="row vertical-center-row">
		            <div class="text-center col-md-7 col-md-offset-3">
		                <a href="#"  data-toggle="modal" data-target="#advanceForm" class="link-advance">Advance Search</a>
		            </div><!--end.col6-->
		        </div><!--end.row-->
	        </div><!--end.row-->
	    </div><!--end.container-->
	</div>

    <!-- end of middle -->
    
    <script>
	$(document).ready(function () {
		$(window).bind("load resize",function(){
			$(".intro-landing").height($(window).height()-30);	
		});
	});
	</script>

@endsection    