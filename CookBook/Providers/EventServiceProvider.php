<?php namespace CookBook\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * @return void
	 */
	public function register()
	{
		$this->app['events']->listen('recipe.viewed', 'CookBook\Events\RecipeSubscriber@recipeViewed');
	}
}
