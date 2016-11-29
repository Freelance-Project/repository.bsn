<?php

namespace App\Http\Controllers\Backend\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Controllers\Backend\HelperController;
use App\Models\Researcher;
use App\Models\ResearcherWorkshop;
use App\Models\InterestGroup;
use App\Models\Expertise;
use Table;
use App\Repositories\UploadArea;

class PersonelController extends Controller
{
	public function __construct(UploadArea $upload)
	{
		$this->model = new Researcher;
		$this->uploadArea = $upload;
	}


	public function getIndex()
	{
		return view('backend.master.personel.index');
	}

	public function getData()
	{
		$model = $this->model->select('id' ,'name' , 'email');
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
		$date = '';
		$interest = InterestGroup::lists('name','id')->toArray();
		$expertise = Expertise::where('name','!=','')->lists('name','id')->toArray();
		// dd($expertise);
		return view('backend.master.personel.form', 
				['model' => $model,'date' => $date, 'new'=>false, 'interest' => $interest,
				'expertise'=>$expertise]
		);
	}


	public function postCreate(Request $request)
	{
		$inputs = $request->all();
		
		$values = [
			'name' => $request->name,
			'birthplace' => $request->birthplace,
			'dob' => $request->dob,
			'position' => $request->position,
			'grade' => $request->grade,
			'phone' => $request->phone,
			'email' => $request->email,
			'education' => $request->education,
			'experience' => $request->experience,
			'status' => $request->status,
			'address' => $request->address,
			'interest_category' => implode(',', $request->research_groups_id),
			'expert_category' => implode(',', $request->expert_category_id),
		];
		// dd($values);
		$save = $this->model->create($values);
		
		return redirect(urlBackendAction('update/'.$save->id))->withSuccess('Data has been saved');
	}

	public function getUpdate($id)
	{
		$model  = $this->model->find($id);
		$date = \Helper::dbToDate($model->created_at);
		$diklat = ResearcherWorkshop::where('researcher_id','=',$id)->get();
		$interest = InterestGroup::lists('name','id')->toArray();
		$expertise = Expertise::where('name','!=','')->lists('name','id')->toArray();

		return view('backend.master.personel.form' , [

			'model' => $model,
			'date' => $date,
			'diklat' => $diklat,
			'new' => true,
			'interest' => $interest,
			'expertise' => $expertise,
		]);
	}


	public function postUpdate(Request $request , $id)
	{
		$inputs = $request->all();
		// $validation = \Validator::make($inputs , $this->model->rules($id));
		// if($validation->fails()) return redirect()->back()->withInput()->withErrors($validation);
		
		$dataid = $this->model->whereId($id)->first();
		$values = [
			'name' => $request->name,
			'birthplace' => $request->birthplace,
			'dob' => $request->dob,
			'position' => $request->position,
			'grade' => $request->grade,
			'phone' => $request->phone,
			'email' => $request->email,
			'education' => $request->education,
			'experience' => $request->experience,
			'status' => $request->status,
			'address' => $request->address,
			'interest_category' => implode(',', $request->research_groups_id),
			'expert_category' => implode(',', $request->expert_category_id),
		];


		$update = $this->model->whereId($dataid->id)->update($values);
		
		return redirect(urlBackendAction('index'))->withSuccess('Data has been saved');
	}

	
    public function getDelete($id)
    {
        $model = $this->model->find($id);
		
        if(!empty($model->id))
        {
        	ResearcherWorkshop::where('researcher_id','=',$model->id)->delete();
        	
			$model->delete();
            return redirect(urlBackendAction('index'))->withSuccess('Data has been deleted');

        }else{

            return redirect('404');
        }
    }

    public function getImport()
    {
    	$model = $this->model;
    	return view('backend.master.personel.import', ['model' => $model]);
    }

    public function postImport(Request $request)
    {
    	if ($request->template) {
    		
			$fileTemplate = \Helper::globalUpload($request, 'template', 'excel/personel');
			
            $path = public_path('contents/excel/personel'). '/'.$fileTemplate['filename'];
	    	
	    	$savePerson = $this->uploadArea->parsePersonel($path);
    		if ($savePerson) return redirect(urlBackendAction('index'))->withSuccess('Data has been imported');
		}

    	return redirect(urlBackendAction('index'))->withSuccess('Failed');
    }

    public function getDiklat()
    {

    	$data['time'] = request()->get('waktu');
    	$data['name'] = request()->get('nama');
    	$data['organizer'] = request()->get('penyelenggara');
    	$data['sertificate'] = request()->get('sertifikat');
    	$data['type'] = request()->get('kategori');
    	$data['researcher_id'] = request()->get('personel_id');
		
		// dd($data);
		if(request()->ajax()) {
			$saveDiklat = ResearcherWorkshop::create($data);
			$getData = ResearcherWorkshop::whereId($saveDiklat->id)->first();
			// dd($getData);
			if ($saveDiklat) return response()->json(['status'=>true, 'data'=>$getData]);
			else return response()->json(['status'=>false]);
		} else {
            abort(404);
        }
    }

    public function getDeleteDiklat()
    {
    	$id = request()->get('id');
    	$delete = ResearcherWorkshop::whereId($id)->delete();
    	if ($delete) return response()->json(['status'=>true]);
    	else return response()->json(['status'=>false]);
    }
    
    public function getPortofolio($id)
    {

    	$model = $this->model->find($id);
    	
    	return view('backend.master.personel.portofolio', compact('model'));
    }
}
