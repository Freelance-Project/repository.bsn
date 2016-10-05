<?php namespace App\Helper\Src;

use Excel;
use App\Models\ArticleContent;
use App\Models\Research;

class UploadArea
{
	public function __construct()
	{
		
	}
	
	public function parsePenelitian($path)
	{
		Excel::selectSheets('Sheet1')->load($path, function($reader) {
    		$results = $reader->get();
    		// dd($results);
    		$penelitian = [];
    		$index = 0;
    		foreach ($results as $key => $value) {

    			if ($value->judul) {
    				$index++;

    				$penelitian[$index]['penelitian']['title'] = $value->judul;
	    			$penelitian[$index]['penelitian']['intro'] = $value->ringkasan_eksekutif;
	    			$penelitian[$index]['penelitian']['description'] = $value->ringkasan_eksekutif;
	    			$penelitian[$index]['penelitian']['tahun_penelitian'] = $value->tahun_penelitian;
	    			$penelitian[$index]['penelitian']['ringkasan'] = $value->ringkasan_eksekutif;
	    			$penelitian[$index]['penelitian']['latar_belakang'] = $value->latar_belakang;
	    			$penelitian[$index]['penelitian']['tujuan'] = $value->tujuan;
	    			$penelitian[$index]['penelitian']['rekomendasi'] = $value->rekomendasi;
	    			$penelitian[$index]['penelitian']['file'] = $value->upload_full_text_related_to_data_pendukung;
	    			
	    			$penelitian[$index]['kelompok']['kimia'] = $value->kimia_dan_pertambangan_kp;
	    			$penelitian[$index]['kelompok']['mekanika'] = $value->mekanika_elektronika_dan_konstruksi_mek;
	    			$penelitian[$index]['kelompok']['pertanian'] = $value->pertanian_pangan_dan_kesehatan_ppk;
	    			$penelitian[$index]['kelompok']['lingkungan'] = $value->lingkungan_dan_serbaneka_ls;

	    			$penelitian[$index]['peneliti']['nama'][] = $value->nama_peneliti;
	    			$penelitian[$index]['peneliti']['jabatan'][] = $value->jabatan_peneliti;
	    			$penelitian[$index]['peneliti']['jabatan_fungsional'][] = $value->jabatan_fungsional_peneliti;
	    			$penelitian[$index]['peneliti']['instansi'][] = $value->asal_instansi;
	    			$penelitian[$index]['peneliti']['bidang'][] = $value->kelompok_bidang_peneliti;
	    			
	    			$penelitian[$index]['pendukung']['nama_file'][] = $value->nama_file;

	    			
	    				
    			} else {
    				if ($value->nama_peneliti) {
    					$penelitian[$index]['peneliti']['nama'][] = $value->nama_peneliti;
		    			$penelitian[$index]['peneliti']['jabatan'][] = $value->jabatan_peneliti;
		    			$penelitian[$index]['peneliti']['jabatan_fungsional'][] = $value->jabatan_fungsional_peneliti;
		    			$penelitian[$index]['peneliti']['instansi'][] = $value->asal_instansi;
		    			$penelitian[$index]['peneliti']['bidang'][] = $value->kelompok_bidang_peneliti;
	    			
    				} 
    				if ($value->nama_file) {
    					$penelitian[$index]['pendukung']['nama_file'][] = $value->nama_file;
    				}
    			}

    			
    			
    		}

    		foreach ($penelitian as $key => $val) {
    			
    			$savePenelitian = $this->articleContent($val, 'penelitian');
    		}
    		

		})->get();

		
	}

	public function articleContent($data, $table='penelitian')
	{

		// dd($data);
		switch ($table) {
			case 'penelitian':

				$input['slug'] = str_slug($data['penelitian']['title']);
				$input['title'] = $data['penelitian']['title'];
				$input['intro'] = $data['penelitian']['intro'];
				$input['description'] = $data['penelitian']['description'];
				$input['status'] = 'unpublish';
				$input['author_id'] = \Auth::user()->id;

				$save = ArticleContent::create($input);
				// dd($save);
				$research['article_content_id'] = $save->id;
				$research['intro'] = $data['penelitian']['intro'];
				$research['summary'] = $data['penelitian']['ringkasan'];
				$saveResearch = Research::create($research);
				if ($saveResearch) return true;
				
				break;
			
			default:
				# code...
				break;
		}
	
		return false;
	}
}