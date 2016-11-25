<!-- Modal -->
<div class="modal fade" id="advanceForm" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Advance Search</h4>
        </div>
        <div class="modal-body">
            {!! Form::open(['url'=>'search/advance','method'=>'post']) !!} 

              {!! Form::hidden('_token' , csrf_token()) !!}
              <div class="row">
                 <div class="col-md-4 col-xs-4">
                     <ul class="list-group">
                        <li class="list-group-item noBorder"><input type="checkbox" value="penelitian" name="category[penelitian]">Penelitian</li>
                      </ul>
                 </div><!--.col-md-->
                  <div class="col-md-8 col-xs-8">
                      <div class="row">
                        <div class="col-md-6 col-xs-6">
                       <div class="form-group">
                          <input type="text" class="form-control" id="date1" placeholder="Tahun Awal" name="tahun_mulai" required>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-6">
                        <div class="form-group">
                          <input type="text" class="form-control" id="date2" placeholder="Tahun Akhir" name="tahun_akhir" required>
                        </div>
                      </div>
                      </div><!--end.row-->
                  </div><!--.col-md-->
                  </div><!--end.row-->
                  <div class="row">
                    <div class="col-md-4 col-xs-4">
                     <ul class="list-group">
                      <li class="list-group-item noBorder"><!--<input type="checkbox" name="category[publikasi]" value="publikasi"> -->Publikasi
                        <ul class="list-group child-list">
                          <li class="list-group-item noBorder"><input type="checkbox" name="category[publikasi][jurnal]" value="jurnal"> Jurnal</li>
                          <li class="list-group-item noBorder"><input type="checkbox" name="category[publikasi][prosiding]" value="prosiding"> Prosiding</li>
                          <li class="list-group-item noBorder"><input type="checkbox" name="category[publikasi][lainnya]" value="lainnya"> Lainnya</li>
                        </ul>
                      </li>
                    </ul>
                   </div><!--.col-md-->
                   <div class="col-md-8 col-xs-8">
                      <ul class="list-group">
                        <li class="list-group-item noBorder"><!--<input type="checkbox" name="kelompok" value="kelompok"> -->Kelompok Bidang Penelitian
                          <ul class="list-group child-list">
                            <li class="list-group-item noBorder"><input type="checkbox" name="kelompok[kp]" value="kp"> Kimia Pertambangan (KP)</li>
                            <li class="list-group-item noBorder"><input type="checkbox" name="kelompok[mek]" value="mek"> Mekanika Elektronika dan Konstruksi (MEK)</li>
                            <li class="list-group-item noBorder"><input type="checkbox" name="kelompok[ppk]" value="ppk"> Pertanian Pangan dan Kesehatan (PPK)</li>
                            <li class="list-group-item noBorder"><input type="checkbox" name="kelompok[ls]" value="ls"> Lingkungan dan Serbaneka (LS) </li>
                          </ul>
                        </li>
                      </ul>
                   </div><!--.col-md-->
                  </div><!--end.row-->

                  <div class="row">
                    <div class="col-md-4 col-xs-4">
                     <ul class="list-group">
                      <li class="list-group-item noBorder"><input type="checkbox" name="pendukung" value="pendukung"> Data Pendukung
                        <!--<ul class="list-group child-list">
                          <li class="list-group-item noBorder"><input type="checkbox" name="pendukung[ekspor]" value="ekspor"> Ekspor</li>
                          <li class="list-group-item noBorder"><input type="checkbox" name="pendukung[impor]" value="impor"> Impor</li>
                          <li class="list-group-item noBorder"><input type="checkbox" name="pendukung[industri]" value="industri"> Industri</li>
                          <li class="list-group-item noBorder"><input type="checkbox" name="pendukung[asosiasi]" value="asosiasi"> Asosiasi</li>
                        </ul>-->
                      </li>
                    </ul>
                   </div><!--.col-md-->
                   <div class="col-md-8 col-xs-8">
                      <ul class="list-group">
                        <li class="list-group-item noBorder"><!--<input type="checkbox" name="standar" value="standar">--> Kelompok Standardisasi dan Penilaian Kesesuaian
                          <ul class="list-group child-list">
                            <li class="list-group-item noBorder"><input type="checkbox" name="standar[standardisasi]" value="standardisasi"> Standardisasi</li>
                            <li class="list-group-item noBorder"><input type="checkbox" name="standar[penilaian]" value="penilaian"> Penilaian Kesesuaian</li>
                            <li class="list-group-item noBorder"><input type="checkbox" name="standar[snsu]" value="snsu"> SNSU</li>
                          </ul>
                        </li>
                      </ul>
                   </div><!--.col-md-->
                  </div><!--end.row-->
                  {{--
                  <div class="row">
                    <div class="col-md-6 col-xs-6">
                     <div class="form-group">
                        <label for="">Personel</label>
                        <input type="text" class="form-control" id="autocomplete" placeholder="" name="personel">
                      </div>
                   </div><!--.col-md-->
                  </div><!--end.row-->
                  --}}
              <button type="submit" class="btn btn-primary">Cari</button>
            {!! Form::close() !!}
        </div><!--end.modal-body-->
        <div class="modal-footer">
        </div><!--end.-modal-footer-->
      </div><!--end.modal-dontent-->
      
    </div>
</div>