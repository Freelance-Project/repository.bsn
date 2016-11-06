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
						<label>Judul</label>
                        {!! Form::text('title' , $model->title ,['class' => 'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>Kelompok Bidang Penelitian</label><br>
							<?php
							$kp = false;
							$mek = false;
							$ppk = false;
							$ls = false;

							if ($group) {
								$groupList=[];
								foreach($group as $val) {
									$groupList[] = $val->name;
								}
								(in_array('kp', $groupList)) ? $kp = true : $kp = false;
								(in_array('mek', $groupList)) ? $mek = true : $mek = false;
								(in_array('ppk', $groupList)) ? $ppk = true : $ppk = false;
								(in_array('ls', $groupList)) ? $ls = true : $ls = false;
							}
							?>

							<div class="form-group ">
								{!!  Form::checkbox('research_groups_id[]', 'kp', $kp) !!} Kimia dan Pertambangan (KP)<br>
								{!!  Form::checkbox('research_groups_id[]', 'mek', $mek) !!} Mekanika, Elektronika dan Konstruksi (MEK)<br>
							
								{!!  Form::checkbox('research_groups_id[]', 'ppk', $ppk) !!} Pertanian, Pangan dan Kesehatan (PPK)<br>
								{!!  Form::checkbox('research_groups_id[]', 'ls', $ls) !!} Lingkungan dan Serbaneka (LS)<br>

							</div>
					</div>
					
					<div class="form-group col-md-6">
						<label>Kelompok Standardisasi dan Penilaian Kesesuaian</label><br>
							<?php
							$standardisasi = false;
							$kesesuaian = false;
							$snsu = false;

							if ($standard) {
								$standardList = [];
								foreach($standard as $val) {
									$standardList[] = $val->name;
								}
								(in_array('standardisasi', $standardList)) ? $standardisasi = true : $standardisasi = false;
								(in_array('kesesuaian', $standardList)) ? $kesesuaian = true : $kesesuaian = false;
								(in_array('snsu', $standardList)) ? $snsu = true : $snsu = false;
							}
							?>
							<div class="form-group col-md-12">
								{!!  Form::checkbox('research_standards_id[]', 'standardisasi', isset($standardisasi) ? $standardisasi : null) !!} Standardisasi<br>
								{!!  Form::checkbox('research_standards_id[]', 'kesesuaian', isset($kesesuaian) ? $kesesuaian : null) !!} Penilaian Kesesuaian<br>
								{!!  Form::checkbox('research_standards_id[]', 'snsu', isset($snsu) ? $snsu : null) !!} SNSU<br>
							</div>
					</div>
					
					
					<div class="form-group col-md-12">

                        <label>Ringkasan Eksekutif</label>
                        {!! Form::textarea('intro' , $model->intro ,['class' => 'form-control','id'=>'intro', 'required']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Latar Belakang</label>
						{!! Form::textarea('background' , $model->background ,['class' => 'form-control','id'=>'background', 'required']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Tujuan</label>
						{!! Form::textarea('goal' , $model->goal ,['class' => 'form-control','id'=>'goal', 'required']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Kesimpulan</label>
						{!! Form::textarea('conclusion' , $model->conclusion ,['class' => 'form-control','id'=>'conclusion', 'required']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Rekomendasi</label>
						{!! Form::textarea('recommendation' , $model->recommendation ,['class' => 'form-control','id'=>'recommendation', 'required']) !!}
					</div>
					
					<div class="form-group col-md-12">	
						<label>Target Rekomendasi</label>
						{!! Form::textarea('recommendation_target' , $model->recommendation_target ,['class' => 'form-control','id'=>'recommendation_target', 'required']) !!}
					</div>
					<div class="form-group col-md-6">
						<label>Tahun Publikasi</label>
                        {!! Form::text('year' , $model->year ,['class' => 'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>Lokasi Survei</label>
                        {!! Form::text('location' , $model->location ,['class' => 'form-control', 'required']) !!}
					</div>
					<div class="form-group col-md-12">
						<label>File</label>
						<div>
							<a class="Wbutton" onclick = "return browseElfinder('file'  , 'file_tempel' , 'elfinder_browse1' , 'cancelBrowse')" >Browse</a>
							Suggestion PDF Size (726,449)
						</div>
						<input type = 'hidden' name = 'file' id = 'file' />
					</div>

					<div class="form-group col-md-6">

						<label>Status</label>
						{!! Form::select('status' , ['unpublish'=>'Unpublish','publish'=>'Publish'],null ,['class' => 'form-control','id'=>'recomendation']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
						<input type ='hidden' name='category' value='penelitian'>
						
                    </div>

					{!! Form::close() !!}

					@if($new)
					<div class="form-group col-md-12">
						<table class='table researcher-table' style="border-collapse:collapse;background:#ffc" width="75%" border="1"> 
						<label>Tim Peneliti (1-10 orang)</label> 
							<tr> 
								<th>Nama Peneliti</th> 
								<th>Jabatan Peneliti</th> 
								<th>Jabatan Fungsional</th> 
								<th>Asal Instansi</th> 
								<th>Action</th>	
							</tr> 
							@if($researcherTeam)
							@foreach($researcherTeam as $val) 
							<tr class="researcher-data-{{$val->id}}"> 
								<td>{{$val->researcher->name}}</td> 
								<td>{{$val->position}}</td> 
								<td>{{$val->functional}}</td> 
								<td>{{$val->instance}}</td> 
								<td><a href="javascript:void(0)" class="btn btn-danger delete-researcher" data-id="{{$val->id}}">Hapus</a></td> 
							</tr>	
							@endforeach
							@endif
						</table>
					</div>	
					
					
					<div class="form-group col-md-3">
						<label>Nama Peneliti</label>
						{!!  Form::select('penelitian_user_id',$researcher, null, ['class'=>'form-control r_id']) !!}
					</div>
					
					<div class="form-group col-md-2">
						<label>Jabatan Peneliti</label>
						{!!  Form::select('jabatan_peneliti', $position, null, ['class'=>'form-control r_position']) !!}
					</div>
					
					<div class="form-group col-md-3">
						<label>Jabatan Fungsional Peneliti</label>
						{!!  Form::select('jabatan_fungsional', $functional, null, ['class'=>'form-control r_functional']) !!}
					</div>
					
					<div class="form-group col-md-3">
						<label>Asal Instansi</label>
						{!!  Form::text('instansi',null ,['class' => 'form-control r_instance']) !!}
					</div>
					<div class="form-group col-md-1">
						<label>Action</label>
						<button type="button" class="btn btn-primary save-researcher">{{ !empty($model->id) ? 'Save' : 'Save' }}</button>
					</div>
					

					<div class="form-group col-md-12">
						<table class='table additional-table' style="border-collapse:collapse;background:#ffc" width="75%" border="1"> 
						<label>Daftar Data Pendukung Penelitian</label> 
							<tr> 
								<th width="85%">File</th> 
								<th width="15%">Action</th>	
							</tr> 
							@if($additionalDataList)
							@foreach($additionalDataList as $val) 
							<tr class="additional-data-{{$val->id}}"> 
								<td>{{$val->additional->title}}</td> 
								<td><a href="javascript:void(0)" class="btn btn-danger delete-additional-data" data-id="{{$val->id}}">Hapus</a></td> 
							</tr>	
							@endforeach
							@endif
						</table>
					</div>	
					
										
					<div class="form-group col-md-10">
						<label>Data Pendukung Penelitian</label>
                        {!! Form::select('ref_data_pendukung_id' , $additionalData ,null, ['class' => 'form-control a_id']) !!}
					</div>
					
					<div class="form-group col-md-2">
						<label>Action</label>
						<button type="button" class="btn btn-primary save-additional form-control">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
					</div>
					
					
					@endif
					{!! Form::hidden('p_id' , $model->id ,['class' => 'form-control p_id']) !!}
					
                    

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

  	$(document).on('click', '.save-researcher', function(){

  		var researcher_id = $('.r_id').val();
	  	var position = $('.r_position').val();
	  	var functional = $('.r_functional').val();
	  	var instance = $('.r_instance').val();
	  	var other_id = $('.p_id').val();
	  	
	  	$.ajax({
			type : 'get',
			url : basedomain +'/data-penelitian/researcher',
			data : {
				researcher_id : researcher_id,
				position : position,
				functional : functional,
				instance : instance,
				other_id : other_id,
			},
			success : function(data){

				if (data.status == true) {
					var html = "";
						html += "<tr class='researcher-data-"+data.data.id+"'>";
						html += "<td>"+data.data.researcher.name+"</td>";
						html += "<td>"+data.data.position+"</td>";
						html += "<td>"+data.data.functional+"</td>";
						html += "<td>"+data.data.instance+"</td>";
						html += '<td><a href="javascript:void(0)" class="btn btn-danger delete-researcher" data-id="'+data.data.id+'">Hapus</a></td>';
						html += "</tr>";

					$('.researcher-table').append(html);
				}
				
			},
		});

	})

	$(document).on('click', '.delete-researcher', function(){
		var r = confirm("Hapus Data ?");
		if (r == true) {
		    var id = $(this).attr('data-id');
			$.ajax({
				type : 'get',
				url : basedomain +'/data-penelitian/delete-researcher',
				data : {
					id : id,
				},
				success : function(data){
					if (data.status == true) {
						$('.researcher-data-'+id).remove();
					}
				},
			});
		} else {
		    return false;
		}
		
	})

	$(document).on('click', '.save-additional', function(){

  		var a_id = $('.a_id').val();
  		var other_id = $('.p_id').val();
	  	console.log(a_id);
	  	$.ajax({
			type : 'get',
			url : basedomain +'/data-penelitian/additional-data',
			data : {
				id : a_id,
				other_id : other_id,
			},
			success : function(data){

				if (data.status == true) {
					var html = "";
						html += "<tr class='additional-data-"+data.data.id+"'>";
						html += "<td>"+data.data.additional.title+"</td>";
						html += '<td><a href="javascript:void(0)" class="btn btn-danger delete-additional-data" data-id="'+data.data.id+'">Hapus</a></td>';
						html += "</tr>";

					$('.additional-table').append(html);
				}
				
			},
		});

	})
	
	$(document).on('click', '.delete-additional-data', function(){
		var r = confirm("Hapus Data ?");
		if (r == true) {
		    var id = $(this).attr('data-id');
			$.ajax({
				type : 'get',
				url : basedomain +'/data-penelitian/delete-additional-data',
				data : {
					id : id,
				},
				success : function(data){
					if (data.status == true) {
						$('.additional-data-'+id).remove();
					}
				},
			});
		} else {
		    return false;
		}
		
	})

</script>
@endsection