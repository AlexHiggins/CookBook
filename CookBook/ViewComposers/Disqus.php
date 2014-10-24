<?php namespace CookBook\ViewComposers;

class Disqus {

	/**
	 * @param $view
	 */
	public function compose($view)
	{
		$view->with(['shortName' => getenv('DISQUS_SHORTNAME')]);
	}

}
