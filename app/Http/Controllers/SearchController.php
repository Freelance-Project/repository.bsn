<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use \App\Models\ArticleContent;
use \App\Models\AdditionalData;
use \App\Models\Researcher;
use \App\Models\Research;
use \App\Models\ResearcherTeam;
use \App\Models\Publication;
use \App\Helper\Src\Pagination;
class SearchController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
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
		// dd($data['result'][0]->research);
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

    	if ($model->category == 'penelitian') {
    		$filename = $model->research->file;
    		$link = "https://docs.google.com/gview?url=".url('files/'.$filename)."&embedded=true";
    		// dd($link);
    	}
		return view('frontend.search.search-read', compact('link', 'model'));
    }

    public function getResearch(Request $request)
    {
    	$requestParam = $request->all();
		$data['request'] = false;
		$data['category'] = 'penelitian';
		$data['tab'] = 'title';
		$data['class'] = 'research';

		if (isset($requestParam['request'])) {
			$data['result'] = ArticleContent::where('title','like','%'.$requestParam['request'].'%')->whereCategory($data['category'])->orderBy('year')->paginate($this->paging);
			$data['request'] = $requestParam['request'];

			$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->whereRaw('title like % ? %', [$requestParam['request']])
    							->groupBy('category','year')->orderBy('year')->get();
		} else {
			$data['result'] = ArticleContent::whereCategory($data['category'])->orderBy('year')->paginate($this->paging);
			
			$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->groupBy('category','year')->orderBy('year')->get();
		}
		// dd($chart);
		$chartdata['title'] = 'Penelitian';
		
		$data['chart'] = $this->makeChart($chartdata);
		// dd($data);
    	return view('frontend.search.search-category', compact('data'));
    }

    public function getResearcher(Request $request)
    {

    	$requestParam = $request->all();
		$data['request'] = false;
		$data['category'] = 'penelitian';
		$data['tab'] = 'peneliti';

		if (isset($requestParam['request'])) {
			$data['result'] = Researcher::where('name','like','%'.$requestParam['request'].'%')->whereStatus('active')->paginate($this->paging);
			$data['request'] = $requestParam['request'];

			$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->whereRaw('title like % ? %', [$requestParam['request']])
    							->groupBy('category','year')->get();
		} else {
			$data['result'] = Researcher::whereStatus('active')->paginate($this->paging);
			
			$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->groupBy('category','year')->get();
		}
		// dd($data);
		$chartdata['title'] = 'Penelitian';
		
		$data['chart'] = $this->makeChart($chartdata);
		// dd($data);
    	return view('frontend.search.search-category', compact('data'));
    }

    public function makeChart($data)
    {
    	// dd($data);
    	
    	
		foreach ($data['result'] as $val) {

			$tmp[$val->year][$val->category] = $val->total;

		}

		foreach ($tmp as $key => $value) {
			$chart['category'][] = $key;
			if (isset($value['penelitian'])) $chart['penelitian'][] = intval($value['penelitian']);
			else $chart['penelitian'][] = 0;
			if (isset($value['publikasi'])) $chart['publikasi'][] = intval($value['publikasi']);
			else $chart['publikasi'][] = 0;
			if (isset($value['pendukung'])) $chart['pendukung'][] = intval($value['pendukung']);
			else $chart['pendukung'][] = 0;
		}
	
    	
    	// dd($chart);
    	return json_encode($chart);
    }

    public function getPublication(Request $request)
    {
    	$requestParam = $request->all();
		$data['request'] = false;
		$data['category'] = 'publikasi';
		$data['tab'] = 'judul';
		$data['class'] = 'publication';

		if (isset($requestParam['request'])) {
			$data['result'] = ArticleContent::where('title','like','%'.$requestParam['request'].'%')->whereCategory($data['category'])->paginate($this->paging);
			$data['request'] = $requestParam['request'];

			$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->whereRaw('title like % ? %', [$requestParam['request']])
    							->groupBy('category','year')->get();
		} else {
			$data['result'] = ArticleContent::whereCategory($data['category'])->paginate($this->paging);
			
			$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->groupBy('category','year')->get();
		}
		// dd($chart);
		$chartdata['title'] = 'Publikasi';
		
		$data['chart'] = $this->makeChart($chartdata);
		// dd($data);
		return view('frontend.search.search-category', compact('data'));
    }

    public function getPendukung(Request $request)
    {
    	$requestParam = $request->all();
		$data['request'] = false;
		$data['category'] = 'pendukung';
		$data['tab'] = 'judul';
		$data['class'] = 'pendukung';

		if (isset($requestParam['request'])) {
			$data['result'] = ArticleContent::where('title','like','%'.$requestParam['request'].'%')->whereCategory($data['category'])->paginate($this->paging);
			$data['request'] = $requestParam['request'];

			$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->whereRaw('title like % ? %', [$requestParam['request']])
    							->groupBy('category','year')->get();
		} else {
			$data['result'] = ArticleContent::whereCategory($data['category'])->orderBy('year','desc')->orderBy('title')->paginate($this->paging);
			
			$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->groupBy('category','year')->orderBy('year')->get();
		}
		// dd($chart);
		$chartdata['title'] = 'Pendukung';
		
		$data['chart'] = $this->makeChart($chartdata);

		return view('frontend.search.search-pendukung', compact('data'));
    }

    public function getPersonel(Request $request)
    {
    	$requestParam = $request->all();
		$data['request'] = false;
		$data['category'] = 'personel';
		$data['tab'] = 'judul';
		$data['class'] = 'personel';

		if (isset($requestParam['request'])) {
			$data['result'] = Researcher::where('name','like','%'.$requestParam['request'].'%')->paginate($this->paging);
			$chartdata['result'] = Researcher::where('name','like','%'.$requestParam['request'].'%')->paginate($this->paging);
			$data['request'] = $requestParam['request'];
		} else {
			$data['result'] = Researcher::paginate($this->paging);
			$chartdata['result'] = Researcher::paginate($this->paging);

			// $getList = Publication::select('publications.id')->join('article_contents', 'publications.article_content_id','=', 'article_contents.id')->where('article_contents.category',$data['category'])->where('article_contents.status','publish')->get();
			// if($getList) {
			// 	foreach ($getList as $key => $value) {
			// 		$personId[] = $value->id;
			// 	}
			// 	$data['result'] = ResearcherTeam::whereIn('other_id', $personId)->paginate($this->paging);

			// }

		}
		// dd($data);
		$chartdata['title'] = 'Personel';
		
		$data['chart'] = $this->makeChart($chartdata);

		return view('frontend.search.search-personel', compact('data'));
    }

    public function postAdvance(Request $request)
    {
    	
    	$inputs = $request->all();
    	// dd($inputs);
    	$field = 'status = ? ';
    	$value[] = 'publish';

    	if (isset($inputs['tahun_mulai'])) {
    		$field .= 'and year >= ? ';
    		$value[] = $inputs['tahun_mulai'];
    	}
    	if (isset($inputs['tahun_akhir'])) {
    		$field .= 'and year <= ? ';
    		$value[] = $inputs['tahun_akhir'];
    	}
    	if (isset($inputs['category']['penelitian'])) {
    		$field .= 'and category = ? ';
    		$value[] = 'penelitian';
    	}
    	if (isset($inputs['category']['publikasi'])) {
    		$field .= 'and category = ? ';
    		$value[] = 'publikasi';
    	}
    	
    	$data['request'] = false;
		$data['category'] = 4;

    	$data['result'] = ArticleContent::selectRaw(' *')
    			->whereRaw($field, $value)->paginate($this->paging);
    	
    	$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->whereRaw($field, $value)
    							->groupBy('category','year')->get();

    	$chartdata['title'] = 'Penelitian';
    	$data['chart'] = $this->makeChart($chartdata);

    	return view('frontend.search.search-advance', compact('data'));
    }

    public function getResearchPerson(Request $request)
    {
    	$requestParam = $request->all();
		$data['request'] = false;
		$data['category'] = 'penelitian';
		$data['tab'] = 'person';
		$data['class'] = 'research';

		if (isset($requestParam['request'])) {

			$data['result'] = ArticleContent::where('title','like','%'.$requestParam['request'].'%')->whereCategory($data['category'])->orderBy('year')->paginate($this->paging);
			$data['request'] = $requestParam['request'];

			$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->whereRaw('title like % ? %', [$requestParam['request']])
    							->groupBy('category','year')->orderBy('year')->get();
		} else {
			$getList = Research::select('researches.id')->join('article_contents', 'researches.article_content_id','=', 'article_contents.id')->where('article_contents.category',$data['category'])->where('article_contents.status','publish')->get();
			// dd($getList);
			if($getList) {
				foreach ($getList as $key => $value) {
					$personId[] = $value->id;
				}
				$data['result'] = ResearcherTeam::whereIn('other_id', $personId)->paginate($this->paging);

			}
			// $data['result'] = ArticleContent::whereCategory($data['category'])->orderBy('year')->paginate($this->paging);
			
			$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->groupBy('category','year')->orderBy('year')->get();
		}
		// dd($chart);
		$chartdata['title'] = 'Penelitian';
		
		$data['chart'] = $this->makeChart($chartdata);
		// dd($data);
    	return view('frontend.search.search-by-person', compact('data'));
    }

    public function getPublicationPerson(Request $request)
    {
    	$requestParam = $request->all();
		$data['request'] = false;
		$data['category'] = 'publikasi';
		$data['tab'] = 'person';
		$data['class'] = 'publication';

		if (isset($requestParam['request'])) {

			$data['result'] = ArticleContent::where('title','like','%'.$requestParam['request'].'%')->whereCategory($data['category'])->orderBy('year')->paginate($this->paging);
			$data['request'] = $requestParam['request'];

			$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->whereRaw('title like % ? %', [$requestParam['request']])
    							->groupBy('category','year')->orderBy('year')->get();
		} else {
			$getList = Publication::select('publications.id')->join('article_contents', 'publications.article_content_id','=', 'article_contents.id')->where('article_contents.category',$data['category'])->where('article_contents.status','publish')->get();
			// dd($getList);
			if($getList) {
				foreach ($getList as $key => $value) {
					$personId[] = $value->id;
				}
				$data['result'] = ResearcherTeam::whereIn('other_id', $personId)->paginate($this->paging);

			}
			// $data['result'] = ArticleContent::whereCategory($data['category'])->orderBy('year')->paginate($this->paging);
			
			$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->groupBy('category','year')->orderBy('year')->get();
		}
		// dd($chart);
		$chartdata['title'] = 'Penelitian';
		
		$data['chart'] = $this->makeChart($chartdata);
		// dd($data);
    	return view('frontend.search.search-by-person', compact('data'));
    }

    public function getResearchYear(Request $request)
    {
    	$requestParam = $request->all();
		$data['request'] = false;
		$data['category'] = 'penelitian';
		$data['tab'] = 'year';
		$data['class'] = 'research';

		if (isset($requestParam['request'])) {

			$data['result'] = ArticleContent::where('title','like','%'.$requestParam['request'].'%')->whereCategory($data['category'])->orderBy('year')->paginate($this->paging);
			$data['request'] = $requestParam['request'];

			$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->whereRaw('title like % ? %', [$requestParam['request']])
    							->groupBy('category','year')->orderBy('year')->get();
		} else {
			$getList = ArticleContent::where('category',$data['category'])->where('status','publish')->orderBy('year','desc')->paginate($this->paging);
			// dd($getList);
			if($getList) {
				foreach ($getList as $key => $value) {
					$year[$value->year][] = $value;
				}

				
				$data['result_year'] = $year;

			}
			$data['result'] = $getList;
			// $data['result'] = ArticleContent::whereCategory($data['category'])->orderBy('year')->paginate($this->paging);
			
			$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->groupBy('category','year')->orderBy('year')->get();
		}
		// dd($chart);
		$chartdata['title'] = 'Penelitian';
		
		$data['chart'] = $this->makeChart($chartdata);
		// dd($data);
    	return view('frontend.search.search-by-year', compact('data'));
    }

    public function getPublicationYear(Request $request)
    {
    	$requestParam = $request->all();
		$data['request'] = false;
		$data['category'] = 'publikasi';
		$data['tab'] = 'year';
		$data['class'] = 'publication';

		if (isset($requestParam['request'])) {

			$data['result'] = ArticleContent::where('title','like','%'.$requestParam['request'].'%')->whereCategory($data['category'])->orderBy('year')->paginate($this->paging);
			$data['request'] = $requestParam['request'];

			$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->whereRaw('title like % ? %', [$requestParam['request']])
    							->groupBy('category','year')->orderBy('year')->get();
		} else {
			$getList = ArticleContent::where('category',$data['category'])->where('status','publish')->orderBy('year','desc')->paginate($this->paging);
			// dd($getList);
			if($getList) {
				foreach ($getList as $key => $value) {
					$year[$value->year][] = $value;
				}

				
				$data['result_year'] = $year;

			}
			$data['result'] = $getList;
			// $data['result'] = ArticleContent::whereCategory($data['category'])->orderBy('year')->paginate($this->paging);
			
			$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->groupBy('category','year')->orderBy('year')->get();
		}
		// dd($chart);
		$chartdata['title'] = 'Publikasi';
		
		$data['chart'] = $this->makeChart($chartdata);
		// dd($data);
    	return view('frontend.search.search-by-year', compact('data'));
    }

    public function getPendukungYear(Request $request)
    {
    	$requestParam = $request->all();
		$data['request'] = false;
		$data['category'] = 'pendukung';
		$data['tab'] = 'judul';
		$data['class'] = 'pendukung';

		if (isset($requestParam['request'])) {
			$data['result'] = ArticleContent::where('title','like','%'.$requestParam['request'].'%')->whereCategory($data['category'])->paginate($this->paging);
			$data['request'] = $requestParam['request'];

			$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->whereRaw('title like % ? %', [$requestParam['request']])
    							->groupBy('category','year')->get();
		} else {
			$getList = ArticleContent::whereCategory($data['category'])->whereStatus('publish')->orderBy('year','desc')->orderBy('title')->paginate($this->paging);
			if($getList) {
				foreach ($getList as $key => $value) {
					$year[$value->year][] = $value;
				}

				
				$data['result_year'] = $year;

			}
			$data['result'] = $getList;

			$chartdata['result'] = ArticleContent::selectRaw(' count(title) as total, category, year')
    							->groupBy('category','year')->get();
		}
		// dd($chart);
		$chartdata['title'] = 'Pendukung';
		
		$data['chart'] = $this->makeChart($chartdata);

		return view('frontend.search.search-by-year', compact('data'));
    }
}
