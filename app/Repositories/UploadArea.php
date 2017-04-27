<?php namespace App\Repositories;

use Excel;
use App\Models\ArticleContent;
use App\Models\Research;
use App\Models\ResearchGroup;
use App\Models\AdditionalData;
use App\Models\Researcher;
use App\Models\Publication;
use App\Models\Expertise;
use App\Models\ResearcherTeam;
use App\Models\ResearcherWorkshop;
use App\Models\ResearchLocation;
use App\Models\ResearchStandard;
use App\Models\InterestGroup;

class UploadArea
{
	public function __construct(ArticleContent $article, Research $research, Publication $publication)
	{
		$this->article = $article;	
		$this->research = $research;	
		$this->publication = $publication;	
		
		$this->articleField = ['slug', 'title', 'intro','description','year','status','author_id'];
		$this->researchField = ['article_content_id', 'intro', 'summary','background','goal','conclusion','recommendation','recommendation_target','location','file'];
	}

	public function parsePenelitian($path)
	{
		$countData = 0;

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
	    			$penelitian[$index]['penelitian']['target_rekomendasi'] = $value->target_rekomendasi;
	    			$penelitian[$index]['penelitian']['file'] = $value->upload_full_text;
	    			
	    			$penelitian[$index]['kelompok']['kimia'] = $value->kimia_dan_pertambangan_kp;
	    			$penelitian[$index]['kelompok']['mekanika'] = $value->mekanika_elektronika_dan_konstruksi_mek;
	    			$penelitian[$index]['kelompok']['pertanian'] = $value->pertanian_pangan_dan_kesehatan_ppk;
	    			$penelitian[$index]['kelompok']['lingkungan'] = $value->lingkungan_dan_serbaneka_ls;

	    			$penelitian[$index]['peneliti']['nama'][] = $value->nama_peneliti;
	    			$penelitian[$index]['peneliti']['jabatan'][] = $value->jabatan_peneliti;
	    			$penelitian[$index]['peneliti']['jabatan_fungsional'][] = $value->jabatan_fungsional_peneliti;
	    			$penelitian[$index]['peneliti']['instansi'][] = $value->asal_instansi;
	    			$penelitian[$index]['peneliti']['bidang'][] = $value->bidang_kepakaran;
	    			$penelitian[$index]['peneliti']['minat'][] = $value->kelompok_minat;
	    			
	    			$penelitian[$index]['pendukung']['nama_file'][] = $value->nama_file;
	    			$penelitian[$index]['pendukung']['format'][] = $value->format_file;
	    			
	    			$penelitian[$index]['lokasi'][] = $value->lokasi_survei;

	    			$penelitian[$index]['penilaian']['standardisasi'] = $value->standardisasi;
	    			$penelitian[$index]['penilaian']['kesesuaian'] = $value->penilaian_kesesuaian;
	    			$penelitian[$index]['penilaian']['snsu'] = $value->snsu;
	    			
	    				
    			} else {
    				if ($value->nama_peneliti) {
    					$penelitian[$index]['peneliti']['nama'][] = $value->nama_peneliti;
		    			$penelitian[$index]['peneliti']['jabatan'][] = $value->jabatan_peneliti;
		    			$penelitian[$index]['peneliti']['jabatan_fungsional'][] = $value->jabatan_fungsional_peneliti;
		    			$penelitian[$index]['peneliti']['instansi'][] = $value->asal_instansi;
		    			$penelitian[$index]['peneliti']['bidang'][] = $value->bidang_kepakaran;
		    			$penelitian[$index]['peneliti']['minat'][] = $value->kelompok_minat;
	    			
    				} 
    				if ($value->nama_file) {
    					$penelitian[$index]['pendukung']['nama_file'][] = $value->nama_file;
    					$penelitian[$index]['pendukung']['format'][] = $value->format_file;
    				}

    				if ($value->lokasi_survei) {
    					$penelitian[$index]['lokasi'][] = $value->lokasi_survei;
    				}
    			}

    			
    			
    		}

    		// dd($penelitian);
    		$countData = 0;
    		foreach ($penelitian as $key => $val) {
    			
    			$savePenelitian = $this->articleContent($val, 'penelitian');
    			if ($savePenelitian) $countData++;
    		}

    		\Session::put('total_data', $countData);

		})->get();

		return true;
	}

	public function parsePublikasi($path)
	{
		Excel::selectSheets('Sheet1')->load($path, function($reader) {
    		$results = $reader->get();
    		
    		$publikasi = [];
    		$index = 0;
    		foreach ($results as $key => $value) {

    			if ($value->judul) {
    				$index++;

    				$publikasi[$index]['publikasi']['judul'] = $value->judul;
	    			$publikasi[$index]['publikasi']['kategori_publikasi'] = $value->kategori_publikasi;
	    			$publikasi[$index]['publikasi']['tahun_publikasi'] = $value->tahun_publikasi;
	    			$publikasi[$index]['publikasi']['abstraksi'] = $value->abstraksi;
	    			$publikasi[$index]['publikasi']['kesimpulan'] = $value->kesimpulan;
	    			$publikasi[$index]['publikasi']['rekomendasi'] = $value->rekomendasi;
	    			
	    			$publikasi[$index]['kelompok']['kimia'] = $value->kimia_dan_pertambangan_kp;
	    			$publikasi[$index]['kelompok']['mekanika'] = $value->mekanika_elektronika_dan_konstruksi_mek;
	    			$publikasi[$index]['kelompok']['pertanian'] = $value->pertanian_pangan_dan_kesehatan_ppk;
	    			$publikasi[$index]['kelompok']['lingkungan'] = $value->lingkungan_dan_serbaneka_ls;

	    			$publikasi[$index]['peneliti']['nama'][] = $value->nama_peneliti;
	    			$publikasi[$index]['peneliti']['penulis'][] = $value->penulis;
	    			$publikasi[$index]['peneliti']['asal_instansi'][] = $value->asal_instansi;
	    			
	    			$publikasi[$index]['penilaian']['standardisasi'] = $value->standardisasi;
	    			$publikasi[$index]['penilaian']['kesesuaian'] = $value->penilaian_kesesuaian;
	    			$publikasi[$index]['penilaian']['snsu'] = $value->snsu;
	    			
	    			
    			} else {
    				if ($value->nama_peneliti) {

    					$publikasi[$index]['peneliti']['nama'][] = $value->nama_peneliti;
		    			$publikasi[$index]['peneliti']['penulis'][] = $value->penulis;
		    			$publikasi[$index]['peneliti']['asal_instansi'][] = $value->asal_instansi;
	    			
    				} 
    				
    			}

    			
    			
    		}

    		$countData = 0;
    		foreach ($publikasi as $key => $val) {
    			
    			$savePublikasi = $this->articleContent($val, 'publikasi');
    			if ($savePublikasi) $countData++; 
    		}
    		
    		\Session::put('total_data', $countData);

		})->get();

		return true;
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
	    			// $personel[$index]['peneliti']['kelompok_bidang_peneliti'] = $value->kelompok_bidang_peneliti;
	    			$personel[$index]['peneliti']['alamat'] = $value->alamat;
	    			$personel[$index]['peneliti']['no_hp'] = $value->no_hp;
	    			$personel[$index]['peneliti']['email'] = $value->email;
	    			$personel[$index]['peneliti']['pendidikan_perguruan_tinggi'] = $value->pendidikan_perguruan_tinggi;
	    			$personel[$index]['peneliti']['pengalaman_kerja'] = $value->pengalaman_kerja;
	    			$personel[$index]['ketertarikan']['mekanika'] = $value->mekanika_elektronika_dan_konstruksi_mek;
	    			$personel[$index]['ketertarikan']['lingkungan'] = $value->lingkungan_dan_serbaneka_ls;
	    			$personel[$index]['ketertarikan']['pertanian'] = $value->pertanian_pangan_dan_kesehatan_ppk;
	    			$personel[$index]['ketertarikan']['kimia'] = $value->kimia_dan_pertambangan_kp;

	    			$personel[$index]['kepakaran']['mekanika'] = $value->mekanika;
	    			$personel[$index]['kepakaran']['kelistrikan'] = $value->kelistrikan;
	    			$personel[$index]['kepakaran']['konstruksi'] = $value->konstruksi;
	    			$personel[$index]['kepakaran']['pertanian'] = $value->pertanian;
	    			$personel[$index]['kepakaran']['peternakan'] = $value->peternakan;
	    			$personel[$index]['kepakaran']['perikanan'] = $value->perikanan;
	    			$personel[$index]['kepakaran']['perkebunan'] = $value->perkebunan;
	    			$personel[$index]['kepakaran']['kehutanan'] = $value->kehutanan;
	    			$personel[$index]['kepakaran']['pangan'] = $value->pangan;
	    			$personel[$index]['kepakaran']['kesehatan'] = $value->kesehatan;
	    			$personel[$index]['kepakaran']['kimia'] = $value->kimia;
	    			$personel[$index]['kepakaran']['fisika'] = $value->fisika;
	    			$personel[$index]['kepakaran']['pertambangan'] = $value->pertambangan;
	    			$personel[$index]['kepakaran']['lingkungan'] = $value->lingkungan;
	    			$personel[$index]['kepakaran']['manajemen'] = $value->manajemen;
	    			$personel[$index]['kepakaran']['teknologi_informasi'] = $value->teknologi_informasi;
	    			$personel[$index]['kepakaran']['ekonomi'] = $value->ekonomi;
	    			$personel[$index]['kepakaran']['statistika'] = $value->statistika;
	    			$personel[$index]['kepakaran']['lainnya'] = $value->lainnya;
	    			
	    			
	    			$personel[$index]['training']['nama_diklattraining'][] = $value->nama_diklattraining;
	    			$personel[$index]['training']['waktutanggal_pelaksanaan_diklattraining'][] = $value->waktutanggal_pelaksanaan_diklattraining;
	    			$personel[$index]['training']['nama_penyelenggara_dan_tempat_diklattraining'][] = $value->nama_penyelenggara_dan_tempat_diklattraining;
	    			$personel[$index]['training']['sertifikat_diklattraining'][] = $value->sertifikat_diklattraining;

	    			$personel[$index]['seminar']['nama_workshopseminar'][] = $value->nama_workshopseminar;
	    			$personel[$index]['seminar']['waktutanggal_pelaksanaan_workshopseminar'][] = $value->waktutanggal_pelaksanaan_workshopseminar;
	    			$personel[$index]['seminar']['nama_penyelenggara_dan_tempat_workshopseminar'][] = $value->nama_penyelenggara_dan_tempat_workshopseminar;
	    			$personel[$index]['seminar']['sertifikat_workshopseminar'][] = $value->sertifikat_workshopseminar;
	    			

	    			
	    				
    			} else {
    				if ($value->nama_diklattraining) {
    					$personel[$index]['training']['nama_diklattraining'][] = $value->nama_diklattraining;
		    			$personel[$index]['training']['waktutanggal_pelaksanaan_diklattraining'][] = $value->waktutanggal_pelaksanaan_diklattraining;
		    			$personel[$index]['training']['nama_penyelenggara_dan_tempat_diklattraining'][] = $value->nama_penyelenggara_dan_tempat_diklattraining;
		    			$personel[$index]['training']['sertifikat_diklattraining'][] = $value->sertifikat_diklattraining;

    				} 
    				if ($value->nama_workshopseminar) {
    					$personel[$index]['seminar']['nama_workshopseminar'][] = $value->nama_workshopseminar;
		    			$personel[$index]['seminar']['waktutanggal_pelaksanaan_workshopseminar'][] = $value->waktutanggal_pelaksanaan_workshopseminar;
		    			$personel[$index]['seminar']['nama_penyelenggara_dan_tempat_workshopseminar'][] = $value->nama_penyelenggara_dan_tempat_workshopseminar;
		    			$personel[$index]['seminar']['sertifikat_workshopseminar'][] = $value->sertifikat_workshopseminar;
	    			
    				}
    			}

    			
    			
    		}

    		// dd($personel);
    		$countData = 0;
    		foreach ($personel as $key => $val) {
    			
    			$savePersonel = $this->researcher($val);
    			if ($savePersonel) $countData++; 
    		}
    		
    		\Session::put('total_data', $countData);
		
		})->get();
		
		return true;
	}

	public function parseDataPendukung($path)
	{
		Excel::selectSheets('Sheet1')->load($path, function($reader) {
    		$results = $reader->all();
    		// dd($results);
    		$pendukung = [];
    		$index = 0;
    		foreach ($results as $key => $value) {

    			if ($value->judul) {
    				$index++;

    				$pendukung[$index]['pendukung']['judul'] = $value->judul;
	    			$pendukung[$index]['pendukung']['tahun'] = $value->tahun;
	    			$pendukung[$index]['pendukung']['nama_file'] = $value->nama_file;
	    			$pendukung[$index]['pendukung']['format_file'] = $value->format_file;
	    			$pendukung[$index]['pendukung']['keterangan_fill_blank'] = $value->keterangan_fill_blank;

    			} 
    			
    		}

    		// dd($pendukung);
    		$countData = 0;
    		foreach ($pendukung as $key => $val) {
    			
    			$savePendukung = $this->additionalData($val);
    			if ($savePendukung > 0) $countData++; 
    		}
    		
    		\Session::put('total_data', $countData);

		})->get();

		return true;
	}

	public function additionalData($data)
	{

		$pendukung = $data['pendukung'];
		$add = [];

		if (!$this->isExistAdditionalData(false, str_slug($pendukung['judul']))) {

			$article['title'] = $pendukung['judul'];
			$article['slug'] = str_slug($pendukung['judul']);
			$article['year'] = $pendukung['tahun'];
			$article['category'] = 'pendukung';
			$article['status'] = 'unpublish';
			$article['author_id'] = \Auth::user()->id;

			$saveArticle = ArticleContent::create($article);
			if ($saveArticle) {
				$add['title'] = $pendukung['judul'];
				$add['slug'] = str_slug($pendukung['judul']);
				$add['year'] = $pendukung['tahun'];
				$add['file'] = $pendukung['nama_file'];
				$add['format'] = $pendukung['format_file'];
				$add['article_content_id'] = $saveArticle->id;

				$save = AdditionalData::create($add);
				return $save->id;
			}
			
		}
		
	}

	public function isExistAdditionalData($id=false, $slug=false)
	{
		if ($id) $get = AdditionalData::whereId($id)->count();
		if ($slug) $get = AdditionalData::whereSlug($slug)->count();
		
		if ($get > 0) return true;
		else return false;
	}

	public function articleContent($data, $table='penelitian')
	{

		
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
					$input['category'] = 'penelitian';

					$save = $this->article->create($input);
					if ($save) {

						$research['article_content_id'] = $save->id;
						$research['title'] = $data['penelitian']['title'];
						$research['intro'] = $data['penelitian']['ringkasan'];
						$research['summary'] = $data['penelitian']['ringkasan'];
						$research['background'] = $data['penelitian']['latar_belakang'];
						$research['goal'] = $data['penelitian']['tujuan'];
						$research['conclusion'] = $data['penelitian']['kesimpulan'];
						$research['recommendation'] = $data['penelitian']['rekomendasi'];
						$research['recommendation_target'] = $data['penelitian']['target_rekomendasi'];
						$research['file'] = $data['penelitian']['file'];
						$research['year'] = $data['penelitian']['tahun_penelitian'];
						
						$saveResearch = $this->saveResearch($research);
						
						$saveResearchLocation = $this->saveResearchLocation(['lokasi' => $data['lokasi'], 'other_id'=>$saveResearch]);
						
						$saveResearchGroup = $this->saveResearchGroup(['kelompok' => $data['kelompok'], 'other_id'=>$saveResearch]);
						
						// $saveAdditionalData = $this->saveAdditionalData(['additional' => $data['pendukung'],'research'=>$data['penelitian'], 'other_id'=>$saveResearch]);
						
						$saveResearcherTeam = $this->saveResearcherTeam(['peneliti' => $data['peneliti'], 'other_id'=>$saveResearch]);
						
						$saveResearchStandard = $this->saveResearchStandard(['penilaian' => $data['penilaian'], 'other_id'=>$saveResearch]);
						
						
					}
					usleep(100);
					return true;
				}
				
				return false;
				break;
			
			case 'publikasi' :
				// dd($data);
				if (!$this->existContent(str_slug($data['publikasi']['judul']))) {

					$input['slug'] = str_slug($data['publikasi']['judul']);
					$input['title'] = $data['publikasi']['judul'];
					$input['intro'] = $data['publikasi']['abstraksi'];
					// $input['description'] = $data['publikasi']['abstraksi'];
					$input['year'] = $data['publikasi']['tahun_publikasi'];
					$input['status'] = 'unpublish';
					$input['author_id'] = \Auth::user()->id;
					$input['category'] = 'publikasi';

					$save = $this->article->create($input);
					if ($save) {

						$publication['article_content_id'] = $save->id;
						$publication['category'] = $data['publikasi']['kategori_publikasi'];
						$publication['abstract'] = $data['publikasi']['abstraksi'];
						$publication['conclusion'] = $data['publikasi']['kesimpulan'];
						$publication['recommendation'] = $data['publikasi']['rekomendasi'];
						$publication['year'] = $data['publikasi']['tahun_publikasi'];
						$publication['title'] = $data['publikasi']['judul'];
						
						$savePublication = $this->savePublication($publication);
						
						$saveResearchGroup = $this->saveResearchGroup(['kelompok' => $data['kelompok'], 'other_id'=>$savePublication], 'publikasi');
						
						// $saveAdditionalData = $this->saveAdditionalData(['additional' => $data['pendukung'],'research'=>$data['penelitian'], 'other_id'=>$saveResearch]);
						
						$saveResearcherTeam = $this->saveResearcherTeam(['peneliti' => $data['peneliti'], 'other_id'=>$savePublication], 'publikasi');
						
						$saveResearchStandard = $this->saveResearchStandard(['penilaian' => $data['penilaian'], 'other_id'=>$savePublication], 'publikasi');
						
					}
					usleep(100);
					return true;
				}
					
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
		// $person['interest_category'] = $data['peneliti']['kelompok_bidang_peneliti'];
		$person['address'] = $data['peneliti']['alamat'];
		$person['phone'] = $data['peneliti']['no_hp'];
		$person['email'] = $data['peneliti']['email'];
		$person['education'] = $data['peneliti']['pendidikan_perguruan_tinggi'];
		$person['experience'] = $data['peneliti']['pengalaman_kerja'];
		// dd($person);
		foreach ($data['kepakaran'] as $key => $value) {
			if ($value == "V") $expert[] = $this->getExpertise(false, ucfirst($key))->id;
		}
		foreach ($data['ketertarikan'] as $key => $value) {
			// dd($key);
			if ($value == "V") $interest[] = $this->getInterestGroup(false, $key)->id;
		}

		if (isset($expert) and count($expert) > 0) $person['expert_category'] = implode(',', $expert);
		if (isset($interest) and count($interest) > 0) $person['interest_category'] = implode(',', $interest);
		
		if (!$this->isExistPerson($data['peneliti']['email'])) {
			$savePerson = Researcher::create($person);
			
			$saveTraining = $this->saveResearchTraining(['training'=>$data['training'], 'researcher_id'=>$savePerson->id]);
			
			$saveSeminar = $this->saveResearchTraining(['seminar'=>$data['seminar'], 'researcher_id'=>$savePerson->id], 'seminar');

			$saveInterestGroup = $this->getInterestGroup(['ketertarikan'=>$data['ketertarikan'], 'researcher_id'=>$savePerson->id]);
			
			return true;
		}
		
		return false;
		
	}

	public function saveResearcherInterest($data)
	{
		$dataInterest = $data['ketertarikan'];

		$interestList = ['mekanika'=>'MEK','lingkungan'=>'LS','pertanian'=>'PPK','kimia'=>'KP'];
		foreach ($dataInterest as $key => $value) {
			
			if ($value == "V") {

				$getInterest = $this->getInterestGroup(false, $interestList[$key]);

				$interest['researcher_id'] = $data['researcher_id'];
				$interest['interest_group_id'] = $getInterest->id;

				$save = InterestGroup::create($interest);
			} 
		}

		return true;
	}

	public function getInterestGroup($id = false, $name=false)
	{
		$aliasName = ['mekanika'=>'MEK','lingkungan'=>'LS','pertanian'=>'PPK','kimia'=>'KP'];
		if ($id) return InterestGroup::whereId($id)->first();
		if ($name) {
			$find = InterestGroup::whereCode($aliasName[$name])->first();
			if (!$find) {
				$expert['name'] = $name;
				InterestGroup::create($expert);

				$find = InterestGroup::whereName($aliasName[$name])->first();
			}
			
			return $find;
		} 
		return false;

		// if ($id) return InterestGroup::whereId($id)->first();
		// if ($code) return InterestGroup::whereCode($code)->first();
		// else return InterestGroup::get();
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
				// $training['time'] = $dataTraining['waktutanggal_pelaksanaan_diklattraining'][$key];
				$dateEvent = explode('-', $dataTraining['waktutanggal_pelaksanaan_diklattraining'][$key]);
				$parse = explode('/', trim($dateEvent[0]));
				$parse1 = explode('/', trim($dateEvent[1]));
				$training['start_date'] = $parse[2] . '-' . $parse[1] . '-' . $parse[0]; 
				$training['end_date'] = $parse1[2] . '-' . $parse1[1] . '-' . $parse1[0];
				$training['organizer'] = $dataTraining['nama_penyelenggara_dan_tempat_diklattraining'][$key];
				$training['sertificate'] = $certificate[$dataTraining['sertifikat_diklattraining'][$key]];
				
			} else {
				// $training['time'] = $dataTraining['waktutanggal_pelaksanaan_workshopseminar'][$key];
				$dateEvent = explode('-', $dataTraining['waktutanggal_pelaksanaan_workshopseminar'][$key]);
				$parse = explode('/', trim($dateEvent[0]));
				$parse1 = explode('/', trim($dateEvent[1]));
				$training['start_date'] = $parse[2] . '-' . $parse[1] . '-' . $parse[0]; 
				$training['end_date'] = $parse1[2] . '-' . $parse1[1] . '-' . $parse1[0];
				$training['organizer'] = $dataTraining['nama_penyelenggara_dan_tempat_workshopseminar'][$key];
				$training['sertificate'] = $certificate[$dataTraining['sertifikat_workshopseminar'][$key]];
				
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

	public function savePublication($data)
	{

		$category = ['Jurnal'=>'jurnal','Prosiding'=>'prosiding','Lainnya'=>'lainnya'];

		$data['category'] = $category[$data['category']];

		$save = $this->publication->create($data);
		
		return $save->id;
	}

	public function saveResearchLocation($data)
	{
		$dataLokasi = $data['lokasi'];

		foreach ($dataLokasi as $key => $value) {
			$location['location'] = $value;
			$location['research_id'] = $data['other_id'];
			$save = ResearchLocation::create($location);
		}
		
		return true;
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

	public function saveResearcherTeam($data, $type='penelitian')
	{	
		$dataResearcher = $data['peneliti'];
		// dd($dataResearcher);
		// $bidang = ['kimia'=>'kp', 'mekanika'=>'mek', 'pertanian'=>'ppk', 'lingkungan'=>'ls'];
		$functional = ['Peneliti Utama' => 'p_utama', 'Peneliti Madya'=>'p_madya','Peneliti Muda'=>'p_muda','Peneliti Pertama'=>'p_pertama','Non Peneliti'=>'non_p'];
		// dd($dataResearcher);
		foreach ($dataResearcher['nama'] as $key => $value) {
			$researcher['other_id'] = $data['other_id'];
			$researcher['researcher_id'] = $this->getResearcher(false, trim($value))->id;
			$researcher['type'] = $type;

			if ($type == 'penelitian') {
				$researcher['position'] = ($dataResearcher['jabatan'][$key] == 'Wakil Ketua') ? 'wakil' : $dataResearcher['jabatan'][$key];
				$researcher['functional'] = $functional[trim($dataResearcher['jabatan_fungsional'][$key])];
				$researcher['instance'] = $dataResearcher['instansi'][$key];
				$researcher['interest_category'] = $dataResearcher['minat'][$key];
				$researcher['expert_category'] = $dataResearcher['bidang'][$key];
			} else {
				$researcher['writer'] = $dataResearcher['penulis'][$key];
				$researcher['instance'] = $dataResearcher['asal_instansi'][$key];
			}
			
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

	public function saveResearchStandard($data, $type='penelitian')
	{

		$dataGroup = $data['penilaian'];
		$otherId = $data['other_id'];

		foreach ($dataGroup as $key => $value) {
			if ($value) {
				$group['name'] = $key;
				$group['type'] = $type;
				$group['other_id'] = $otherId;

				$save = ResearchStandard::create($group);
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