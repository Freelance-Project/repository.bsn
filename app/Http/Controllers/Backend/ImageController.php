<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\HelperController;

class ImageController extends HelperController
{
    public function __construct()
    {
    	parent::__construct();
	}

    public function getIndex()
    {
    	return view('backend.library.image');
    }

    public function getLib()
    {
    	return view('backend.library.lib');
    }
}
