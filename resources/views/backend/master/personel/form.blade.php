@extends('backend.layouts.layout')
@section('content')

<div id="app_header_shadowing"></div>
<div id="app_content">
    <div id="content_header">
        <h3 class="user"> Menu</h3>
    </div>
        <div id="content_body">
            
            <div class = 'row'>

                <div class = 'col-md-8'>

                    @include('backend.common.errors')

                    {!! Form::model($model,['files' => true]) !!} 
					
					<div class="form-group col-md-12">
						<label>Nama</label>
                        {!! Form::text('name' , $model->name ,['class' => 'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>Tempat Lahir</label>
                        {!! Form::text('tempat_lahir' , $model->tempat_lahir ,['class' => 'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>Tanggal Lahir</label>
						{!!  Form::text('datebirth', null , ['id' => 'datepicker', 'class'=>'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>Jabatan</label>
						{!!  Form::select('jabatan', $model, null, ['class'=>'form-control', 'required']) !!}
					</div>
											
					<div class="form-group col-md-6">
						<label>Golongan</label>
                        {!! Form::text('golongan' , $model->golongan ,['class' => 'form-control', 'required']) !!}
					</div>
										
					<div class="form-group col-md-12">
						<label>Kelompok Bidang Penelitian</label><br>
							<div class="form-group col-md-6">
								{!!  Form::checkbox('ref_kelompok_penelitian_id', null) !!} Kimia dan Pertambangan (KP)<br>
								{!!  Form::checkbox('ref_kelompok_penelitian_id', null) !!} Mekanika, Elektronika dan Konstruksi (MEK)<br>
							</div>
							<div class="form-group col-md-6">
								{!!  Form::checkbox('ref_kelompok_penelitian_id', null) !!} Pertanian, Pangan dan Kesehatan (PPK)<br>
								{!!  Form::checkbox('ref_kelompok_penelitian_id', null) !!} Lingkungan dan Serbaneka (LS)<br>
							</div>
					</div>
					
					<div class="form-group col-md-12">
						<label>Kelompok Kepakaran</label><br>
								{!!  Form::checkbox('ref_kelompok_kepakaran_id', null , false) !!} Mekanika<br>
								Lainnya {!!  Form::text('ref_kelompok_kepakaran_id_lain', null) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Alamat</label>
                        {!! Form::text('address' , $model->address ,['class' => 'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>No. Handphone</label>
                        {!! Form::text('nohp' , $model->nohp ,['class' => 'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>Email</label>
                        {!! Form::text('email' , $model->email ,['class' => 'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Pendidikan (Perguruan Tinggi)</label>
                        {!! Form::text('education' , $model->education ,['class' => 'form-control', 'required']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Pengalaman Kerja</label>
						{!! Form::textarea('experience' , $model->experience ,['class' => 'form-control','id'=>'experience', 'required']) !!}
					</div>	
								
					<div class="form-group col-md-12">
						<table class='table' style="border-collapse:collapse;background:#ffc" width="75%" border="1"> 
						<label>Diklat/Training</label> 
							<tr> 
								<th>Nama Diklat/Training</th> 
								<th>Waktu/Tanggal Pelaksanaan</th> 
								<th>Nama Penyelenggara dan Tempat</th> 
								<th>Sertifikat</th>
								<th>Action</th>	
							</tr> 
							<tr> 
								<td>Nama............</td> 
								<td>Waktu...........</td> 
								<td>Penyelenggara.......</td>
								<td>YES/NO</td>
								<td><button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Delete' }}</button></td>
							</tr> 
						</table>
					</div>	
					
					<div class="form-group col-md-4">
						<label>Nama Diklat/Training</label>
                        {!! Form::text('name' , $model->name ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-4">
						<label>Waktu/Tanggal Pelaksanaan</label>
                        {!!  Form::text('waktu_pelaksanaan', null , ['id' => 'datepicker', 'class'=>'form-control']) !!}
					</div>
					
					<div class="form-group col-md-4">
						<label>Nama Penyelenggara dan Tempat</label>
                        {!! Form::text('nameplace' , $model->nameplace ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-4">
						<label>Sertifikat</label><br>
                        {!! Form::radio('sertifikat' , null, false) !!} Ya<br>
						{!! Form::radio('sertifikat' , null, false) !!} Tidak<br>
					</div>
					
					<div class="form-group col-md-4">
						<br>
						<button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
					</div>
					
					<div class="form-group col-md-12">
						<table class='table' style="border-collapse:collapse;background:#ffc" width="75%" border="1"> 
						<label>Workshop/Seminar</label> 
							<tr> 
								<th>Nama Workshop/Seminar</th> 
								<th>Waktu/Tanggal Pelaksanaan</th> 
								<th>Nama Penyelenggara dan Tempat</th> 
								<th>Sertifikat</th>
								<th>Action</th>	
							</tr> 
							<tr> 
								<td>Nama............</td> 
								<td>Waktu...........</td> 
								<td>Penyelenggara.......</td>
								<td>YES/NO</td>
								<td><button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Delete' }}</button></td>
							</tr> 
						</table>
					</div>	
					
					<div class="form-group col-md-4">
						<label>Nama Workshop/Seminar</label>
                        {!! Form::text('name' , $model->name ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-4">
						<label>Waktu/Tanggal Pelaksanaan</label>
                        {!!  Form::text('waktu_pelaksanaan', null , ['id' => 'datepicker', 'class'=>'form-control']) !!}
					</div>
					
					<div class="form-group col-md-4">
						<label>Nama Penyelenggara dan Tempat</label>
                        {!! Form::text('nameplace' , $model->nameplace ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-4">
						<label>Sertifikat</label><br>
                        {!! Form::radio('sertifikat' , null, false) !!} Ya<br>
						{!! Form::radio('sertifikat' , null, false) !!} Tidak<br>
					</div>
					
					<div class="form-group col-md-4">
						<button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
                    </div>
					
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
					
					
					
					<div class="form-group col-md-12">
						<button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
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