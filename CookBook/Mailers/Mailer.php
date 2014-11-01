<?php namespace CookBook\Mailers;

use Illuminate\Mail\Mailer as Mail;
use CookBook\Contracts\Contactable;

abstract class Mailer {

	/**
	 * @var Mail
	 */
	protected $mail;

	/**
	 * @param Mail $mail
	 */
	public function __construct(Mail $mail)
	{
		$this->mail = $mail;
	}

	/**
	 * @param Contactable $user
	 * @param           $subject
	 * @param           $view
	 * @param array     $data
	 * @return mixed
	 */
	protected function sendTo(Contactable $user, $subject, $view, $data = [])
	{
    		return $this->mail->queue($view, $data, function($message) use ($user, $subject) {
			  $message->subject($subject)
				  ->to($user->getEmailAddress());
     		});
	}

}
