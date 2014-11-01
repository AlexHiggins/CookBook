<?php namespace CookBook\Events;

use CookBook\Recipes\RecipeRepository;

class RecipeViewed {

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
	 * Increase the view count of a recipe
	 *
	 * @param $recipe
	 * @return \CookBook\Recipes\Recipe
	 */
	public function handle($recipe)
	{
		return $this->recipe->increaseViewCount($recipe);
	}

}
