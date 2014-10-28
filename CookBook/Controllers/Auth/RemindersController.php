<?php namespace CookBook\Controllers\Auth;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\FlashNotifier;
use CookBook\Controllers\BaseController;

class RemindersController extends BaseController {

	/**
	 * @var FlashNotifier
	 */
	protected $notifier;

	/**
	 * @param FlashNotifier $notifier
	 */
	public function __construct(FlashNotifier $notifier)
	{
		$this->notifier = $notifier;

		$this->beforeFilter('guest');
		$this->beforeFilter('csrf', [ 'on' => 'post' ]);
	}

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return $this->view('password.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		$response = Password::remind(Input::only('email'), function($message) {
			$message->subject('[Laravel Cookbook] Password Reset');
		});

		switch ($response)
		{
			case Password::INVALID_USER:
				$this->notifier->error(Lang::get($response));
				return $this->redirectBack();

			case Password::REMINDER_SENT:
				$this->notifier->message(Lang::get($response));
				return $this->redirectBack();
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return $this->view('password.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only('email', 'password', 'password_confirmation', 'token');

		$response = Password::reset($credentials, function($user, $password) {
			$user->password = $password;
			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
			case Password::INVALID_PASSWORD:
				$this->notifier->error(Lang::get($response));
				return $this->redirectBack();

			case Password::PASSWORD_RESET:
				$this->notifier->success('Your password has been reset. You may now log in.');
				return $this->redirectRoute('home');
		}
	}

}
