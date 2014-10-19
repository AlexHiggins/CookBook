<?php namespace CookBook\Filters;

use Illuminate\Auth\AuthManager;
use Illuminate\Routing\Redirector;
use CookBook\Recipes\RecipeRepository;

class RecipeOwner {

	/**
	 * @var AuthManager
	 */

	protected $auth;
	/**
	 * @var RecipeRepository
	 */

	protected $redirect;

	/**
	 * @var
	 */
	protected $recipe;

	/**
	 * @param AuthManager      $auth
	 * @param Redirector       $redirect
	 * @param RecipeRepository $recipe
	 */
	public function __construct(AuthManager $auth, Redirector $redirect, RecipeRepository $recipe)
	{
		$this->auth = $auth;
		$this->redirect = $redirect;
		$this->recipe = $recipe;
	}

	/**
	 * @param $route
	 * @return mixed
	 */
	public function filter($route)
	{
		$userId = $this->auth->user()->id;
		$slug = $route->getParameter('recipe');

		if ( ! $this->recipe->recipeOwnedByUser($slug, $userId))
		{
			return $this->redirect->route('home');
		}
	}
}
