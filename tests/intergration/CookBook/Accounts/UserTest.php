<?php

use CookBook\Accounts\User;
use Laracasts\TestDummy\Factory;

class UserTest extends \Codeception\TestCase\Test
{
	/**
	 * @var \IntegrationTester
	 */
	protected $tester;

	/**
	 * @var User
	 */
	protected $repo;

	protected function _before()
	{
		$this->repo = $this->tester->grabService('CookBook\Accounts\User');
	}

	/** @test */
	public function it_hashes_passwords_on_creation()
	{
		$user = Factory::create('CookBook\Accounts\User', ['password' => 'foo']);

		$this->assertNotEquals('foo', $user->password);
	}

}