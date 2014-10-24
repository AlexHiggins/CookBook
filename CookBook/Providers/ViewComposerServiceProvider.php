<?php namespace CookBook\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Laracasts\Utilities\JavaScript\Facades\JavaScript;

class ViewComposerServiceProvider extends ServiceProvider {

	/**
	 * @return void
	 */
	public function register()
	{
		$this->app['view']->composer('disqus.messages', 'CookBook\ViewComposers\Disqus');
	}

	/**
	 * Create a few global vars...
	 */
	public function boot()
	{
		JavaScript::put(['basePath' => URL::to('/')]);

		$this->app['view']->share('signedIn', Auth::user());
		$this->app['view']->share('currentUser', Auth::user());
	}

}
