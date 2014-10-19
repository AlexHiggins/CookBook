<?php

use CookBook\Recipes\Recipe;
use Laracasts\TestDummy\Factory;

class RecipeTest extends \Codeception\TestCase\Test
{
	/**
	 * @var \IntegrationTester
	 */
	protected $tester;

	/**
	 * @var Recipe
	 */
	protected $repo;

	protected function _before()
	{
		$this->repo = $this->tester->grabService('CookBook\Recipes\Recipe');
	}

	/** @test */
	public function create_a_slug_automatically()
	{
		$recipe = Factory::create('CookBook\Recipes\Recipe', ['title' => 'Hello World 12']);

		$this->assertEquals('hello-world-12', $recipe->slug);
	}

	/** @test */
	public function handle_slugs_uniquely()
	{
		$recipeOne = Factory::create('CookBook\Recipes\Recipe', ['title' => 'Hello World']);
		$recipeTwo = Factory::create('CookBook\Recipes\Recipe', ['title' => 'Hello World']);

		$this->assertEquals('hello-world', $recipeOne->slug);
		$this->assertEquals('hello-world-1', $recipeTwo->slug);
	}

}