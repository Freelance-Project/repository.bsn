<?php namespace App\Helper\Src;

use Excel;
use App\Models\ArticleContent;
use App\Models\Research;
use App\Models\ResearchGroup;
use App\Models\AdditionalData;
use App\Models\Researcher;
use App\Models\Expertise;
use App\Models\ResearcherTeam;
use App\Models\ResearcherWorkshop;

class UploadArea
{
	public function __construct(ArticleContent $article, Research $research)
	{
		$this->article = $article;	
		$this->research = $research;	
		
		$this->articleField = ['slug', 'title', 'intro','description','year','status','author_id'];
		$this->researchField = ['article_content_id', 'intro', 'summary','background','goal','conclusion','recommendation','recommendation_target','location','file'];
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
	    			$penelitian[$index]['penelitian']['kesimpulan'] = $value->kesimpulan;
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
	    			$penelitian[$index]['pendukung']['format'][] = $value->format_file;

	    			
	    				
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
    					$penelitian[$index]['pendukung']['format'][] = $value->format_file;
    				}
    			}

    			
    			
    		}

    		foreach ($penelitian as $key => $val) {
    			
    			$savePenelitian = $this->articleContent($val, 'penelitian');
    		}
    		

		})->get();

		
	}

	public function parsePersonel($path)
	{
		Excel::selectSheets('Sheet1')->load($path, function($reader) {
    		$results = $reader->all();
    		// dd($results);
    		$personel = [];
    		$index = 0;
    		foreach ($results as $key => $value) {

    			if ($value->nama) {
    				$index++;

    				$personel[$index]['peneliti']['nama'] = $value->nama;
	    			$personel[$index]['peneliti']['tempat_lahir'] = $value->tempat_lahir;
	    			$personel[$index]['peneliti']['tanggal_lahir'] = $value->tanggal_lahir;
	    			$personel[$index]['peneliti']['jabatan'] = $value->jabatan;
	    			$personel[$index]['peneliti']['golongan'] = $value->golongan;
	    			$personel[$index]['peneliti']['kelompok_bidang_peneliti'] = $value->kelompok_bidang_peneliti;
	    			$personel[$index]['peneliti']['alamat'] = $value->alamat;
	    			$personel[$index]['peneliti']['no_hp'] = $value->no_hp;
	    			$personel[$index]['peneliti']['email'] = $value->email;
	    			$personel[$index]['peneliti']['pendidikan_perguruan_tinggi'] = $value->pendidikan_perguruan_tinggi;
	    			$personel[$index]['peneliti']['pengalaman_kerja'] = $value->pengalaman_kerja;
	    			$personel[$index]['peneliti']['mekanika'] = $value->mekanika;
	    			$personel[$index]['peneliti']['elektronika'] = $value->elektronika;
	    			$personel[$index]['peneliti']['pertanian'] = $value->pertanian;
	    			$personel[$index]['peneliti']['pangan'] = $value->pangan;
	    			$personel[$index]['peneliti']['kesehatan'] = $value->kesehatan;
	    			$personel[$index]['peneliti']['kimia'] = $value->kimia;
	    			$personel[$index]['peneliti']['pertambangan'] = $value->pertambangan;
	    			$personel[$index]['peneliti']['lingkungan'] = $value->lingkungan;
	    			$personel[$index]['peneliti']['lainnya'] = $value->lainnya;
	    			
	    			$personel[$index]['training']['nama_diklattraining'][] = $value->nama_diklattraining;
	    			$personel[$index]['training']['waktutanggal_pelaksanaan_training'][] = $value->waktutanggal_pelaksanaan_training;
	    			$personel[$index]['training']['nama_penyelenggara_dan_tempat_taining'][] = $value->nama_penyelenggara_dan_tempat_taining;
	    			$personel[$index]['training']['sertifikat_training'][] = $value->sertifikat_training;

	    			$personel[$index]['seminar']['nama_workshopseminar'][] = $value->nama_workshopseminar;
	    			$personel[$index]['seminar']['waktutanggal_pelaksanaan_seminar'][] = $value->waktutanggal_pelaksanaan_seminar;
	    			$personel[$index]['seminar']['nama_penyelenggara_dan_tempat_seminar'][] = $value->nama_penyelenggara_dan_tempat_seminar;
	    			$personel[$index]['seminar']['sertifikat_seminar'][] = $value->sertifikat_seminar;
	    			

	    			
	    				
    			} else {
    				if ($value->nama_diklattraining) {
    					$personel[$index]['training']['nama_diklattraining'][] = $value->nama_diklattraining;
		    			$personel[$index]['training']['waktutanggal_pelaksanaan_training'][] = $value->waktutanggal_pelaksanaan_training;
		    			$personel[$index]['training']['nama_penyelenggara_dan_tempat_taining'][] = $value->nama_penyelenggara_dan_tempat_taining;
		    			$personel[$index]['training']['sertifikat_training'][] = $value->sertifikat_training;

    				} 
    				if ($value->nama_workshopseminar) {
    					$personel[$index]['seminar']['nama_workshopseminar'][] = $value->nama_workshopseminar;
		    			$personel[$index]['seminar']['waktutanggal_pelaksanaan_seminar'][] = $value->waktutanggal_pelaksanaan_seminar;
		    			$personel[$index]['seminar']['nama_penyelenggara_dan_tempat_seminar'][] = $value->nama_penyelenggara_dan_tempat_seminar;
		    			$personel[$index]['seminar']['sertifikat_seminar'][] = $value->sertifikat_seminar;
		    			
    				}
    			}

    			
    			
    		}

    		foreach ($personel as $key => $val) {
    			
    			$savePersonel = $this->researcher($val);
    		}
    		

		})->get();

		return true;
	}

	public function articleContent($data, $table='penelitian')
	{

		// dd($data);
		switch ($table) {
			case 'penelitian':

				if (!$this->existContent(str_slug($data['penelitian']['title']))) {

					$input['slug'] = str_slug($data['penelitian']['title']);
					$input['title'] = $data['penelitian']['title'];
					$input['intro'] = $data['penelitian']['intro'];
					$input['description'] = $data['penelitian']['description'];
					$input['year'] = $data['penelitian']['tahun_penelitian'];
					$input['status'] = 'unpublish';
					$input['author_id'] = \Auth::user()->id;

					$save = $this->article->create($input);
					if ($save) {

						$research['article_content_id'] = $save->id;
						$research['intro'] = $data['penelitian']['ringkasan'];
						$research['summary'] = $data['penelitian']['ringkasan'];
						$research['background'] = $data['penelitian']['latar_belakang'];
						$research['goal'] = $data['penelitian']['tujuan'];
						$research['conclusion'] = $data['penelitian']['kesimpulan'];
						$research['recommendation'] = $data['penelitian']['rekomendasi'];
						$research['file'] = $data['penelitian']['file'];
						
						$saveResearch = $this->saveResearch($research);
						
						$saveResearchGroup = $this->saveResearchGroup(['kelompok' => $data['kelompok'], 'other_id'=>$saveResearch]);
						
						$saveAdditionalData = $this->saveAdditionalData(['additional' => $data['pendukung'],'research'=>$data['penelitian'], 'other_id'=>$saveResearch]);
						
						$saveResearcherTeam = $this->saveResearcherTeam(['peneliti' => $data['peneliti'], 'other_id'=>$saveResearch]);
						
						
					}
					usleep(100);
				}
				
				return false;
				break;
			
			default:
				# code...
				break;
		}
	
		return false;
	}

	public function researcher($data)
	{
		// dd($data);
		$position = ['Peneliti Utama' => 'p_utama', 'Peneliti Madya'=>'p_madya','Peneliti Muda'=>'p_muda','Peneliti Pertama'=>'p_pertama','Non Peneliti'=>'non_p'];
		
		$person['name'] = $data['peneliti']['nama'];
		$person['birthplace'] = $data['peneliti']['tempat_lahir'];
		$person['dob'] = $data['peneliti']['tanggal_lahir'];
		$person['position'] = $position[$data['peneliti']['jabatan']];
		$person['grade'] = $data['peneliti']['golongan'];
		$person['interest_category'] = $data['peneliti']['kelompok_bidang_peneliti'];
		$person['address'] = $data['peneliti']['alamat'];
		$person['phone'] = $data['peneliti']['no_hp'];
		$person['email'] = $data['peneliti']['email'];
		$person['education'] = $data['peneliti']['pendidikan_perguruan_tinggi'];
		$person['experience'] = $data['peneliti']['pengalaman_kerja'];

		if ($data['peneliti']['mekanika']) $expert[] = $this->getExpertise(false, 'Mekanika')->id;
		if ($data['peneliti']['elektronika']) $expert[] = $this->getExpertise(false, 'Elektronika')->id;
		if ($data['peneliti']['pertanian']) $expert[] = $this->getExpertise(false, 'Pertanian')->id;
		if ($data['peneliti']['pangan']) $expert[] = $this->getExpertise(false, 'Pangan')->id;
		if ($data['peneliti']['kesehatan']) $expert[] = $this->getExpertise(false, 'Kesehatan')->id;
		if ($data['peneliti']['kimia']) $expert[] = $this->getExpertise(false, 'Kimia')->id;
		if ($data['peneliti']['pertambangan']) $expert[] = $this->getExpertise(false, 'Pertambangan')->id;
		if ($data['peneliti']['lingkungan']) $expert[] = $this->getExpertise(false, 'Lingkungan')->id;
		if ($data['peneliti']['lainnya']) $expert[] = $this->getExpertise(false, $data['peneliti']['lainnya'])->id;
		
		if (count($expert) > 0) $person['expert_category'] = implode(',', $expert);
		
		if (!$this->isExistPerson($data['peneliti']['email'])) {
			$savePerson = Researcher::create($person);
			
			$saveTraining = $this->saveResearchTraining(['training'=>$data['training'], 'researcher_id'=>$savePerson->id]);
			
			$saveSeminar = $this->saveResearchTraining(['seminar'=>$data['seminar'], 'researcher_id'=>$savePerson->id], 'seminar');

			
			return true;
		}
		
		return false;
		
	}

	public function saveResearchTraining($data, $type='training')
	{

		$dataTraining = $data[$type];

		$indexArray = ['training'=>'nama_diklattraining', 'seminar'=>'nama_workshopseminar'];
		$certificate = ['Tidak'=>'t', 'Ya'=>'y'];


		foreach ($dataTraining[$indexArray[$type]] as $key => $value) {
			
			$training['researcher_id'] = $data['researcher_id'];
			$training['name'] = $value;
			if ($type == 'training') {
				$training['time'] = $dataTraining['waktutanggal_pelaksanaan_training'][$key];
				$training['organizer'] = $dataTraining['nama_penyelenggara_dan_tempat_taining'][$key];
				$training['sertificate'] = $certificate[$dataTraining['sertifikat_training'][$key]];
				
			} else {
				$training['time'] = $dataTraining['waktutanggal_pelaksanaan_seminar'][$key];
				$training['organizer'] = $dataTraining['nama_penyelenggara_dan_tempat_seminar'][$key];
				$training['sertificate'] = $certificate[$dataTraining['sertifikat_seminar'][$key]];
				
			}

			$training['type'] = $type;

			ResearcherWorkshop::create($training);
		}
		
	}

	public function isExistPerson($email)
	{
		$person = Researcher::whereEmail($email)->count();
		if ($person > 0) return true;
		return false;
	}

	public function getExpertise($id=false, $name=false)
	{

		if ($id) return Expertise::whereId($id)->first();
		if ($name) {
			$find = Expertise::whereName($name)->first();
			if (!$find) {
				$expert['name'] = $name;
				Expertise::create($expert);

				$find = Expertise::whereName($name)->first();
			}

			return $find;
		} 
		return false;
	}

	public function saveContent($data, $field, $model)
	{

		$query = $model;

		foreach ($data as $key => $value) {
			if (in_array($key, $field)) {
				$query->{$key} = $value;
			}
		}

		if ($query->save()) return true;
		else return false;
	}

	public function saveResearch($data)
	{

		$save = $this->research->create($data);
		
		return $save->id;
	}

	public function saveResearchGroup($data, $type='penelitian')
	{

		$name = ['kimia'=>'kp', 'mekanika'=>'mek', 'pertanian'=>'ppk', 'lingkungan'=>'ls'];
		
		$dataGroup = $data['kelompok'];
		$otherId = $data['other_id'];

		foreach ($dataGroup as $key => $value) {
			if ($value) {
				$group['name'] = $name[$key];
				$group['type'] = $type;
				$group['other_id'] = $otherId;

				$save = ResearchGroup::create($group);
			}
		}
		
		return true;
	}

	public function saveResearcherTeam($data)
	{	
		$dataResearcher = $data['peneliti'];
		// $bidang = ['kimia'=>'kp', 'mekanika'=>'mek', 'pertanian'=>'ppk', 'lingkungan'=>'ls'];
		$functional = ['Peneliti Utama' => 'p_utama', 'Peneliti Madya'=>'p_madya','Peneliti Muda'=>'p_muda','Peneliti Pertama'=>'p_pertama','Non Peneliti'=>'non_p'];

		foreach ($dataResearcher['nama'] as $key => $value) {
			$researcher['other_id'] = $data['other_id'];
			$researcher['researcher_id'] = $this->getResearcher(false, $value)->id;
			$researcher['position'] = $dataResearcher['jabatan'][$key];
			$researcher['functional'] = $functional[trim($dataResearcher['jabatan_fungsional'][$key])];
			$researcher['instance'] = $dataResearcher['instansi'][$key];
			$researcher['interest_category'] = $dataResearcher['bidang'][$key];

			ResearcherTeam::create($researcher);
		}
		
		return true;
	}

	public function getResearcher($id=false, $name=false)
	{
		if ($id) return Researcher::whereId($id)->first();
		if ($name) return Researcher::whereName($name)->first();
		return false;
	}

	public function saveAdditionalData($data, $type='penelitian')
	{

		$dataAdditional = $data['additional'];
		$dataResearch = $data['research'];
		$otherId = $data['other_id'];

		foreach ($dataAdditional['nama_file'] as $key => $value) {
			if ($value) {
				$additional['title'] = $dataResearch['title'];
				$additional['year'] = $dataResearch['tahun_penelitian'];
				$additional['file'] = $value;
				$additional['format'] = $dataAdditional['format'][$key];
				$additional['type'] = $type;
				$additional['other_id'] = $otherId;

				$save = AdditionalData::create($additional);
			}
		}
		
		return true;
	}


	public function existContent($slug)
	{
		$article = ArticleContent::whereSlug($slug)->count();
		if ($article > 0) return true;
		return false;
	}
}