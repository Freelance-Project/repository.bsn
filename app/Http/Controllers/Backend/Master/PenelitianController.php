<?php

namespace App\Http\Controllers\Backend\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Controllers\Backend\HelperController;
use App\Models\ArticleContent;
use App\Models\Research;
use Table;

class PenelitianController extends Controller
{
	public function __construct()
	{
		$this->model = new ArticleContent;
	}


	public function getIndex()
	{
		return view('backend.master.penelitian.index');
	}

	public function getData()
	{
		$model = $this->model->select('id' , 'title' , 'year');
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
		$date = '';

		return view('backend.master.penelitian.form', ['model' => $model,'date' => $date]);
	}


	public function postCreate(Request $request)
	{
		$inputs = $request->all();
		// $validation = \Validator::make($inputs , $this->model->rules());
		// if($validation->fails()) return redirect()->back()->withInput()->withErrors($validation);
		
		$valuesArticle = [
			'author_id' => \Auth::user()->id,
			'slug' => str_slug($request->title),
			'title' => $request->title,
			'year' => $request->year,
			'intro' => $request->intro,
			'category' => $request->category,
			'status' => $request->status
		];
			
		$valuesResearch = [
			'description' => $request->description,
			'purpose' => $request->purpose,
			'summary' => $request->summary,
			'recomendation' => $request->recomendation,
			'created_at' => \Helper::dateToDb($request->date),
			'slug' => str_slug($request->title),
			'status' => $request->status,
		];
			
		$save = $this->model->create($valuesArticle);
		$save = $this->model->create($valuesResearch);

		
		
		
		$image = str_replace("%20", " ", $request->image);
        if(!empty($image))
        {
            $imageName = $this->imagePrefix."-".$content_id;
			$uploadImage = \Helper::handleUpload($request, $imageName);
			
			$this->model->whereContentId($content_id)->update([
            		'thumbnail' => $uploadImage['filename'],            		
            ]);
        }
		
		if ($request->maps) {
			
			$filemaps = \Helper::globalUpload($request, 'maps');
			$this->model->whereContentId($content_id)->update([
            		'image' => $filemaps['filename'],
            ]);
		}
		
        return redirect(urlBackendAction('index'))->withSuccess('Data has been saved');
	}

	public function getUpdate($id)
	{
		$model  = $this->model->find($id);
		$date = \Helper::dbToDate($model->created_at);
		// dd($model);
		return view('backend.master.penelitian.form' , [

			'model' => $model,
			'date' => $date,
			
		]);
	}


	public function postUpdate(Request $request , $id)
	{
		$inputs = $request->all();
		$validation = \Validator::make($inputs , $this->model->rules($id));
		if($validation->fails()) return redirect()->back()->withInput()->withErrors($validation);
		
		$dataid = $this->model->whereId($id)->first();
		$values = [
			'user_id' => \Auth::user()->id,
			'title' => $request->title,
			'year' => $request->year,
			'intro' => $request->intro,
			'description' => $request->description,
			'purpose' => $request->purpose,
			'summary' => $request->summary,
			'recomendation' => $request->recomendation,
			'created_at' => \Helper::dateToDb($request->date),
			'slug' => str_slug($request->title),
			'status' => $request->status,
		];


		$update = $this->model->whereId($dataid->id)->update($values);
		
		$image = str_replace("%20", " ", $request->image);

        if(!empty($image))
        {

            $imageName = $this->imagePrefix."-".$dataid->content_id;
			$uploadImage = \Helper::handleUpload($request, $imageName);
			
			$this->model->whereContentId($dataid->content_id)->update([
            		'thumbnail' => $uploadImage['filename'],            		
            ]);
        }
		
		if ($request->maps) {
			
			$filemaps = \Helper::globalUpload($request, 'maps');
			$this->model->whereContentId($dataid->content_id)->update([
            		'image' => $filemaps['filename'],
            ]);
		}
		
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
