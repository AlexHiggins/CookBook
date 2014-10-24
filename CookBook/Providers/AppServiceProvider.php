<?php namespace CookBook\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('CookBook\Contracts\Search', 'CookBook\Search\EloquentSearch');
	}

}
