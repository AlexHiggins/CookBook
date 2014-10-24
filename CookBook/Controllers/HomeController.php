<?php namespace CookBook\Controllers;

use CookBook\Recipes\RecipeRepository;

class HomeController extends BaseController {

	/**
	 * @var RecipeRepository
	 */
	protected $recipe;

	/**
	 * @param RecipeRepository $recipe
	 */
	public function __construct(RecipeRepository $recipe)
	{
		$this->recipe = $recipe;
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$title = 'Most Recent Recipes';
		$recipes = $this->recipe->getAllPaginated();

		return $this->view('home.index', compact('recipes', 'title'));
	}

}
