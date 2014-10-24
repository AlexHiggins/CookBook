<?php namespace CookBook\Controllers\Auth;

use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Laracasts\Flash\FlashNotifier;
use CookBook\Forms\LoginForm;
use CookBook\Controllers\BaseController;

class SessionsController extends BaseController {

	/**
	 * @var AuthManager
	 */
	protected $auth;

	/**
	 * @var LoginForm
	 */
	protected $loginForm;

	/**
	 * @var FlashNotifier
	 */
	protected $notifier;

	/**
	 * @var Request
	 */
	protected $request;

	/**
	 * @param AuthManager   $auth
	 * @param LoginForm     $loginForm
	 * @param FlashNotifier $notifier
	 * @param Request       $request
	 */
	public function __construct(
		AuthManager $auth,
		LoginForm $loginForm,
		FlashNotifier $notifier,
		Request $request)
	{
		$this->auth = $auth;
		$this->loginForm = $loginForm;
		$this->notifier = $notifier;
		$this->request = $request;

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
		$remember = $this->request->get('remember', false);
		$input = $this->request->only('username', 'password');

		$this->loginForm->validate($input);

		if ($this->auth->attempt($input, $remember))
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
		$this->auth->logout();
		$this->notifier->success('You have been successfully logged out!');

		return $this->redirectRoute('home');
	}

}
