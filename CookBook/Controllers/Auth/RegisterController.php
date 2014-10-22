<?php namespace CookBook\Controllers\Auth;

use Laracasts\Flash\Flash;
use CookBook\Forms\RegisterForm;
use CookBook\Accounts\UserRepository;
use CookBook\Controllers\BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class RegisterController extends BaseController {

	/**
	 * @var UserRepository
	 */
	protected $user;

	/**
	 * @var RegisterForm
	 */
	protected $registerForm;

	/**
	 * @param UserRepository $user
	 * @param RegisterForm   $registerForm
	 */
	public function __construct(UserRepository $user, RegisterForm $registerForm)
	{
		$this->user = $user;
		$this->registerForm = $registerForm;

		$this->beforeFilter('guest');
		$this->beforeFilter('csrf', ['on' => 'post']);
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return View::make('auth.register');
	}

	/**
	 * @return mixed
	 */
	public function store()
	{
		$input = Input::get();

		$this->registerForm->validate($input);
		$user = $this->user->create($input);

		Auth::login($user);
		Flash::success("Welcome to Laravel CookBook!");

		return Redirect::route('home');
	}
}
