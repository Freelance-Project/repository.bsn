@extends('frontend.layouts.layout')

@section('content')
<!-- middle -->
<div id="middle-content">
    <div class="container">
        <div class="main-search-result">
            <ol class="breadcrumb">
              <li class="active">Search</li>
            </ol>
            {!! Form::open(['url'=>'search/find','method'=>'get']) !!} 
            <div class="row">
                <div class="col-md-6">
                    <div id="imaginary_container"> 
                        <div class="input-group stylish-input-group">
                            <input type="text" class="form-control" name="request" placeholder="Search" >
                            <span class="input-group-addon">
                                <button type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>  
                            </span>
                            <div class="info-search">
                                <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Lorem Ipsum Dolors sit amet !"></span>
                            </div>
                        </div><!--end.search--input-->
                    </div><!--end.imaginary_container-->
                </div><!--end.col-3-->
            </div><!--end.row-->
            {!! Form::close() !!}
            <div class="row search-list">
                 <hgroup class="mb20">
                    <h1>&nbsp;</h1>
                    <h2 class="lead"><strong class="text-danger">{{$data['result']->total()}}</strong> data ditemukan untuk kata kunci <strong class="text-danger">{{$data['request']}}</strong></h2>                               
                </hgroup>
                <section class="col-xs-12 col-sm-6 col-md-12">
                    @if ($data['result']->total() > 0)
                    @foreach($data['result'] as $val)
                    <article class="search-result row">
                        <div class="col-xs-12 col-sm-12 col-md-2">
                            <ul class="meta-search">
                                <li><i class="glyphicon glyphicon-tags"></i> <span><strong>{{ucfirst($val->category)}}</strong></span></li>
                                <li><i class="glyphicon glyphicon-user"></i> <span>Ovan Pulu</span></li>
                                <li><i class="glyphicon glyphicon-calendar"></i> <span>{{$val->year}}</span></li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
                            <h3><a href="{{url('search/detail/'.$val->slug)}}" title="">{{$val->title}}</a></h3>
                            <p>{!! substr($val->intro, 0, 300) !!}...</p>                       
                        </div>
                        <span class="clearfix borda"></span>
                    </article>
                    @endforeach
                    @endif
                        
                </section>
            </div><!--end.row-->
            
            <div class="row text-center">
                <div class="col-md-12">
                    <nav aria-label="Page navigation">
                      {!! with(new \App\Helper\Src\Pagination($data['result']))->render() !!}
                      
                    </nav>
                </div>
            </div><!--end.row-->
        </div>
    </div><!--end.container-->
</div>
<!-- end of middle -->

@endsection  