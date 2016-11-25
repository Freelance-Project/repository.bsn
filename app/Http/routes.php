<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['auth.member']], function() {
	Route::get('/', 'HomeController@index');

	Route::auth();
	Route::get('/home', 'HomeController@index');
	Route::get('search/research/person','SearchController@getResearchPerson');
	Route::get('search/research/year','SearchController@getResearchYear');
	Route::get('search/publication/person','SearchController@getPublicationPerson');
	Route::get('search/publication/year','SearchController@getPublicationYear');
	Route::get('search/pendukung/year','SearchController@getPendukungYear');
	Route::get('search/find/{request?}','SearchController@getFind');
	Route::get('search/detail/{slug}','SearchController@getDetail');
	Route::get('personel/detail/{id}','PersonelController@getDetail');
	Route::controller('profile','ProfileController');
	Route::controller('request','RequestController');
	Route::controller('search','SearchController');
	Route::controller('program','ProgramController');
	Route::controller('personel','PersonelController');
});

// Route::get('/','DefaultController@getIndex');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    
	Route::controller('signin','Backend\LoginController');

	Route::get('admin-cp' , function(){
		return redirect('signin');
	});

	if(request()->segment(1) == helper()->backendUrl)
	{
		include __DIR__.'/backendRoutes.php';
	}

});




