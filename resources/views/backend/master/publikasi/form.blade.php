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
							<div class="form-group col-md-6">
								{!!  Form::checkbox('research_groups_id[]', 'kp', isset($kp) ? $kp : null) !!} Kimia dan Pertambangan (KP)<br>
								{!!  Form::checkbox('research_groups_id[]', 'mek', isset($mek) ? $mek : null) !!} Mekanika, Elektronika dan Konstruksi (MEK)<br>
							</div>
							<div class="form-group col-md-6">
								{!!  Form::checkbox('research_groups_id[]', 'ppk', isset($ppk) ? $ppk : null) !!} Pertanian, Pangan dan Kesehatan (PPK)<br>
								{!!  Form::checkbox('research_groups_id[]', 'ls', isset($ls) ? $ls : null) !!} Lingkungan dan Serbaneka (LS)<br>
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
								{!!  Form::checkbox('research_standards_id[]', 'standardisasi', isset($standardisasi) ? $standardisasi : null) !!} Standardisasi<br>
								{!!  Form::checkbox('research_standards_id[]', 'kesesuaian', isset($kesesuaian) ? $kesesuaian : null) !!} Penilaian Kesesuaian<br>
								{!!  Form::checkbox('research_standards_id[]', 'snsu', isset($snsu) ? $snsu : null) !!} SNSU<br>
							</div>
					</div>
					
					<div class="form-group col-md-6">
						<label>Kategori Publikasi</label>
						{!!  Form::select('category',['jurnal'=>'Jurnal', 'prosiding'=>'Prosiding', 'lainnya'=>'Lainnya'], null, ['class'=>'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>Tahun Publikasi</label>
                        {!! Form::text('year' , $model->year ,['class' => 'form-control', 'required']) !!}
					</div>	
					
					<div class="form-group col-md-12">
						<label>Volume/ Edisi Publikasi</label>
                        {!! Form::text('volume' , $model->volume ,['class' => 'form-control', 'required']) !!}
					</div>	
					
					<div class="form-group col-md-12">
						<table class='table' style="border-collapse:collapse;background:#ffc" width="75%" border="1"> 
						<label>Tim Penulis (1–5 orang)</label> 
							<tr> 
								<th>Nama Penulis</th> 
								<th>Jabatan Penulis</th>  
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
								<td><button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Delete' }}</button></td>
							</tr> 
						</table>
					</div>
					
					
					{{--
					<div class="form-group col-md-4">
					<label>Nama Penulis</label>
						{!!  Form::select('user_id',[1=>1], null, ['class'=>'form-control']) !!}
					</div>
					
					<div class="form-group col-md-4">
						<label>Jabatan Penulis</label>
						{!!  Form::select('penulis',['penulis1'=>'Penulis 1', 'penulis2'=>'Penulis 2', 'penulis3'=>'Penulis 3', 'penulis4'=>'Penulis 4', 'penulis5'=>'Penulis 5'], null, ['class'=>'form-control']) !!}
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
						{!!  Form::text('bidang_kepakaran',$model->bidang_kepakaran ,['class' => 'form-control',]) !!}
					</div>
					
					<div class="form-group col-md-4">
						<br>
						<button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
					</div>
					--}}
					
					
					<div class="form-group col-md-12">
                        <label>Abstrak</label>
                        {!! Form::textarea('intro' , $model->intro ,['class' => 'form-control','id'=>'intro', 'required']) !!}
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
						<table class='table' style="border-collapse:collapse;background:#ffc" width="75%" border="1"> 
						<label>Daftar Data Pendukung Publikasi</label> 
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
					

					{{--
					<div class="form-group col-md-10">
						<label>Data Pendukung Publikasi</label>
                        {!! Form::text('ref_data_pendukung_id' , $model->ref_data_pendukung_id ,['class' => 'form-control']) !!}
					</div>
					--}}
					
					
					<div class="form-group col-md-2">
						<br>
						<button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
					</div>
					
					<div class="form-group col-md-12">
						<label>File</label>
						<div>
							<a class="Wbutton" onclick = "return browseElfinder('filename'  , 'file_tempel' , 'elfinder_browse1' , 'cancelBrowse')" >Browse</a>
							Suggestion PDF Size (726,449)
						</div>
						<input type = 'hidden' name = 'filename' id = 'filename' />
					</div>
					
					<div class="form-group col-md-12">
						<label>Status</label>
						{!! Form::select('status' , ['unpublish'=>'Unpublish','publish'=>'Publish'],null ,['class' => 'form-control','id'=>'recomendation']) !!}
					</div>
                    
					<div class="form-group col-md-12">
						<button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
						<input type ='hidden' name='category_article' value='publikasi'>
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
		CKEDITOR.replace( 'description',{
		filebrowserBrowseUrl: '{{ urlBackend("image/lib")}}'});
		
  }
</script>
@endsection