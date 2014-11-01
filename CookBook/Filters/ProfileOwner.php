<?php namespace CookBook\Filters;

use Illuminate\Auth\AuthManager;
use Illuminate\Routing\Redirector;
use CookBook\Recipes\RecipeRepository;

class ProfileOwner {

	/**
	 * @var AuthManager
	 */
	protected $auth;

	/**
	 * @var RecipeRepository
	 */
	protected $redirect;

	/**
	 * @param AuthManager      $auth
	 * @param Redirector       $redirect
	 */
	public function __construct(AuthManager $auth, Redirector $redirect)
	{
		$this->auth = $auth;
		$this->redirect = $redirect;
	}

	/**
	 * @param $route
	 * @return mixed
	 */
	public function filter($route)
	{
		$username = $this->auth->user()->username;
		$profileOwner = $route->getParameter('user');

		if ($username != $profileOwner)
		{
			return $this->redirect->route('home');
		}
	}

}
