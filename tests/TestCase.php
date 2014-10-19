<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 *	Stop me pulling my hair out!
	 */
	public function tearDown()
	{
		Mockery::close();
	}

	/**
	 * @param $class
	 * @return \Mockery\MockInterface
	 */
	public function mock($class)
	{
		$mock = Mockery::mock($class);
		$this->app->instance($class, $mock);

		return $mock;
	}

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../bootstrap/start.php';
	}

}
