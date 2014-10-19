<?php namespace CookBook\Controllers;

use CookBook\Recipes\RecipeRepository;
use Illuminate\Support\Facades\View;

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
		$recipes = $this->recipe->getAllPaginated();

		return View::make('home.index', compact('recipes'));
	}
}
