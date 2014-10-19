<?php namespace CookBook\Recipes;

use CookBook\Tags\Tag;
use CookBook\Accounts\User;
use CookBook\Core\EloquentRepository;

class RecipeRepository extends EloquentRepository {

	/**
	 * @param Recipe $model
	 */
	public function __construct(Recipe $model)
	{
		$this->model = $model;
	}

	/**
	 * @param Recipe $recipe
	 * @return Recipe
	 */
	public function increaseViewCount(Recipe $recipe)
	{
		$recipe->views++;
		$recipe->save();

		return $recipe;
	}

	/**
	 * @param $data
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function create($data)
	{
		$recipe = $this->getNew();

		$recipe->title = $data['title'];
		$recipe->code = $data['code'];
		$recipe->user_id = $data['user_id'];
		$recipe->description = $data['description'];
		$recipe->save();

		$recipe->tags()->sync($data['tags']);

		return $recipe;
	}

	/**
	 * @param Recipe $recipe
	 * @param        $data
	 * @return Recipe
	 */
	public function edit(Recipe $recipe, $data)
	{
		$recipe->title = $data['title'];
		$recipe->code = $data['code'];
		$recipe->user_id = $data['user_id'];
		$recipe->description = $data['description'];

		$recipe->save();
		$recipe->tags()->sync($data['tags']);

		return $recipe;
	}

	/**
	 * @param Tag $tag
	 * @param int $howMany
	 * @return mixed
	 */
	public function getByTag(Tag $tag, $howMany = 12)
	{
		return $tag->recipes()->latest()->paginate($howMany);
	}

	/**
	 * @param Recipe $recipe
	 * @return mixed
	 */
	public function listTagsIdsForRecipe(Recipe $recipe)
	{
		return $recipe->tags->lists('id');
	}

	/**
	 * @param User $user
	 * @param int  $howMany
	 * @return mixed
	 */
	public function getByUser(User $user, $howMany = 12)
	{
		return $user->recipes()->latest()->paginate($howMany);
	}

	/**
	 * @param int $howMany
	 * @return mixed
	 */
	public function getAllPaginated($howMany = 12)
	{
		return $this->model->with('user', 'tags')->latest()->paginate($howMany);
	}

	/**
	 * @param  string  $slug
	 * @param  mixed   $userId
	 * @return bool
	 */
	public function recipeOwnedByUser($slug, $userId)
	{
		return $this->model->whereSlug($slug)->whereUserId($userId)->exists();
	}

	/**
	 * @param $slug
	 * @return \Illuminate\Database\Eloquent\Model|static
	 */
	public function whereSlug($slug)
	{
		return $this->model->with('user', 'tags')->whereSlug($slug)->firstOrFail();
	}
}
