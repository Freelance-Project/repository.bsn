<?php

namespace App\Http\Controllers\Backend\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Controllers\Backend\HelperController;
use App\Models\ArticleContent;
use App\Models\Publication;
use App\Models\ResearchGroup;
use App\Models\ResearchStandard;
use Table;
use App\Repositories\UploadArea;

class PublikasiController extends Controller
{
	public function __construct(UploadArea $upload)
	{
		$this->model = new ArticleContent;
		$this->uploadArea = $upload;
	}


	public function getIndex()
	{
		return view('backend.master.publikasi.index');
	}

	public function getData()
	{
		$model = Publication::select('id' , 'year', 'title' , 'status')->orderBy('created_at', 'desc');
		return Table::of($model)
			->addColumn('thumbnail',function($model){
				return '<img src = "'.asset('contents/news/small/'.$model->thumbnail).'"/>';
			})
			->addColumn('action' , function($model){
			return \helper::buttons($model->id);
		})->make(true);
	}

	public function getCreate()
	{
		$model = $this->model;
		$publikasi = Publication::where(1);
		$researchgroup = ResearchGroup::where(1);
		$date = '';

		return view('backend.master.publikasi.form', ['model' => $model,'date' => $date,'group'=>false,'standard'=>false]);
	}


	public function postCreate(Request $request)
	{
		$inputs = $request->all();
		// $validation = \Validator::make($inputs , $this->model->rules());
		// if($validation->fails()) return redirect()->back()->withInput()->withErrors($validation);
		
		$valuesArticle = [
			
			'slug' => str_slug($request->title),
			'title' => $request->title,
			'year' => $request->year,
			'intro' => $request->intro,
			'author_id' => \Auth::user()->id,
			'category' => $request->category_article,
			'status' => $request->status
		];
			
		$saveArticle = $this->model->create($valuesArticle);
		if ($saveArticle) {
			$valuesPublication = [
				'article_content_id' => $saveArticle->id,
				'title' => $request->title,
				'year' => $request->year,
				'intro' => $request->intro,
				'category' => $request->category,
				'volume' => $request->volume,
				'conclusion' => $request->conclusion,
				'recommendation' => $request->recommendation,
				'created_at' => \Helper::dateToDb($request->date),
				'status' => $request->status
			];
			
			$savePublication = Publication::create($valuesPublication);
			
			if ($request->research_groups_id) {
				foreach($request->research_groups_id as $val){
					$valuesResearchGroup = [
						'other_id' => $savePublication->id,
						'name' => $val,
						'type' => 'publikasi'
					];
					$save = ResearchGroup::create($valuesResearchGroup);
				}
			}
			
			if ($request->research_standards_id) {
				
				ResearchStandard::whereOtherId($savePublication->id)->delete();
				
				foreach($request->research_standards_id as $val){
					$valuesResearchStandard = [
						'other_id' => $savePublication->id,
						'name' => $val,
						'type' => 'publikasi'
					];
					$save = ResearchStandard::create($valuesResearchStandard);
				}
			}
			
		} else {
			return redirect(urlBackendAction('index'))->withSuccess('Data already exist');
		}
		

        return redirect(urlBackendAction('index'))->withSuccess('Data has been saved');
	}

	public function getUpdate($id)
	{
		$model  = Publication::find($id);
		$date = \Helper::dbToDate($model->created_at);
		$resGroup = ResearchGroup::whereOtherId($model->id)->get();
		$resStandard = ResearchStandard::whereOtherId($model->id)->get();
		// dd($resStandard);
		return view('backend.master.publikasi.form' , [

			'model' => $model,
			'date' => $date,
			'group' => $resGroup,
			'standard' => $resStandard,
			
		]);
	}


	public function postUpdate(Request $request , $id)
	{
		$inputs = $request->all();
		// $validation = \Validator::make($inputs , $this->model->rules($id));
		// if($validation->fails()) return redirect()->back()->withInput()->withErrors($validation);
		
		$dataid = Publication::whereId($id)->first();

		$article = $this->model->whereId($dataid->article_content_id)->first();
		$valuesArticle = [
			
			'slug' => str_slug($request->title),
			'title' => $request->title,
			'year' => $request->year,
			'intro' => $request->intro,
			'status' => $request->status
		];
			
		$saveArticle = $article->update($valuesArticle);


		$values = [
			'title' => $request->title,
			'year' => $request->year,
			'intro' => $request->intro,
			'volume' => $request->volume,
			'conclusion' => $request->conclusion,
			'recommendation' => $request->recommendation,
			'created_at' => \Helper::dateToDb($request->date),
			'status' => $request->status
		];


		$update = $dataid->update($values);
		
		if ($request->research_groups_id) {
			// dd($dataid);
			ResearchGroup::whereOtherId($dataid->id)->delete();
			
			foreach($request->research_groups_id as $val){
				$valuesResearchGroup = [
					'other_id' => $dataid->id,
					'name' => $val,
					'type' => 'publikasi'
				];
				$save = ResearchGroup::create($valuesResearchGroup);
			}
		}
		
		if ($request->research_standards_id) {
			// dd($dataid);
			ResearchStandard::whereOtherId($dataid->id)->delete();
			
			foreach($request->research_standards_id as $val){
				$valuesResearchStandard = [
					'other_id' => $dataid->id,
					'name' => $val,
					'type' => 'publikasi'
				];
				$save = ResearchStandard::create($valuesResearchStandard);
			}
		}
			
		$image = str_replace("%20", " ", $request->image);

        if(!empty($image))
        {

            $imageName = $this->imagePrefix."-".$dataid->content_id;
			$uploadImage = \Helper::handleUpload($request, $imageName);
			
			$this->model->whereContentId($dataid->content_id)->update([
            		'thumbnail' => $uploadImage['filename'],            		
            ]);
        }
		
		return redirect(urlBackendAction('index'))->withSuccess('Data has been saved');
	}

	
    public function getDelete($id)
    {
        $model = Publication::find($id);
		// dd($model);
		$article = $this->model->whereId($model->article_content_id);
		
        if(!empty($model->id))
        {
			$model->delete();
			$article->delete();
            return redirect(urlBackendAction('index'))->withSuccess('Data has been deleted');

        }else{

            return redirect('404');
        }
    }

    public function getImport()
    {
    	$model = $this->model;
    	return view('backend.master.publikasi.import', ['model' => $model]);
    }

    public function postImport(Request $request)
    {
    	// return redirect(urlBackendAction('index'))->withSuccess('Sukses Import');
    	
    	if ($request->template) {
    		
			$fileTemplate = \Helper::globalUpload($request, 'template', 'excel/publikasi');
			
            $path = public_path('contents/excel/publikasi'). '/'.$fileTemplate['filename'];
	    	
	    	$savePublikasi = $this->uploadArea->parsePublikasi($path);
	    	if ($savePublikasi) return redirect(urlBackendAction('index'))->withSuccess('Data has been imported');
		}
    	

    	return redirect(urlBackendAction('index'))->withSuccess('Failed');
    	
    }
    
}
