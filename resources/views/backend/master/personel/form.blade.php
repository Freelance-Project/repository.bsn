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
						<label>Daftar Diklat/Training dan Workshop/Seminar</label> 
							<tr> 
								<th>Category</th> 
								<th>Nama Diklat atau Workshop</th> 
								<th>Waktu Mulai</th> 
								<th>Waktu Selesai</th> 
								<th>Penyelenggara dan Tempat</th> 
								<th>Sertifikat</th> 
								<th>Action</th> 
							</tr> 
							@if($diklat)
							@foreach($diklat as $val) 
							<tr class="diklat-data-{{$val->id}}"> 
								<td>{{ucfirst($val->type)}}</td> 
								<td>{{$val->name}}</td> 
								<td>{{$val->start_date}}</td> 
								<td>{{$val->end_date}}</td> 
								<td>{{$val->organizer}}</td> 
								<td>@if($val->sertificate == 'y') Ya @else Tidak @endif</td> 
								<td><a href="javascript:void(0)" class="btn btn-danger delete-diklat" data-id="{{$val->id}}">Delete</a></td> 
							</tr>	
							@endforeach
							@endif
						</table>
					</div>	
					<div class="form-group col-md-3">
						<label>Category</label>
                        {!! Form::select('category' , ['Training'=>'Diklat/Training','Seminar'=>'Workshop/Seminar'] , null, ['class' => 'dik_kategori form-control']) !!}
					</div>
					<div class="form-group col-md-3">
						<label>Nama Diklat atau Workshop</label>
                        {!! Form::text('name' , null ,['class' => 'form-control dik_nama']) !!}
					</div>
					
					<div class="form-group col-md-3">
						<label>Tanggal Mulai Pelaksanaan</label>
                        {!!  Form::text('waktu_pelaksanaan', null , ['id' => 'datepicker1', 'class'=>'dik_waktu_start form-control']) !!}
					</div>
					<div class="form-group col-md-3">
						<label>Tanggal Akhir Pelaksanaan</label>
                        {!!  Form::text('waktu_pelaksanaan', null , ['id' => 'datepicker2', 'class'=>'dik_waktu_end form-control']) !!}
					</div>
					<div class="form-group col-md-3">
						<label>Nama Penyelenggara dan Tempat</label>
                        {!! Form::text('nameplace' , null ,['class' => 'dik_peny form-control']) !!}
					</div>
					
					<div class="form-group col-md-3">
						<label>Sertifikat</label>
                        {!! Form::select('sertifikat' , ['y'=>'Ya','t'=>'Tidak'] , null, ['class' => 'dik_sertifikat form-control']) !!}
                    </div>
					
					<div class="form-group col-md-1">
						<label>Action</label>
						<button type="button" class="save_diklat btn btn-primary form-control">{{ !empty($model->id) ? 'Save' : 'Save' }}</button>
                    </div>
					
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
	  	var waktu_start = $('.dik_waktu_start').val();
	  	var waktu_end = $('.dik_waktu_end').val();
	  	var penyelenggara = $('.dik_peny').val();
	  	var sertifikat = $('.dik_sertifikat').val();
	  	var kategori = $('.dik_kategori').val();
	  	var personel_id = $('.personel_id').val();

	  	$.ajax({
			type : 'get',
			url : basedomain +'/data-personel/diklat',
			data : {
				nama : nama,
				waktu_start : waktu_start,
				waktu_end : waktu_end,
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
						html += "<td>"+data.data.start_date+"</td>";
						html += "<td>"+data.data.end_date+"</td>";
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