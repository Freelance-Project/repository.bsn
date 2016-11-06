@extends('backend.layouts.layout')
@section('content')

<div id="app_header_shadowing"></div>
<div id="app_content">
    <div id="content_header">
        <h3 class="user"> Menu</h3>
    </div>
        <div id="content_body">
            
            <div class = 'row'>

                <div class = 'col-md-12'>

                    @include('backend.common.errors')

                    {!! Form::model($model,['files' => true]) !!} 
					
					<div class="form-group col-md-12">
						<label>Nama</label>
                        {!! Form::text('name' , $model->name ,['class' => 'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>Tempat Lahir</label>
                        {!! Form::text('birthplace' , $model->birthplace ,['class' => 'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>Tanggal Lahir</label>
						{!!  Form::text('dob', $model->dob , ['id' => 'datepicker', 'class'=>'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>Jabatan</label>
						{!!  Form::select('position', ['p_utama'=>'Peneliti Utama','p_madya'=>'Peneliti Madya','p_muda'=>'Peneliti Muda','p_pertama'=>'Peneliti Pertama','non_p'=>'Non Peneliti'], null, ['class'=>'form-control', 'required']) !!}
					</div>
											
					<div class="form-group col-md-6">
						<label>Golongan</label>
                        {!! Form::text('grade' , $model->grade ,['class' => 'form-control', 'required']) !!}
					</div>
										
					<div class="form-group col-md-6">
						<label>Kelompok Bidang Penelitian</label><br>
						<?php
						$interestCat = [];
						if ($model->interest_category) {
							$interestCat = explode(',', $model->interest_category);
						}
						
						?>
							@foreach($interest as $key => $val)
							<?php 
							if (in_array($key, $interestCat)) $select = true;
							else $select = false;
							?>
							{!!  Form::checkbox('research_groups_id[]', $key, $select) !!} {{$val}}<br>
							@endforeach
					</div>
					
					<div class="form-group col-md-6">
						<label>Kelompok Kepakaran</label><br>
						<?php
						$expertCat = [];
						if ($model->expert_category) {
							$expertCat = explode(',', $model->expert_category);
						}
						?>
							@foreach($expertise as $key => $val)
							<?php 
							if (in_array($key, $expertCat)) $select = true;
							else $select = false;
							?>
							{!!  Form::checkbox('expert_category_id[]', $key, $select) !!} {{$val}}<br>
							@endforeach
					</div>
					
					<div class="form-group col-md-12">
						<label>Alamat</label>
                        {!! Form::text('address' , null ,['class' => 'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>No. Handphone</label>
                        {!! Form::text('phone' , null ,['class' => 'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>Email</label>
                        {!! Form::text('email' , null ,['class' => 'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Pendidikan (Perguruan Tinggi)</label>
                        {!! Form::text('education' , null ,['class' => 'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Pengalaman Kerja</label>
						{!! Form::textarea('experience' , null ,['class' => 'form-control','id'=>'experience', 'required']) !!}
					</div>	
					<div class="form-group col-md-6">
						<label>Status</label>
						{!! Form::select('status' , ['unpublish'=>'Unpublish','publish'=>'Publish'],null ,['class' => 'form-control','id'=>'recomendation']) !!}
					</div>
				</div>
				<div class="form-group col-md-12">
					<button type="submit" class="btn btn-primary ">{{ !empty($model->id) ? 'Update Biodata' : 'Save Biodata' }}</button>
                </div>
				
				{!! Form::close() !!}

				@if($new)
				<div class="col-md-12">	
					<div class="form-group">
						<table  class='table diklat-table' style="border-collapse:collapse;background:#ffc" width="75%" border="1"> 
						<label>Daftar Diklat/Training</label> 
							<tr> 
								<th>Category</th> 
								<th>Nama Diklat</th> 
								<th>Waktu</th> 
								<th>Penyelenggara</th> 
								<th>Sertifikat</th> 
								<th>Action</th> 
							</tr> 
							@if($diklat)
							@foreach($diklat as $val) 
							<tr class="diklat-data-{{$val->id}}"> 
								<td>{{ucfirst($val->type)}}</td> 
								<td>{{$val->name}}</td> 
								<td>{{$val->time}}</td> 
								<td>{{$val->organizer}}</td> 
								<td>@if($val->sertificate == 'y') Ya @else Tidak @endif</td> 
								<td><a href="javascript:void(0)" class="btn btn-danger delete-diklat" data-id="{{$val->id}}">Hapus</a></td> 
							</tr>	
							@endforeach
							@endif
						</table>
					</div>	
					<div class="form-group col-md-2">
						<label>Category</label>
                        {!! Form::select('category' , ['training'=>'Diklat','seminar'=>'Seminar'] , null, ['class' => 'dik_kategori form-control']) !!}
					</div>
					<div class="form-group col-md-2">
						<label>Nama Diklat/Training</label>
                        {!! Form::text('name' , null ,['class' => 'form-control dik_nama']) !!}
					</div>
					
					<div class="form-group col-md-3">
						<label>Tanggal Pelaksanaan</label>
                        {!!  Form::text('waktu_pelaksanaan', null , ['id' => 'datepicker1', 'class'=>'dik_waktu form-control']) !!}
					</div>
					
					<div class="form-group col-md-3">
						<label>Nama Penyelenggara dan Tempat</label>
                        {!! Form::text('nameplace' , null ,['class' => 'dik_peny form-control']) !!}
					</div>
					
					<div class="form-group col-md-1">
						<label>Sertifikat</label>
                        {!! Form::select('sertifikat' , ['y'=>'Ya','t'=>'Tidak'] , null, ['class' => 'dik_sertifikat form-control']) !!}
                    </div>
					
					<div class="form-group col-md-1">
						<label>Action</label>
						<button type="button" class="save_diklat btn btn-primary">{{ !empty($model->id) ? 'Save' : 'Save' }}</button>
                    </div>
					{{--
					<div class="form-group col-md-12">
						<table  class='table' style="border-collapse:collapse;background:#ffc" width="75%" border="1"> 
						<label>Daftar Hasil Penelitian</label> 
							<tr> 
								<th>Judul Penelitian</th> 
								<th>Tahun Penelitian</th> 
							</tr> 
							<tr> 
								<td>Penelitian 1............</td> 
								<td>Tahun YYYY</td> 
							</tr> 
						</table>
					</div>				
					<div class="form-group col-md-3">
						<label>Judul Penelitian</label>
                        {!! Form::text('nameplace' , null ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-1">
						<label>Tahun</label>
                        {!! Form::text('tahun' , null, ['class' => 'form-control']) !!}
                    </div>
					
					<div class="form-group col-md-1">
						<label>Action</label>
						<button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
                    </div>

					<div class="form-group col-md-12">
						<table  class='table' style="border-collapse:collapse;background:#ffc" width="75%" border="1"> 
						<label>Daftar Hasil Publikasi</label> 
							<tr> 
								<th>Judul Karya Tulis Ilmiah</th> 
								<th>Nama Publikasi</th> 
								<th>Volume/ Edisi Publikasi</th> 
								<th>Tahun Publikasi</th> 
							</tr> 
							<tr> 
								<td>Publikasi 1............</td> 
								<td>Nama 1.............</td>
								<td>Volume 1.............</td> 
								<td>Tahun YYYY</td> 
							</tr> 
						</table>
					</div>
					
					<div class="form-group col-md-2">
						<label>Judul Karya tulis</label>
                        {!! Form::text('name' , null ,['class' => 'pub_judul form-control']) !!}
					</div>
					
					<div class="form-group col-md-3">
						<label>Nama Publikasi</label>
                        {!!  Form::text('waktu_pelaksanaan', null , ['class'=>'pub_nama form-control']) !!}
					</div>
					
					<div class="form-group col-md-3">
						<label>Volume</label>
                        {!! Form::text('nameplace' , null ,['class' => 'pub_volume form-control']) !!}
					</div>
					
					<div class="form-group col-md-2">
						<label>Tahun Publikasi</label>
                        {!! Form::text('sertifikat' , null, ['class' => 'pub_tahun form-control']) !!}
                    </div>
					
					<div class="form-group col-md-1">
						<label>Action</label>
						<button type="button" class="btn btn-primary save_publikasi">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
                    </div>
                    --}}
                    {!! Form::hidden('id' , $model->id, ['class' => 'personel_id form-control']) !!}
                </div>
                @endif
            </div>

        </div>
    </div>
	@include('backend.popElfinder');
@endsection
@section('script')
<script type="text/javascript">
  
	window.onload = function(){
		CKEDITOR.replace( 'description',{
		filebrowserBrowseUrl: '{{ urlBackend("image/lib")}}'});
			
	}

	$(document).on('click', '.save_diklat', function(){
	  	var nama = $('.dik_nama').val();
	  	var waktu = $('.dik_waktu').val();
	  	var penyelenggara = $('.dik_peny').val();
	  	var sertifikat = $('.dik_sertifikat').val();
	  	var kategori = $('.dik_kategori').val();
	  	var personel_id = $('.personel_id').val();

	  	$.ajax({
			type : 'get',
			url : basedomain +'/data-personel/diklat',
			data : {
				nama : nama,
				waktu : waktu,
				penyelenggara : penyelenggara,
				sertifikat : sertifikat,
				kategori : kategori,
				personel_id : personel_id,
			},
			success : function(data){

				if (data.status == true) {
					var html = "";
						html += "<tr class=diklat-data-"+data.data.id+">";
						html += "<td>"+data.data.type+"</td>";
						html += "<td>"+data.data.name+"</td>";
						html += "<td>"+data.data.time+"</td>";
						html += "<td>"+data.data.organizer+"</td>";
						if (data.data.sertificate == 't') {
						html += "<td>Tidak</td>";
						} else {
						html += "<td>Ya</td>";
						}
						html += '<td><a href="javascript:void(0)" class="btn btn-danger delete-diklat" data-id="'+data.data.id+'">Hapus</a></td>';
						html += "</tr>";

					$('.diklat-table').append(html);
				}
				
			},
		});

	})

	$(document).on('click', '.delete-diklat', function(){
		var r = confirm("Hapus Data ?");
		if (r == true) {
		    var id = $(this).attr('data-id');
			$.ajax({
				type : 'get',
				url : basedomain +'/data-personel/delete-diklat',
				data : {
					id : id,
				},
				success : function(data){
					if (data.status == true) {
						$('.diklat-data-'+id).remove();
					}
				},
			});
		} else {
		    return false;
		}
		
	})
</script>
@endsection