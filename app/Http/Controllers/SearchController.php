<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct()
	{
		
		// $this->model = $news;
		// view()->share('static',$this->getStatic());
		
	}
	
    public function getIndex()
    {
		
		return view('frontend.search.search-result');
    }

    public function getCategory()
    {
		
		return view('frontend.search.search-category');
    }

    public function getDetail()
    {
		
		return view('frontend.search.search-detail');
    }
}
