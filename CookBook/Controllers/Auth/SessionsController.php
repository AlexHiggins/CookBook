<?php namespace CookBook\Controllers\Auth;

use CookBook\Forms\LoginForm;
use CookBook\Controllers\BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class SessionsController extends BaseController {

	/**
	 * @var LoginForm
	 */
	protected $loginForm;

	/**
	 * @param LoginForm $loginForm
	 */
	public function __construct(LoginForm $loginForm)
	{
		$this->loginForm = $loginForm;

		$this->beforeFilter('csrf', ['on' => 'post']);
		$this->beforeFilter('guest', ['except' => 'destroy']);
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return View::make('auth.login');
	}

	/**
	 * @return mixed
	 */
	public function store()
	{
		$remember = Input::get('remember', false);
		$input = Input::only('username', 'password');

		$this->loginForm->validate($input);

		if (Auth::attempt($input, $remember))
		{
			return Redirect::intended('/');
		}

		return Redirect::route('login')->withErrors('The credentials you entered did not match our records');
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function destroy()
	{
		Auth::logout();

		return Redirect::home();
	}
}
