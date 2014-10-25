<?php namespace CookBook\Controllers\Auth;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\FlashNotifier;
use CookBook\Forms\RegisterForm;
use CookBook\Accounts\UserRepository;
use CookBook\Controllers\BaseController;

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
	 * @var FlashNotifier
	 */
	protected $notifier;

	/**
	 * @param UserRepository $user
	 * @param RegisterForm   $registerForm
	 * @param FlashNotifier  $notifier
	 */
	public function __construct(
		UserRepository $user,
		RegisterForm $registerForm,
		FlashNotifier $notifier)
	{
		$this->user = $user;
		$this->registerForm = $registerForm;
		$this->notifier = $notifier;

		$this->beforeFilter('guest');
		$this->beforeFilter('csrf', ['on' => 'post']);
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return $this->view('auth.register');
	}

	/**
	 * @return mixed
	 */
	public function store()
	{
		$input = Input::all();

		$this->registerForm->validate($input);
		$user = $this->user->create($input);

		Auth::login($user);
		$this->notifier->success('Welcome to Laravel CookBook!');

		return $this->redirectRoute('home');
	}

}
