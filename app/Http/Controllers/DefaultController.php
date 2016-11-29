<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\ArticleContent;
use App\Models\Researcher;

class DefaultController extends Controller
{
    public function __construct(ArticleContent $article)
	{
		
		$this->model = $article;
		// view()->share('static',$this->getStatic());
		// $this->middleware('auth');
	}
	
    public function getIndex()
    {
    	$data['model'] = $this->model;
    	
		return view('frontend.default.index', $data);
    }

    
    public function getPortofolio($id)
    {

    	$model = Researcher::whereId($id)->first();
    	
    	return view('backend.master.personel.portofolio', compact('model'));
    }
}
