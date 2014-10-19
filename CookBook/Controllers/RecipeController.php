<?php namespace CookBook\Controllers;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use CookBook\Tags\TagRepository;
use CookBook\Forms\RecipeForm;
use CookBook\Recipes\RecipeRepository;

class RecipeController extends BaseController {

	/**
	 * @var RecipeRepository
	 */
	protected $recipe;

	/**
	 * @var TagRepository
	 */
	protected $tag;

	/**
	 * @var Dispatcher
	 */
	protected $dispatcher;

	/**
 * @var RecipeForm
 */
	protected $recipeForm;

	/**
	 * @param RecipeRepository $recipe
	 * @param TagRepository    $tag
	 * @param Dispatcher       $dispatcher
	 * @param RecipeForm $recipeForm
	 */
	public function __construct(
		RecipeRepository $recipe,
		TagRepository $tag,
		Dispatcher $dispatcher,
		RecipeForm $recipeForm)
	{
		$this->recipe = $recipe;
		$this->tag = $tag;
		$this->dispatcher = $dispatcher;
		$this->recipeForm = $recipeForm;

		$this->beforeFilter('auth', ['except' => 'show']);
		$this->beforeFilter('recipe.owner', ['only' => 'update']);
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		$tags = $this->tag->listAll();

		return View::make('recipe.create', compact('tags'));
	}

	/**
	 * @return mixed
	 * @throws \Laracasts\Validation\FormValidationException
	 * @return \Illuminate\View\View
	 */
	public function store()
	{
		$recipe = array_add(Input::get(), 'user_id', Auth::id());

		$this->recipeForm->validate($recipe);
		$recipe = $this->recipe->create($recipe);

		return Redirect::route('recipe.show', $recipe->slug);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param            $slug
	 * @return \Illuminate\View\View
	 */
	public function show($slug)
	{
		$recipe = $this->recipe->whereSlug($slug);

		$this->dispatcher->fire('recipe.viewed', $recipe);

		return View::make('recipe.show', compact('recipe'));
	}

	/**
	 * @param $slug
	 * @return \Illuminate\View\View
	 */
	public function edit($slug)
	{
		$tags = $this->tag->listAll();
		$recipe = $this->recipe->whereSlug($slug);
		$selectedTags = $this->recipe->listTagsIdsForRecipe($recipe);

		return View::make('recipe.edit', compact('recipe', 'tags', 'selectedTags'));
	}

	/**
	 * @param $slug
	 * @throws \Laracasts\Validation\FormValidationException
	 * @return \Illuminate\View\View
	 */
	public function update($slug)
	{
		$input = array_add(Input::get(), 'user_id', Auth::id());
		$this->recipeForm->validate($input);

		$recipe = $this->recipe->whereSlug($slug);
		$recipe = $this->recipe->edit($recipe, $input);

		return Redirect::route('recipe.show', $recipe->slug);
	}
}
