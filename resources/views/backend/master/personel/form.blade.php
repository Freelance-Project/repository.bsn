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
                        {!! Form::text('name' , $model->name ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>Tempat Lahir</label>
                        {!! Form::text('tempat_lahir' , $model->tempat_lahir ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>Tanggal Lahir</label>
						{!!  Form::text('datebirth', null , ['id' => 'datepicker', 'class'=>'form-control']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>Jabatan</label>
						{!!  Form::select('ref_jabatan_id',[1=>1], null, ['class'=>'form-control']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>Golongan</label>
                        {!! Form::text('golongan' , $model->golongan ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Kelompok Bidang Peneliti</label>
						{!!  Form::select('ref_kelompok_penelitian_id',[1=>1], null, ['class'=>'form-control']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Alamat</label>
                        {!! Form::text('address' , $model->address ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>No. Handphone</label>
                        {!! Form::text('nohp' , $model->nohp ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label>Email</label>
                        {!! Form::text('email' , $model->email ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Pendidikan (Perguruan Tinggi)</label>
                        {!! Form::text('education' , $model->education ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Pengalaman Kerja</label>
						{!! Form::textarea('experience' , $model->experience ,['class' => 'form-control','id'=>'experience']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Kelompok Kepakaran</label><br>
							<div class="form-group col-md-4">
								{!!  Form::checkbox('ref_kelompok_kepakaran_id', null , false) !!} Mekanika<br>
								{!!  Form::checkbox('ref_kelompok_kepakaran_id', null , false) !!} Elektronika<br>
								{!!  Form::checkbox('ref_kelompok_kepakaran_id', null , false) !!} Pertanian<br>
								{!!  Form::checkbox('ref_kelompok_kepakaran_id', null , false) !!} Pangan<br>
							</div>
							<div class="form-group col-md-4">
								{!!  Form::checkbox('ref_kelompok_kepakaran_id', null , false) !!} Kesehatan<br>
								{!!  Form::checkbox('ref_kelompok_kepakaran_id', null , false) !!} Kimia<br>
								{!!  Form::checkbox('ref_kelompok_kepakaran_id', null , false) !!} Pertambangan<br>
								{!!  Form::checkbox('ref_kelompok_kepakaran_id', null , false) !!} Lingkungan<br>
							</div>
							<div class="form-group col-md-4">
								Lainnya {!!  Form::text('ref_kelompok_kepakaran_id_lain', null) !!}
							</div>
					</div>
					
					
					<div class="form-group col-md-12">
						<label>Nama Diklat/Training</label>
                        {!! Form::text('name' , $model->name ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Waktu/Tanggal Pelaksanaan</label>
                        {!!  Form::text('waktu_pelaksanaan', null , ['id' => 'datepicker', 'class'=>'form-control']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Nama Penyelenggara dan Tempat</label>
                        {!! Form::text('nameplace' , $model->nameplace ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Sertifikat</label><br>
                        {!! Form::radio('sertifikat' , null, false) !!} Ya<br>
						{!! Form::radio('sertifikat' , null, false) !!} Tidak<br>
					</div>
					
					
					
					<div class="form-group col-md-12">
						<label>Nama Workshop/Seminar</label>
                        {!! Form::text('name' , $model->name ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Waktu/Tanggal Pelaksanaan</label>
                        {!!  Form::text('waktu_pelaksanaan', null , ['id' => 'datepicker', 'class'=>'form-control']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Nama Penyelenggara dan Tempat</label>
                        {!! Form::text('nameplace' , $model->nameplace ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Sertifikat</label><br>
                        {!! Form::radio('sertifikat' , null, false) !!} Ya<br>
						{!! Form::radio('sertifikat' , null, false) !!} Tidak<br>
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