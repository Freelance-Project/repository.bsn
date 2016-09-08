@extends('frontend.layouts.layout')

@section('content')
    <!-- middle -->

    <div id="middle-content" class="intro-landing">
		<div class="container container-table">
	    	<div class="row vertical-center-row">
	            <div class="text-center col-md-6 col-md-offset-3">
	                <div id="imaginary_container">
	                	<form action="{{url('search')}}"> 
	                    <div class="input-group stylish-input-group">
	                    	
	                        <input type="text" class="form-control"  placeholder="Search" >
	                        <span class="input-group-addon">
	                            <button type="submit">
	                                <span class="glyphicon glyphicon-search"></span>
	                            </button>  
	                        </span>
	                       
	                    </div><!--end.search--input-->
	                     </form>
	                    <div class="cat-search text-center">
	                    	<a href="{{url('search/category')}}" class="btn btn-primary">Penelitian</a>
	                        <a href="{{url('search/category')}}" class="btn btn-success">Publikasi</a>
	                        <a href="{{url('search/category')}}" class="btn btn-info">Data Pendukung</a>
	                        <a href="{{url('search/category')}}" class="btn btn-warning">Data Personel</a>
	                        <!--a href="search_result.php" class="btn btn-danger">Program Pendukung</a-->
	                    </div>
	                </div><!--end.imaginary-->
	            </div><!--end.col6-->
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