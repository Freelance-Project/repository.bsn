<?php

namespace App\Http\Controllers\Backend\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Controllers\Backend\HelperController;
use App\Models\Software;
use Table;

class ProgramController extends Controller
{
	public function __construct()
	{
		$this->model = new Software;
		$this->category = 18;
	}


	public function getIndex()
	{
		return view('backend.master.program.index');
	}

	public function getData()
	{
		$model = $this->model->select('id' , 'name');
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

		return view('backend.master.program.form', ['model' => $model,'date' => $date]);
	}


	public function postCreate(Request $request)
	{
		
		$values = [
			'name' => $request->name,
			'file' => $request->file,
			'status' => $request->status,
		];
			
		$save = $this->model->create($values);
		
		return redirect(urlBackendAction('index'))->withSuccess('Data has been saved');
	}

	public function getUpdate($id)
	{
		$model  = $this->model->find($id);
		$date = \Helper::dbToDate($model->created_at);
		
		return view('backend.master.program.form' , [

			'model' => $model,
			'date' => $date,
			
		]);
	}


	public function postUpdate(Request $request , $id)
	{
		
		$dataid = $this->model->whereId($id)->first();
		$values = [
			'name' => $request->name,
			'file' => $request->file,
			'status' => $request->status,
		];


		$update = $this->model->whereId($dataid->id)->update($values);
		
		return redirect(urlBackendAction('index'))->withSuccess('Data has been saved');
	}

	
    public function getDelete($id)
    {
        $model = $this->model->find($id);
		
        if(!empty($model->id))
        {
			$model->delete();
            return redirect(urlBackendAction('index'))->withSuccess('Data has been deleted');

        }else{

            return redirect('404');
        }
    }

    
}
