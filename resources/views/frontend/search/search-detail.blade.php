@extends('frontend.layouts.layout')

@section('content')
<!-- middle -->
<div id="middle-content">
  <div class="container">
      <div class="search_detail">
      <ol class="breadcrumb">
              <li><a href="#">Search</a></li>
              <li class="active">Search Detail</li>
            </ol>
             <div class="panel panel-info">
              <div class="panel-heading">
                  <h3 class="panel-title">{{$model->title}}</h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                      <div class="col-md-3 col-lg-3 " align="center"> <img  alt="User Pic" src="{{url('frontend/images/content/dokumen.png')}}" class="img-responsive"> <br><br>
                        <!--<a href="{{url('search/read/'.$model->slug)}}" class="btn btn-info">Lihat Detail</a><br><br>-->
                        </div>
                        <div class=" col-md-9 col-lg-9 "> 
                          <table class="table table-user-information">
                            <tbody>
                              <tr>
                                <td>Penulis:</td>
                                <td>Ovan</td>
                              </tr>
                              <tr>
                                <td>Tahun</td>
                                <td>{{$model->year}}</td>
                              </tr>
                              <tr>
                                <td><strong>Abstraksi</strong></td>
                                <td>{{$model->intro}}</td>
                              </tr>
                              <tr>
                                <td><strong>Kesimpulan</strong></td>
                                <td>Lorem{{$model->description}}</td>
                              </tr>
                             
                            </tbody>
                          </table>
                        </div>
                    </div><!--end.row-->
                </div><!--end.panel-body-->
             </div><!--end.panel-info-->
        </div><!--end.search-detail-->
    </div>
</div>
<!-- end of middle -->
@endsection 