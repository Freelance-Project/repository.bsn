@extends('frontend.layouts.layout')

@section('content')
<!-- middle -->
<div id="middle-content">
	<div class="container">
    	<div class="profile_page">
             <div class="panel panel-info">
             	<div class="panel-heading">
                  <h3 class="panel-title"></h3>
                </div>
                <div class="panel-body">
                	<div class="row">
                    	<div class="col-md-3 col-lg-3 " align="center"> <img  alt="User Pic" src="{{asset('contents/images/personel-thumb.jpg')}}" class="img-responsive"> <br><br>
                      <button class="btn"><a target="_blank" href="{{url('personel/cv/'. $profile->id . '/' .$profile->cv)}}">Download CV</a></button>
                      </div>
                        <div class=" col-md-9 col-lg-9 "> 
                          <table class="table table-user-information">
                            <tbody>
                              <tr>
                                <td>Nama</td>
                                <td>{{$profile->name}}</td>
                              </tr>
                              <tr>
                                <td>Alamat</td>
                                <td>{{$profile->address}}</td>
                              </tr>
                              <tr>
                                <td>Pendidikan</td>
                                <td>{{$profile->education}}</td>
                              </tr>
                              <tr>
                                <td>Pengalaman</td>
                                <td>{{$profile->experience}}</td>
                              </tr>
                            </tbody>
                          </table>
                          <div class="table-responsive">
                            <label class="mid-title">Daftar Penelitian :</label>
                            <table class="table table-striped">
                                <thead> 
                                    <tr>
                                        <th>No</th>
                                          <th>Judul</th>
                                          <th>Posisi</th>
                                      </tr>
                                  </thead>
                                  <tbody class="text-left">
                                      @if ($research)
                                      @foreach($research as $key => $val)
                                      <tr>
                                        <td>{{$key+1}}</td>
                                          <td><a href="{{url('search/detail/'. $val->research->article->slug)}}">{{$val->research->title }} </a></td>
                                          <td>{{$val->position}}</td>
                                      </tr>
                                      @endforeach
                                      @endif
                                  </tbody>
                              </table>
                          </div>
                          <div class="table-responsive">
                            <label class="mid-title">Daftar Publikasi :</label>
                            <table class="table table-striped">
                                <thead> 
                                    <tr>
                                        <th>No</th>
                                          <th>Judul</th>
                                          <th>Posisi</th>
                                      </tr>
                                  </thead>
                                  <tbody class="text-left">
                                      @if ($publication)
                                      @foreach($publication as $key => $val)
                                      <tr>
                                        <td>{{$key+1}}</td>
                                          <td><a href="{{url('search/detail/'. $val->publication->article->slug)}}">{{$val->publication->title}} </a></td>
                                          <td>{{$val->position}}</td>
                                      </tr>
                                      @endforeach
                                      @endif
                                  </tbody>
                              </table>
                          </div>
                          	<!--<a href="#" class="btn btn-primary">Edit Profile</a>-->
                        </div>
                    </div><!--end.row-->
                </div><!--end.panel-body-->
             </div><!--end.panel-info-->
        </div><!--end.search-detail-->
    </div>
</div>
<!-- end of middle -->

@endsection  