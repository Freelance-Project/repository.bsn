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
                    	<div class="col-md-3 col-lg-3 " align="center"> <img  alt="User Pic" src="{{asset('contents/images/personel-thumb.png')}}" class="img-responsive"> <br><br>
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
							  <tr>
                                <td>Tanggal Lahir</td>
                                <td>{{$profile->dob}}</td>
                              </tr>
							  <tr>
                                <td>Tempat Lahir</td>
                                <td>{{$profile->birthplace}}</td>
                              </tr>
							  <tr>
                                <td>No Hp</td>
                                <td>{{$profile->phone}}</td>
                              </tr>
							  <tr>
                                <td>Email</td>
                                <td>{{$profile->email}}</td>
                              </tr>
							  <tr>
                                <td>Jabatan</td>
								<td>
								<?php
								$position = ['p_utama' => 'Peneliti Utama', 'p_madya'=>'Peneliti Madya','p_muda'=>'Peneliti Muda','p_pertama'=>'Peneliti Pertama','non_p'=>'Non Peneliti'];
								?>
								{{$position[$profile->position]}}
								</td>
                              </tr>
							  <tr>
                                <td>Golongan</td>
                                <td>{{$profile->grade}}</td>
                              </tr>
							  <tr>
                                <td>Kelompok Bidang Penelitian</td>
                                <td>
								<?php
								if($interest){
									$a = [];
									foreach ($interest as $i){
										$a[] = $i->name;
										echo $i->name . '<br>';
									}
								}
								?>
								</td>
                              </tr>
							  <tr>
                                <td>Kelompok Kepakaran</td>
                                <td>
								<?php
								if($expert){
									$a = [];
									foreach ($expert as $i){
										$a[] = $i->name;
										// echo $i->name . '<br>';
									}
									echo implode(', ', $a);
								}
								?>
								</td>
                              </tr>
                            </tbody>
                          </table>
						  <div class="table-responsive">
                            <label class="mid-title">Daftar Diklat/Seminar :</label>
                            <table class="table table-striped">
                                <thead> 
                                    <tr>
                                        <th>No</th>
                                          <th>Judul</th>
                                          <th>Waktu Pelaksanaan</th>
                                          <th>Nama Penyelenggara dan Tempat</th>
                                          <th>Sertifikat</th>
                                      </tr>
                                  </thead>
                                  <tbody class="text-left">
                                      @if ($workshop)
                                      @foreach($workshop as $key => $val)
										@if ($val->type == 'seminar')
                                      <tr>
                                        <td>{{$key+1}}</td>
                                          <td>{{$val->name }} </td>
                                          <td>{{$val->start_date}} s/d {{$val->end_date}}</td>
                                          <td>{{$val->organizer}}</td>
                                          <td>@if($val->sertificate == 'y') Ya @else Tidak @endif</td>
                                      </tr>
										@endif
                                      @endforeach
                                      @endif
                                  </tbody>
                              </table>
                          </div>
						  <div class="table-responsive">
                            <label class="mid-title">Daftar Training/Diklat :</label>
                            <table class="table table-striped">
                                <thead> 
                                    <tr>
                                        <th>No</th>
                                          <th>Judul</th>
                                          <th>Waktu Pelaksanaan</th>
                                          <th>Nama Penyelenggara dan Tempat</th>
                                          <th>Sertifikat</th>
                                      </tr>
                                  </thead>
                                  <tbody class="text-left">
                                      @if ($workshop)
                                      @foreach($workshop as $key => $val)
										@if ($val->type == 'training')
                                      <tr>
                                        <td>{{$key+1}}</td>
                                          <td>{{$val->name }} </td>
                                          <td>{{$val->start_date}} s/d {{$val->end_date}}</td>
                                          <td>{{$val->organizer}}</td>
                                          <td>@if($val->sertificate == 'y') Ya @else Tidak @endif</td>
                                      </tr>
										@endif
                                      @endforeach
                                      @endif
                                  </tbody>
                              </table>
                          </div>
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