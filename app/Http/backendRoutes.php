<?php
	
	Route::group(['prefix' => helper()->backendUrl , 'middleware' => ['auth','right']] , function(){

		if(\Schema::hasTable('menus'))
		{
			foreach(injectModel('Menu')->where('controller','!=','#')->get() as $row)
			{	
				$controllerFile = str_replace("\\", "/", $row->controller).'.php';
				$path = app_path('Http/Controllers/Backend/'.$controllerFile);
				
				if(file_exists($path))
				{
					Route::controller($row->slug,'Backend\\'.$row->controller);
				}
					
			}

		}
	});

?>