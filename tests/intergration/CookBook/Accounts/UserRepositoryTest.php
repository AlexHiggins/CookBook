<?php

use Laracasts\TestDummy\Factory;
use CookBook\Accounts\UserRepository;

class UserRepositoryTest extends \Codeception\TestCase\Test {

	/**
	 * @var \IntegrationTester
	 */
	protected $tester;

	/**
	 * @var UserRepository
	 */
	protected $repo;

	protected function _before()
	{
		$this->repo = $this->tester->grabService('CookBook\Accounts\UserRepository');
	}

	/** @test */
	public function fetch_by_username()
	{
		Factory::create('CookBook\Accounts\User', ['username' => 'dave']);

		$user = $this->repo->whereUserName('dave');
		$this->assertEquals('dave', $user->username);
	}

	/** @test */
	public function create_a_user()
	{
		$user = [
			'username' => 'foo',
			'email' => 'foo@example.com',
			'password' => 'password'
		];

		$this->repo->create($user);
		$this->tester->seeRecord('users', ['username' => 'foo', 'email' => 'foo@example.com']);
	}

	/** @test */
	public function it_updates_a_users_profile()
	{
		$user = Factory::create('CookBook\Accounts\User', ['email' => 'foo@example.com']);
		$oldPassword = $user->password;

		$this->assertEquals('foo@example.com', $user->email);

		$user = $this->repo->update($user, ['email' => 'dave@example.com', 'password' => 'foo']);

		$this->assertNotEquals($oldPassword, $user->password);
		$this->assertEquals('dave@example.com', $user->email);
	}

	/** @test */
	public function it_hashes_passwords_on_creation()
	{
		$user = Factory::create('CookBook\Accounts\User', ['password' => 'foo']);

		$this->assertNotEquals('foo', $user->password);
	}

}
