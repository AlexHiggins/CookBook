<?php namespace CookBook\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Events\Dispatcher;
use CookBook\Tags\TagRepository;
use CookBook\Forms\RecipeForm;
use Laracasts\Flash\FlashNotifier;
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
	 * @var FlashNotifier
	 */
	protected $notifier;

	/**
	 * @param RecipeRepository $recipe
	 * @param TagRepository    $tag
	 * @param Dispatcher       $dispatcher
	 * @param RecipeForm       $recipeForm
	 * @param FlashNotifier    $notifier
	 */
	public function __construct(
		RecipeRepository $recipe,
		TagRepository $tag,
		Dispatcher $dispatcher,
		RecipeForm $recipeForm,
		FlashNotifier $notifier)
	{
		$this->recipe = $recipe;
		$this->tag = $tag;
		$this->dispatcher = $dispatcher;
		$this->recipeForm = $recipeForm;
		$this->notifier = $notifier;

		$this->beforeFilter('auth', ['except' => 'show']);
		$this->beforeFilter('recipe.owner', ['only' => ['update', 'edit']]);
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		$tags = $this->tag->listAll();

		return $this->view('recipe.create', compact('tags'));
	}

	/**
	 * @return mixed
	 * @throws \Laracasts\Validation\FormValidationException
	 */
	public function store()
	{
		$recipe = array_add(Input::all(), 'user_id', Auth::id());

		$this->recipeForm->validate($recipe);
		$recipe = $this->recipe->create($recipe);

		return $this->redirectRoute('recipe.show', $recipe->slug);
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

		return $this->view('recipe.show', compact('recipe'));
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

		return $this->view('recipe.edit', compact('recipe', 'tags', 'selectedTags'));
	}

	/**
	 * @param $slug
	 * @return mixed
	 * @throws \Laracasts\Validation\FormValidationException
	 */
	public function update($slug)
	{
		$input = array_add(Input::all(), 'user_id', Auth::id());
		$this->recipeForm->validate($input);

		$recipe = $this->recipe->whereSlug($slug);
		$recipe = $this->recipe->edit($recipe, $input);

		return $this->redirectRoute('recipe.show', $recipe->slug);
	}

}
