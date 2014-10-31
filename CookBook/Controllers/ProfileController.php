<?php namespace CookBook\Controllers;

use CookBook\Accounts\UserRepository;
use CookBook\Recipes\RecipeRepository;

class ProfileController extends BaseController {

	/**
	 * @var UserRepository
	 */
	protected $user;

	/**
	 * @var RecipeRepository
	 */
	protected $recipe;

	/**
	 * @param UserRepository   $user
	 * @param RecipeRepository $recipe
	 */
	public function __construct(UserRepository $user, RecipeRepository $recipe)
	{
		$this->user = $user;
		$this->recipe = $recipe;
	}

	/**
	 * @param $username
	 * @return \Illuminate\View\View
	 */
	public function show($username)
	{
		$user = $this->user->whereUserName($username);
		$recipes = $this->recipe->getByUser($user);

		return $this->view('users.show', compact('user', 'recipes'));
	}

}
