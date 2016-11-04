<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use \App\Models\ArticleContent;
use \App\Models\AdditionalData;
use \App\Models\Researcher;

class SearchController extends Controller
{
    public function __construct()
	{
		
		// $this->model = $news;
		// view()->share('static',$this->getStatic());
		$this->paging = 5;
	}
	
	public function getFind(Request $request)
    {
    	// dd($request);
		$requestParam = $request->all();
		// dd($requestParam);
		$data['result'] = ArticleContent::where('title','like','%'.$requestParam['request'].'%')->whereIn('status',['publish','unpublish'])->paginate($this->paging);
		// dd($data['result'][4]->research);
		$data['request'] = $requestParam['request'];
		return view('frontend.search.search-result', compact('data'));
    }

    public function getCategory()
    {
		
		return view('frontend.search.search-category');
    }

    public function getDetail($slug)
    {
		$model = ArticleContent::whereSlug($slug)->first();

		return view('frontend.search.search-detail', compact('model'));
    }

    public function getRead($slug)
    {
    	$model = ArticleContent::whereSlug($slug)->first();

		return view('frontend.search.search-read', compact('model'));
    }

    public function getPenelitian(Request $request)
    {
    	$requestParam = $request->all();
		$data['request'] = false;
		$data['category'] = 1;

		if (isset($requestParam['request'])) {
			$data['result'] = ArticleContent::where('title','like','%'.$requestParam['request'].'%')->whereCategory('penelitian')->paginate($this->paging);
			$data['request'] = $requestParam['request'];
		} else {
			$data['result'] = ArticleContent::whereCategory('penelitian')->paginate($this->paging);
		}
		
		// dd($data);
		
    	return view('frontend.search.search-category', compact('data'));
    }

    public function getPublikasi(Request $request)
    {
    	$requestParam = $request->all();
		$data['request'] = false;
		$data['category'] = 2;

		if (isset($requestParam['request'])) {
			$data['result'] = ArticleContent::where('title','like','%'.$requestParam['request'].'%')->whereCategory('publikasi')->paginate($this->paging);
			$data['request'] = $requestParam['request'];
		} else {
			$data['result'] = ArticleContent::whereCategory('publikasi')->paginate($this->paging);
		}
		
		return view('frontend.search.search-category', compact('data'));
    }

    public function getPendukung(Request $request)
    {
    	$requestParam = $request->all();
		$data['request'] = false;
		$data['category'] = 3;

		if (isset($requestParam['request'])) {
			$data['result'] = AdditionalData::where('title','like','%'.$requestParam['request'].'%')->paginate($this->paging);
			$data['request'] = $requestParam['request'];
		} else {
			$data['result'] = AdditionalData::paginate($this->paging);
		}
		
		return view('frontend.search.search-category', compact('data'));
    }

    public function getPersonel(Request $request)
    {
    	$requestParam = $request->all();
		$data['request'] = false;
		$data['category'] = 4;

		if (isset($requestParam['request'])) {
			$data['result'] = Researcher::where('name','like','%'.$requestParam['request'].'%')->paginate($this->paging);
			$data['request'] = $requestParam['request'];
		} else {
			$data['result'] = Researcher::paginate($this->paging);
		}
		
		return view('frontend.search.search-category', compact('data'));
    }
}
