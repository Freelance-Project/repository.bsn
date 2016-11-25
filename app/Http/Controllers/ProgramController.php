<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use \App\Models\Software;

class ProgramController extends Controller
{
    public function __construct(Software $program)
	{
		
		$this->model = $program;
		$this->middleware('auth');
	}
	
    public function getIndex()
    {
		
		$data['program'] = $this->model->get();

		return view('frontend.program.index', $data);
    }

}
