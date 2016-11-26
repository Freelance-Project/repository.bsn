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
use App\Models\Researcher;
use App\Models\ResearcherTeam;
use App\Models\AdditionalData;
use App\Models\ResearchData;
use App\Models\ResearchLocation;
use Table;
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
		$model = Research::select('id' , 'year', 'title' , 'status')->orderBy('created_at', 'desc');
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
		$researcher = Researcher::lists('name','id')->toArray();
		$functional = ['p_utama'=>'Peneliti Utama','p_madya'=>'Peneliti Madya',
					'p_muda'=>'Peneliti Muda','p_pertama'=>'Peneliti Pertama',
					'non_p'=>'Non Peneliti'];
		$position = ['ketua'=>'ketua','wakil'=>'Wakil Ketua','anggota'=>'Anggota',
					'sekretariat'=>'Sekretariat','lainnya'=>'Lainnya'];
		$date = '';

		
		return view('backend.master.penelitian.form', 
			[
				'model' => $model,
				'date' => $date, 
				'group'=> false, 
				'standard'=>false,
				'researcher'=>$researcher, 
				'position'=>$position, 
				'functional'=>$functional,
				'new' =>false,
			]);
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
				'intro' => $request->intro,
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
			
			$file = str_replace("%20", " ", $request->file);
			if(!empty($file))
	        {
	        	$uploadFile = \Helper::globalUpload($request, str_slug($request->title),'files/data-penelitian', true);
				Research::whereId($saveResearch->id)->update(['file' => $uploadFile['filename']]);
	        }

		} else {
			return redirect(urlBackendAction('index'))->withSuccess('Data already exist');
		}
		

        return redirect(urlBackendAction('update/'.$saveResearch->id))->withSuccess('Data has been saved');
	}

	public function getUpdate($id)
	{
		$model  = Research::find($id);
		$date = \Helper::dbToDate($model->created_at);
		$resGroup = ResearchGroup::whereOtherId($model->id)->get();
		$resStandard = ResearchStandard::whereOtherId($model->id)->get();
		$researcher = Researcher::lists('name','id')->toArray();
		$functional = ['p_utama'=>'Peneliti Utama','p_madya'=>'Peneliti Madya',
					'p_muda'=>'Peneliti Muda','p_pertama'=>'Peneliti Pertama',
					'non_p'=>'Non Peneliti'];
		$position = ['ketua'=>'ketua','wakil'=>'Wakil Ketua','anggota'=>'Anggota',
					'sekretariat'=>'Sekretariat','lainnya'=>'Lainnya'];
		$additionalData = AdditionalData::lists('title','id')->toArray();
		$researcherTeam = ResearcherTeam::whereOtherId($model->id)->get();
		$additionalDataList = ResearchData::whereOtherId($model->id)->get();
		$locationDataList = ResearchLocation::whereResearchId($model->id)->get();

		return view('backend.master.penelitian.form' , [

			'model' => $model,
			'date' => $date,
			'group' => $resGroup,
			'standard' => $resStandard,
			'functional' => $functional,
			'position' => $position,
			'researcher' => $researcher,
			'researcherTeam'=>$researcherTeam,
			'new' =>true,
			'additionalData' => $additionalData,
			'additionalDataList' => $additionalDataList,
			'locationDataList' => $locationDataList,
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
			
		$file = str_replace("%20", " ", $request->file);
		if(!empty($file))
        {
        	$uploadFile = \Helper::globalUpload($request, str_slug($request->title),'files/data-penelitian', true);
			$dataid->update(['file' => $uploadFile['filename']]);
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

    public function getResearcher()
    {
    	// $other_id = request()->get('other_id');
    	$data['position'] = request()->get('position');
    	$data['functional'] = request()->get('functional');
    	$data['researcher_id'] = request()->get('researcher_id');
    	$data['instance'] = request()->get('instance');
    	$data['interest_category'] = request()->get('minat');
    	$data['expert_category'] = request()->get('kepakaran');
    	$data['other_id'] = request()->get('other_id');
    	$data['type'] = 'penelitian';

    	$functional = ['p_utama'=>'Peneliti Utama', 'p_madya'=>'Peneliti Madya', 'p_pertama'=>'Peneliti Pertama',
    					'p_muda'=>'Peneliti Muda','non_p'=>'Non Peneliti'];
    	if(request()->ajax()) {

			$saveResearcher = ResearcherTeam::create($data);
			$getData = ResearcherTeam::whereId($saveResearcher->id)->with('researcher')->first();
			
			$getData->position = ucfirst($getData->position);
			$getData->interest_category = strtoupper($getData->interest_category);

			$getData->functional = $functional[$getData->functional];
			// dd($getData);
			if ($saveResearcher) return response()->json(['status'=>true, 'data'=>$getData]);
			else return response()->json(['status'=>false]);
		} else {
            abort(404);
        }
    }

    public function getDeleteResearcher()
    {
    	$id = request()->get('id');
    	$delete = ResearcherTeam::whereId($id)->delete();
    	if ($delete) return response()->json(['status'=>true]);
    	else return response()->json(['status'=>false]);
    }

    public function getAdditionalData()
    {
    	// $other_id = request()->get('other_id');
    	$data['additional_data_id'] = request()->get('id');
    	$data['other_id'] = request()->get('other_id');
    	
    	if(request()->ajax()) {

			$saveAdditional = ResearchData::create($data);
			$getData = ResearchData::whereId($saveAdditional->id)->with('additional')->first();
			
			if ($saveAdditional) return response()->json(['status'=>true, 'data'=>$getData]);
			else return response()->json(['status'=>false]);
		} else {
            abort(404);
        }
    }

    public function getLocationData()
    {
    	// $other_id = request()->get('other_id');
    	$data['location'] = request()->get('id');
    	$data['research_id'] = request()->get('other_id');
    	
    	if(request()->ajax()) {

			$saveLocation = ResearchLocation::create($data);
			$getData = ResearchLocation::whereId($saveLocation->id)->first();
			// dd($getData);
			if ($saveLocation) return response()->json(['status'=>true, 'data'=>$getData]);
			else return response()->json(['status'=>false]);
		} else {
            abort(404);
        }
    }

    public function getDeleteAdditionalData()
    {
    	$id = request()->get('id');
    	$delete = ResearchData::whereId($id)->delete();
    	if ($delete) return response()->json(['status'=>true]);
    	else return response()->json(['status'=>false]);
    }

    public function getDeleteFile()
    {
    	
    	$id = request()->get('id');

    	if(request()->ajax()) {

			$update = Research::whereId($id)->update(['file'=>null]);
			if ($update) return response()->json(['status'=>true]);
			else return response()->json(['status'=>false]);
		} else {
            abort(404);
        }
    }

    public function getDeleteLocation()
    {
    	
    	$id = request()->get('id');

    	if(request()->ajax()) {

			$update = ResearchLocation::whereId($id)->delete();
			if ($update) return response()->json(['status'=>true]);
			else return response()->json(['status'=>false]);
		} else {
            abort(404);
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
