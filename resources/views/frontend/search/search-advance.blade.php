@extends('frontend.layouts.layout')

@section('content')
<!-- middle -->
<div id="middle-content">
	<div class="container">
    	<div class="main-search-result">
        	<div class="row row-header">
            	<div class="col-md-4 left no-left-padding">
                	<ul class="nav nav-pills custom-pills">
                    	<li role="presentation" class="active"><a href="#">Nama Peneliti</a></li>
                    	<li role="presentation"><a href="#">Judul</a></li>
                        <li role="presentation"><a href="#">Tahun</a></li>
                    </ul>
                </div>
            	<div class="col-md-3 right">
                	<div id="imaginary_container"> 
                        <div class="input-group stylish-input-group">
                            <input type="text" class="form-control"  placeholder="Search" >
                            <span class="input-group-addon">
                                <button type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>  
                            </span>
                        </div><!--end.search--input-->
                	</div><!--end.imaginary_container-->
            	</div><!--end.col-3-->
            </div><!--end.row-->
            
            <div class="row">
            	<div class="col-md-12">
                    Range Tahun : {!! Form::select('year' , $year ,['class' => 'form-control']) !!} Sampai {!! Form::select('year' , $year ,['class' => 'form-control']) !!} 
                    <br>

                    {!! Form::checkbox('category' , null ,['class' => 'form-control']) !!} Penelitian <br>
                    {!! Form::checkbox('category' , null ,['class' => 'form-control']) !!} Publikasi <br>
                    {!! Form::checkbox('category' , null ,['class' => 'form-control']) !!} Jurnal <br>
                    {!! Form::checkbox('category' , null ,['class' => 'form-control']) !!} Prosiding <br>
                    {!! Form::checkbox('category' , null ,['class' => 'form-control']) !!} Lainnya <br>
                    {!! Form::checkbox('category' , null ,['class' => 'form-control']) !!} Data Pendukung <br>
                    {!! Form::checkbox('category' , null ,['class' => 'form-control']) !!} Export <br>
                    {!! Form::checkbox('category' , null ,['class' => 'form-control']) !!} Import <br>
                    {!! Form::checkbox('category' , null ,['class' => 'form-control']) !!} Industri <br>
                    {!! Form::checkbox('category' , null ,['class' => 'form-control']) !!} Asosiasi <br>
                </div>
            </div><!--end.row-->
            
            
            <div class="row text-center">
            	<div class="col-md-12">
                    <nav aria-label="Page navigation">
                     
                    </nav>
                </div>
            </div><!--end.row-->
        </div>
    </div><!--end.container-->
</div>
<!-- end of middle -->

@endsection 