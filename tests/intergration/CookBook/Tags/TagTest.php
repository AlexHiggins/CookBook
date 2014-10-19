<?php

use CookBook\Tags\Tag;
use Laracasts\TestDummy\Factory;

class TagTest extends \Codeception\TestCase\Test
{
	/**
	 * @var \IntegrationTester
	 */
	protected $tester;

	/**
	 * @var Tag
	 */
	protected $repo;

	protected function _before()
	{
		$this->repo = $this->tester->grabService('CookBook\Tags\Tag');
	}

	/** @test */
	public function create_a_slug_automatically()
	{
		$tag = Factory::create('CookBook\Tags\Tag', ['name' => 'Hello World 12']);

		$this->assertEquals('hello-world-12', $tag->slug);
	}

}