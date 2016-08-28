<?php namespace App\Helper\Src;

use Illuminate\Support\ServiceProvider;
use App\Helper\Src\Helper;

class HelperProvider extends ServiceProvider
{
	public function boot()
	{
		$this->mergeConfigFrom(config_path('path.php'),'path');
	}

	public function register()
	{
		$this->app->bind('register-demo',function(){
			return new Helper;
		});
	}
}

?>