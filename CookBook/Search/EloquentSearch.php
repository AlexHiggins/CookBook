<?php namespace CookBook\Search;

use CookBook\Recipes\Recipe;
use CookBook\Contracts\Search;

class EloquentSearch implements Search {

	/**
	 * @var Recipe
	 */
	protected $recipe;

	/**
	 * @param Recipe $recipe
	 */
	public function __construct(Recipe $recipe)
	{
	  $this->recipe = $recipe;
	}

	/**
	 * @param     $term
	 * @param int $howMany
	 * @return mixed
	 */
	public function searchByTermPaginated($term, $howMany = 12)
	{
		return $this->recipe
			->orWhere('description', 'LIKE', '%'.$term.'%')
			->orWhere('title', 'LIKE', '%'.$term.'%')
			->orWhereHas('tags', function ($query) use ($term) {
					$query->where('name', 'LIKE', '%'.$term.'%');
				})
			->orWhereHas('user', function ($query) use ($term) {
					$query->where('username', 'LIKE', '%'.$term.'%');
				})
			->orderBy('created_at', 'desc')
			->orderBy('title', 'asc')
			->paginate($howMany);
	}

}
