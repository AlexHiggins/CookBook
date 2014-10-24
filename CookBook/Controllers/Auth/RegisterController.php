<?php namespace CookBook\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;
use Laracasts\Flash\FlashNotifier;
use CookBook\Forms\RegisterForm;
use CookBook\Accounts\UserRepository;
use CookBook\Controllers\BaseController;

class RegisterController extends BaseController {

	/**
	 * @var AuthManager
	 */
	protected $auth;

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
	 * @var Request
	 */
	protected $request;

	/**
	 * @param AuthManager    $auth
	 * @param UserRepository $user
	 * @param RegisterForm   $registerForm
	 * @param FlashNotifier  $notifier
	 * @param Request        $request
	 */
	public function __construct(
		AuthManager $auth,
		UserRepository $user,
		RegisterForm $registerForm,
		FlashNotifier $notifier,
		Request $request)
	{
		$this->auth = $auth;
		$this->user = $user;
		$this->registerForm = $registerForm;
		$this->notifier = $notifier;
		$this->request = $request;

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
		$input = $this->request->all();

		$this->registerForm->validate($input);
		$user = $this->user->create($input);

		$this->auth->login($user);
		$this->notifier->success('Welcome to Laravel CookBook!');

		return $this->redirectRoute('home');
	}

}
