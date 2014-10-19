<?php namespace CookBook\Controllers;

use Illuminate\Support\Facades\View;
use CookBook\Tags\TagRepository;
use CookBook\Recipes\RecipeRepository;

class TagController extends BaseController {

	/**
	 * @var TagRepository
	 */
	protected $tag;

	/**
	 * @var RecipeRepository
	 */
	protected $recipe;

	/**
	 * @param TagRepository    $tag
	 * @param RecipeRepository $recipe
	 */
	public function __construct(TagRepository $tag, RecipeRepository $recipe)
	{
		$this->tag = $tag;
		$this->recipe = $recipe;
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$tags = $this->tag->getAllTagsWithCount();

		return View::make('tags.index', compact('tags'));
	}

	/**
	 * @param  string $slug
	 * @return \Illuminate\View\View
	 */
	public function show($slug)
	{
		$tag = $this->tag->whereSlug($slug);
		$recipes = $this->recipe->getByTag($tag);

		return View::make('tags.show', compact('tag', 'recipes'));
	}
}
