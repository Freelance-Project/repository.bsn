<?php

namespace App\Http\Controllers\Backend\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Controllers\Backend\HelperController;
use App\Models\ArticleContent;
use App\Models\Research;
use App\Models\ResearchGroup;
use App\Models\ResearchStandard;
use Table;
use Excel;
use App\Repositories\UploadArea;

class PenelitianController extends Controller
{
	public function __construct(UploadArea $upload)
	{
		$this->model = new ArticleContent;
		$this->uploadArea = $upload;
	}


	public function getIndex()
	{
		return view('backend.master.penelitian.index');
	}

	public function getData()
	{
		$model = Research::select('id' , 'title' , 'status')->orderBy('created_at', 'desc');
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
		$penelitian = Research::where(1);
		$researchgroup = ResearchGroup::where(1);
		$date = '';

		return view('backend.master.penelitian.form', ['model' => $model,'date' => $date]);
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
			'category' => $request->category,
			'status' => $request->status
		];
			
		$saveArticle = $this->model->create($valuesArticle);
		if ($saveArticle) {
			$valuesResearch = [
				'article_content_id' => $saveArticle->id,
				'title' => $request->title,
				'year' => $request->year,
				'background' => $request->background,
				'goal' => $request->goal,
				'conclusion' => $request->conclusion,
				'recommendation' => $request->recommendation,
				'recommendation_target' => $request->recommendation_target,
				'location' => $request->location,
				'created_at' => \Helper::dateToDb($request->date),
				'status' => $request->status
			];
			
			$saveResearch = Research::create($valuesResearch);
			
			if ($request->research_groups_id) {
				foreach($request->research_groups_id as $val){
					$valuesResearchGroup = [
						'other_id' => $saveResearch->id,
						'name' => $val,
						'type' => 'penelitian'
					];
					$save = ResearchGroup::create($valuesResearchGroup);
				}
			}
			
			if ($request->research_standards_id) {
				
				ResearchStandard::whereOtherId($saveResearch->id)->delete();
				
				foreach($request->research_standards_id as $val){
					$valuesResearchStandard = [
						'other_id' => $saveResearch->id,
						'name' => $val,
						'type' => 'penelitian'
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
		$model  = Research::find($id);
		$date = \Helper::dbToDate($model->created_at);
		$resGroup = ResearchGroup::whereOtherId($model->id)->get();
		$resStandard = ResearchStandard::whereOtherId($model->id)->get();
		// dd($resStandard);
		return view('backend.master.penelitian.form' , [

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
		
		$dataid = Research::whereId($id)->first();
		
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
			'background' => $request->background,
			'goal' => $request->goal,
			'conclusion' => $request->conclusion,
			'recommendation_target' => $request->recommendation_target,
			'recommendation' => $request->recommendation,
			'location' => $request->location,
			'created_at' => \Helper::dateToDb($request->date),
			'status' => $request->status,
		];


		$update = $dataid->update($values);
		
		if ($request->research_groups_id) {
			// dd($dataid);
			ResearchGroup::whereOtherId($dataid->id)->delete();
			
			foreach($request->research_groups_id as $val){
				$valuesResearchGroup = [
					'other_id' => $dataid->id,
					'name' => $val,
					'type' => 'penelitian'
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
					'type' => 'penelitian'
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
        $model = Research::find($id);
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
    	return view('backend.master.penelitian.import', ['model' => $model]);
    }

    public function postImport(Request $request)
    {
    	
    	if ($request->template) {
    		
			$fileTemplate = \Helper::globalUpload($request, 'template', 'excel/penelitian');
			
            $path = public_path('contents/excel/penelitian'). '/'.$fileTemplate['filename'];
	    	
	    	$savePenelitian = $this->uploadArea->parsePenelitian($path);
    		if ($savePenelitian) return redirect(urlBackendAction('index'))->withSuccess('Data has been imported');
		}

    	return redirect(urlBackendAction('index'))->withSuccess('Failed');
    }

    
}
