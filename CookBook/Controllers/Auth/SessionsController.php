<?php namespace CookBook\Controllers\Auth;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\FlashNotifier;
use CookBook\Forms\LoginForm;
use CookBook\Controllers\BaseController;

class SessionsController extends BaseController {

	/**
	 * @var LoginForm
	 */
	protected $loginForm;

	/**
	 * @var FlashNotifier
	 */
	protected $notifier;

	/**
	 * @param LoginForm     $loginForm
	 * @param FlashNotifier $notifier
	 */
	public function __construct(LoginForm $loginForm, FlashNotifier $notifier)
	{
		$this->loginForm = $loginForm;
		$this->notifier = $notifier;

		$this->beforeFilter('csrf', ['on' => 'post']);
		$this->beforeFilter('guest', ['except' => 'destroy']);
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return $this->view('auth.login');
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
			$this->notifier->success('Welcome back!');
			return $this->redirectIntended();
		}

		return $this->redirectBack('login')->withErrors('The credentials you entered did not match our records');
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function destroy()
	{
		Auth::logout();
		$this->notifier->success('You have been successfully logged out!');

		return $this->redirectRoute('home');
	}

}
