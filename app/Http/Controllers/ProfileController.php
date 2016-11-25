<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
	{
		
		// $this->model = $news;
		// view()->share('static',$this->getStatic());
		$this->middleware('auth');
	}
	
    public function getIndex()
    {
		
		return view('frontend.member.profile');
    }

}
