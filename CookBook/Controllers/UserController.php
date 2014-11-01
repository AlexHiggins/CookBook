<?php namespace CookBook\Controllers;

use CookBook\Forms\UpdateProfileForm;
use Illuminate\Support\Facades\Input;
use CookBook\Accounts\UserRepository;
use CookBook\Recipes\RecipeRepository;
use Laracasts\Flash\FlashNotifier;

class UserController extends BaseController {

	/**
	 * @var UserRepository
	 */
	protected $user;

	/**
	 * @var RecipeRepository
	 */
	protected $recipe;

	/**
	 * @var FlashNotifier
	 */
	protected $notifier;

	/**
	 * @var UpdateProfileForm
	 */
	protected $updateProfileForm;

	/**
	 * @param UserRepository    $user
	 * @param RecipeRepository  $recipe
	 * @param FlashNotifier     $notifier
	 * @param UpdateProfileForm $updateProfileForm
	 */
	public function __construct(
		UserRepository $user,
		RecipeRepository $recipe,
		FlashNotifier $notifier,
		UpdateProfileForm $updateProfileForm)
	{
		$this->user = $user;
		$this->recipe = $recipe;
		$this->notifier = $notifier;
		$this->updateProfileForm = $updateProfileForm;

		$this->beforeFilter('csrf', [ 'on' => 'post' ]);
		$this->beforeFilter('profile.owner', ['only' => ['update', 'edit']]);
	}

	/**
	 * @param $username
	 * @return \Illuminate\View\View
	 */
	public function show($username)
	{
		$user = $this->user->whereUserName($username);
		$recipes = $this->recipe->getByUser($user);

		return $this->view('user.show', compact('user', 'recipes'));
	}

	/**
	 * @param $username
	 * @return \Illuminate\View\View
	 */
	public function edit($username)
	{
		$user = $this->user->whereUserName($username);

		return $this->view('user.edit', compact('user'));
	}

	/**
	 * @param $username
	 * @return \Illuminate\View\View
	 */
	public function update($username)
	{
		$input = Input::get();
		$this->updateProfileForm->validate($input);

		$user = $this->user->whereUserName($username);
		$user = $this->user->update($user, $input);
		$this->notifier->success('Your profile has been updated!');

		return $this->redirectRoute('user.edit', $user->username);
	}

}
