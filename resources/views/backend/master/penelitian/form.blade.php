@extends('backend.layouts.layout')
@section('content')

<div id="app_header_shadowing"></div>
<div id="app_content">
    <div id="content_header">
        <h3 class="user"> Menu</h3>
    </div>
        <div id="content_body">
            
            <div class = 'row'>

                <div class = 'col-md-10'>

                    @include('backend.common.errors')

                    {!! Form::model($model,['files' => true]) !!} 
					                
					<div class="form-group col-md-12">
						<label>Judul</label>
                        {!! Form::text('title' , $model->title ,['class' => 'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Kelompok Bidang Penelitian</label><br>
							<?php
							if ($group) {
								foreach($group as $val) {
									$groupList[] = $val->name;
								}
								(in_array('kp', $groupList)) ? $kp = true : $kp = false;
								(in_array('mek', $groupList)) ? $mek = true : $mek = false;
								(in_array('ppk', $groupList)) ? $ppk = true : $ppk = false;
								(in_array('ls', $groupList)) ? $ls = true : $ls = false;
							}
							?>
							<div class="form-group col-md-6">
								{!!  Form::checkbox('research_groups_id[]', 'kp', $kp) !!} Kimia dan Pertambangan (KP)<br>
								{!!  Form::checkbox('research_groups_id[]', 'mek', $mek) !!} Mekanika, Elektronika dan Konstruksi (MEK)<br>
							</div>
							<div class="form-group col-md-6">
								{!!  Form::checkbox('research_groups_id[]', 'ppk', $ppk) !!} Pertanian, Pangan dan Kesehatan (PPK)<br>
								{!!  Form::checkbox('research_groups_id[]', 'ls', $ls) !!} Lingkungan dan Serbaneka (LS)<br>
							</div>
					</div>
					
					<div class="form-group col-md-12">
						<label>Kelompok Standardisasi dan Penilaian Kesesuaian</label><br>
							<?php
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
								{!!  Form::checkbox('research_standards_id[]', 'standardisasi', $standardisasi) !!} Standardisasi<br>
								{!!  Form::checkbox('research_standards_id[]', 'kesesuaian', $kesesuaian) !!} Penilaian Kesesuaian<br>
								{!!  Form::checkbox('research_standards_id[]', 'snsu', $snsu) !!} SNSU<br>
							</div>
					</div>
					
					<div class="form-group col-md-12">
						<label>Tahun Publikasi</label>
                        {!! Form::text('year' , $model->year ,['class' => 'form-control', 'required']) !!}
					</div>
					
					
					
					
					<div class="form-group col-md-12">
						<table class='table' style="border-collapse:collapse;background:#ffc" width="75%" border="1"> 
						<label>Tim Peneliti (1-10 orang)</label> 
							<tr> 
								<th>Nama Peneliti</th> 
								<th>Jabatan Peneliti</th> 
								<th>Jabatan Fungsional</th> 
								<th>Asal Instansi</th>
								<th>Kelompok Minat</th>
								<th>Bidang Kepakaran</th>
								<th>Action</th>	
							</tr> 
							<tr> 
								<td>XXX............</td>
								<td>XXX............</td> 
								<td>XXX............</td> 
								<td>XXX............</td> 
								<td>XXX............</td> 
								<td>XXX............</td> 
								<td><button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Delete' }}</button></td>
							</tr> 
						</table>
					</div>	
					
					
					<div class="form-group col-md-4">
						<label>Nama Peneliti</label>
						{!!  Form::select('penelitian_user_id',$model, null, ['class'=>'form-control']) !!}
					</div>
					
					<div class="form-group col-md-4">
						<label>Jabatan Peneliti</label>
						{!!  Form::select('jabatan_peneliti', $model, null, ['class'=>'form-control']) !!}
					</div>
					
					<div class="form-group col-md-4">
						<label>Jabatan Fungsional Peneliti</label>
						{!!  Form::select('jabatan_fungsional', $model, null, ['class'=>'form-control']) !!}
					</div>
					
					<div class="form-group col-md-4">
						<label>Asal Instansi</label>
						{!!  Form::text('instansi',$model->instansi ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-4">
						<label>Kelompok Minat</label>
						{!!  Form::select('kelompok_bidang',['kp'=>'KP', 'mek'=>'MEK', 'ppk'=>'PPK', 'ls'=>'LS'], null, ['class'=>'form-control']) !!}
					</div>
					
					<div class="form-group col-md-4">
						<label>Bidang Kepakaran</label>
						{!!  Form::text('bidang_kepakaran',$model->bidang_kepakaran ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<br>
						<button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
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
					
					<div class="form-group col-md-12">
						<label>Lokasi Survei</label>
                        {!! Form::text('location' , $model->location ,['class' => 'form-control', 'required']) !!}
					</div>
										
					<div class="form-group col-md-12">
						<table class='table' style="border-collapse:collapse;background:#ffc" width="75%" border="1"> 
						<label>Daftar Data Pendukung Penelitian</label> 
							<tr> 
								<th width="85%">Nama File</th> 
								<th width="15%">Action</th>	
							</tr> 
							<tr> 
								<td width="85%">XXX............</td>
								<td width="15%"><button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Delete' }}</button></td>
							</tr> 
						</table>
					</div>	
					
										
					<div class="form-group col-md-10">
						<label>Data Pendukung Penelitian</label>
                        {!! Form::text('ref_data_pendukung_id' , $model->ref_data_pendukung_id ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-2">
						<br>
						<button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
					</div>
					
					
					
					<div class="form-group col-md-12">
						<label>File</label>
						<div>
							<a class="Wbutton" onclick = "return browseElfinder('file'  , 'file_tempel' , 'elfinder_browse1' , 'cancelBrowse')" >Browse</a>
							Suggestion PDF Size (726,449)
						</div>
						<input type = 'hidden' name = 'file' id = 'file' />
					</div>

					{{--
					<div class="form-group col-md-6">
						<label>Publication Date</label>
						{!!  Form::text('created_at', $created_at , ['id' => 'datepicker', 'class'=>'form-control', 'required']) !!}
					</div>
					--}}
					
					<div class="form-group col-md-6">
						<label>Status</label>
						{!! Form::select('status' , ['unpublish'=>'Unpublish','publish'=>'Publish'],null ,['class' => 'form-control','id'=>'recomendation']) !!}
					</div>
					<div class="form-group col-md-12">
						<button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
						<input type ='hidden' name='category' value='penelitian'>
						
                    </div>
					
					
                    {!! Form::close() !!}

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
</script>
@endsection