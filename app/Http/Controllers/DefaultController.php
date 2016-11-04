<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\ArticleContent;

class DefaultController extends Controller
{
    public function __construct(ArticleContent $article)
	{
		
		$this->model = $article;
		// view()->share('static',$this->getStatic());
		
	}
	
    public function getIndex()
    {
		return view('frontend.default.index');
    }

    

}
