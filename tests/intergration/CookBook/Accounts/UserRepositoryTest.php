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

}