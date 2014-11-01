<?php namespace tests\unit\CookBook\Mailers;

use CookBook\Accounts\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Illuminate\Mail\Mailer as Mail;

class RecipeMailerSpec extends ObjectBehavior {

	public function let(Mail $mail)
	{
		$this->beConstructedWith($mail);
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType('CookBook\Mailers\RecipeMailer');
	}

	public function it_sends_an_email_if_a_recipe_is_published(Mail $mail, User $user)
	{
		$data = ['foo' => 'bar'];
		$mail->queue(Argument::type('string'), $data, Argument::type('closure'))->shouldBeCalledTimes(1);

		$this->recipePublished($user, $data);
	}

}
