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
						<label>Judul</label>
                        {!! Form::text('judul' , $model->judul ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Kelompok Bidang Penelitian</label><br>
							<div class="form-group col-md-6">
								{!!  Form::checkbox('ref_kelompok_penelitian_id', null , false) !!} Kimia dan Pertambangan (KP)<br>
								{!!  Form::checkbox('ref_kelompok_penelitian_id', null , false) !!} Mekanika, Elektronika dan Konstruksi (MEK)<br>
							</div>
							<div class="form-group col-md-6">
								{!!  Form::checkbox('ref_kelompok_penelitian_id', null , false) !!} Pertanian, Pangan dan Kesehatan (PPK)<br>
								{!!  Form::checkbox('ref_kelompok_penelitian_id', null , false) !!} Lingkungan dan Serbaneka (LS)<br>
							</div>
					</div>
					
					<div class="form-group col-md-12">
						<label>Tahun Publikasi</label>
                        {!! Form::text('tahun' , $model->tahun ,['class' => 'form-control']) !!}
					</div>

					<div class="form-group col-md-12">
						<br><label>Tim Peneliti (1-10 orang)</label>
					</div>
					
					<div class="form-group col-md-4">
						<label>Nama Peneliti</label>
						{!!  Form::select('user_id',[1=>1], null, ['class'=>'form-control']) !!}
					</div>
					
					<div class="form-group col-md-4">
						<label>Jabatan Peneliti</label>
						{!!  Form::select('jabatan_peneliti',['ketua'=>'Ketua', 'wakil'=>'Wakil Ketua', 'anggota'=>'Anggota', 'sekre'=>'Sekretariat', 'lainnya'=>'Lainnya'], null, ['class'=>'form-control']) !!}
					</div>
					
					<div class="form-group col-md-4">
						<label>Jabatan Fungsional Peneliti</label>
						{!!  Form::select('jabatan_fungsional',['utama'=>'Peneliti Utama', 'madya'=>'Peneliti Madya', 'muda'=>'Peneliti Muda', 'pertama'=>'Peneliti Pertama', 'non'=>'Non Peneliti'], null, ['class'=>'form-control']) !!}
					</div>
					
					<div class="form-group col-md-4">
						<label>Asal Instansi</label>
						{!!  Form::text('instansi',$model->instansi ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-4">
						<label>Kelompok Bidang Peneliti</label>
						{!!  Form::select('kelompok_bidang',['kp'=>'KP', 'mek'=>'MEK', 'ppk'=>'PPK', 'ls'=>'LS'], null, ['class'=>'form-control']) !!}
					</div>
					
					<div class="form-group col-md-4">
						<br>
						<button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
					</div>
					
					
					<div class="form-group col-md-12">
                        <label>Ringkasan Eksekutif</label>
                        {!! Form::textarea('ringkasan' , $model->ringkasan ,['class' => 'form-control','id'=>'ringkasan']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Latar Belakang</label>
						{!! Form::textarea('background' , $model->background ,['class' => 'form-control','id'=>'background']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Tujuan</label>
						{!! Form::textarea('tujuan' , $model->tujuan ,['class' => 'form-control','id'=>'tujuan']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Kesimpulan</label>
						{!! Form::textarea('conclusion' , $model->conclusion ,['class' => 'form-control','id'=>'conclusion']) !!}
					</div>
					
					<div class="form-group col-md-12">
						<label>Rekomendasi</label>
						{!! Form::textarea('recomendation' , $model->recomendation ,['class' => 'form-control','id'=>'recomendation']) !!}
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
						<br><label>Daftar Data Pendukung Penelitian</label>
					</div>
					
					<div class="form-group col-md-8">
						<label>Nama File</label>
						{!!  Form::text('ref_data_pendukung_id',$model->ref_data_pendukung_id ,['class' => 'form-control']) !!}
					</div>
					
					<div class="form-group col-md-4">
						<br>
						<button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
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