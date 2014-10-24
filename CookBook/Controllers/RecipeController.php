<?php namespace CookBook\Controllers;

use Illuminate\Events\Dispatcher;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use CookBook\Tags\TagRepository;
use CookBook\Forms\RecipeForm;
use CookBook\Recipes\RecipeRepository;

class RecipeController extends BaseController {

	/**
	 * @var AuthManager
	 */
	protected $auth;

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
	 * @var Request
	 */
	protected $request;

	/**
	 * @param AuthManager      $auth
	 * @param RecipeRepository $recipe
	 * @param TagRepository    $tag
	 * @param Dispatcher       $dispatcher
	 * @param RecipeForm       $recipeForm
	 * @param Request          $request
	 */
	public function __construct(
		AuthManager $auth,
		RecipeRepository $recipe,
		TagRepository $tag,
		Dispatcher $dispatcher,
		RecipeForm $recipeForm,
		Request $request)
	{
		$this->auth = $auth;
		$this->recipe = $recipe;
		$this->tag = $tag;
		$this->dispatcher = $dispatcher;
		$this->recipeForm = $recipeForm;
		$this->request = $request;

		$this->beforeFilter('auth', ['except' => 'show']);
		$this->beforeFilter('recipe.owner', ['only' => 'update']);
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
		$recipe = array_add($this->request->all(), 'user_id', $this->auth->id());

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
		$input = array_add($this->request->all(), 'user_id', $this->auth->id());
		$this->recipeForm->validate($input);

		$recipe = $this->recipe->whereSlug($slug);
		$recipe = $this->recipe->edit($recipe, $input);

		return $this->redirectRoute('recipe.show', $recipe->slug);
	}

}
