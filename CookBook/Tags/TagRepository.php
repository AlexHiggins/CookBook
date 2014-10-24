<?php namespace CookBook\Tags;

use Illuminate\Support\Facades\DB;
use CookBook\Core\EloquentRepository;

class TagRepository extends EloquentRepository {

	/**
	 * @param Tag $model
	 */
	public function __construct(Tag $model)
	{
		$this->model = $model;
	}

	/**
	 * @return mixed
	 */
	public function listAll()
	{
		return $this->model->lists('name', 'id');
	}

	/**
	 * @return mixed
	 */
	public function getAllTagsWithCount()
	{
		return $this->model
			->leftJoin('recipe_tag', 'tags.id', '=', 'recipe_tag.tag_id')
			->leftJoin('recipes', 'recipe_tag.recipe_id', '=','recipes.id')
			->groupBy('tags.slug')
			->orderBy('count', 'desc')
			->get(['tags.name', 'tags.id', 'tags.slug', DB::raw('COUNT(recipes.id) as count')]);
	}

}
