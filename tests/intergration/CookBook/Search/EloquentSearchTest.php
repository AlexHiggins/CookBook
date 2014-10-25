<?php

use Laracasts\TestDummy\Factory;

class EloquentSearchTest extends \Codeception\TestCase\Test {

	/**
	 * @var \IntegrationTester
	 */
	protected $tester;

	/**
	 * @var CookBook\Search\EloquentSearch
	 */
	protected $repo;

	protected function _before()
	{
		$this->repo = $this->tester->grabService('CookBook\Search\EloquentSearch');
	}

	/** @test */
	public function it_searches_by_recipe_description()
	{
		$recipeOne = Factory::create('CookBook\Recipes\Recipe', ['description' => 'recipeOne']);
		Factory::create('CookBook\Recipes\Recipe', ['description' => 'recipeTwo']);
		Factory::create('CookBook\Recipes\Recipe', ['description' => 'recidapeThree']);

		$resultOne = $this->repo->searchByTermPaginated('recipeOne');
		$resultTwo = $this->repo->searchByTermPaginated('recipe');

		$this->assertCount(2, $resultTwo);
		$this->assertNotEquals('hello!', $resultOne[0]->description);
		$this->assertEquals($recipeOne->description, $resultOne[0]->description);
	}

	/** @test */
	public function it_searches_by_recipe_title()
	{
		$recipeOne = Factory::create('CookBook\Recipes\Recipe', ['title' => 'titleOne']);
		Factory::create('CookBook\Recipes\Recipe', ['title' => 'titleTwo']);
		Factory::create('CookBook\Recipes\Recipe', ['title' => 'titldaweThree']);

		$resultOne = $this->repo->searchByTermPaginated('titleOne');
		$resultTwo = $this->repo->searchByTermPaginated('title');

		$this->assertCount(2, $resultTwo);
		$this->assertNotEquals('hello!', $resultOne[0]->title);
		$this->assertEquals($recipeOne->title, $resultOne[0]->title);
	}

	/** @test */
	public function it_searches_by_recipe_owner()
	{
		list($recipeOne, $recipeTwo) = Factory::times(2)->create('CookBook\Recipes\Recipe');

		$resultOne = $this->repo->searchByTermPaginated($recipeOne->user->username);
		$resultTwo = $this->repo->searchByTermPaginated($recipeTwo->user->username);

		$this->assertEquals($recipeOne->user->username, $resultOne[0]->user->username);
		$this->assertEquals($recipeOne->user->username, $resultTwo[0]->user->username);
	}


	/** @test */
	public function it_searches_by_recipe_tag()
	{
		list($tagOne, $tagTwo) = Factory::times(2)->create('CookBook\Tags\Tag');
		list($recipeOne, $recipeTwo) = Factory::times(2)->create('CookBook\Recipes\Recipe');

		DB::table('recipe_tag')->insert([
				['tag_id' => $tagOne->id, 'recipe_id' => $recipeOne->id],
				['tag_id' => $tagTwo->id, 'recipe_id' => $recipeTwo->id],
			]);

		$resultOne = $this->repo->searchByTermPaginated($tagOne->name);
		$resultTwo = $this->repo->searchByTermPaginated($tagTwo->name);

		$this->assertCount(1, $resultOne);
		$this->assertCount(1, $resultTwo);
		$this->assertEquals($recipeOne->title, $resultOne[0]->title);
		$this->assertEquals($recipeTwo->title, $resultTwo[0]->title);
	}

}
