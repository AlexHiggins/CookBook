<?php

use Laracasts\TestDummy\Factory;
use CookBook\Recipes\RecipeRepository;

class RecipeRepositoryTest extends \Codeception\TestCase\Test {

	/**
	 * @var \IntegrationTester
	 */
	protected $tester;

	/**
	 * @var RecipeRepository
	 */
	protected $repo;

	protected function _before()
	{
		$this->repo = $this->tester->grabService('CookBook\Recipes\RecipeRepository');
	}

	/** @test */
	public function fetch_by_slug()
	{
		$recipe = Factory::create('CookBook\Recipes\Recipe', ['title' => 'dammit barry']);

		$result = $this->repo->whereSlug('dammit-barry');

		$this->assertEquals($recipe->slug, $result->slug);
	}

	/** @test */
	public function paginate_recipes()
	{
	  Factory::times(3)->create('CookBook\Recipes\Recipe');

		$this->assertCount(2, $this->repo->getAllPaginated(2));
		$this->assertCount(3, $this->repo->getAllPaginated(5));
	}

	/** @test */
	public function it_updates_a_recipe()
	{
		$user = Factory::create('CookBook\Accounts\User');
		list($tagOne, $tagTwo) = Factory::times(2)->create('CookBook\Tags\Tag');

		$recipe = [
			'title' => 'foo',
			'description' => 'bar',
			'code' => '<?=$bar?>',
			'tags' => [
				0 => $tagOne->id,
				1 => $tagTwo->id
			],
			'user_id' => $user->id,
		];

		$recipe = $this->repo->create($recipe);

		$newData = [
			'title' => 'fooNew',
			'description' => 'barNew',
			'code' => '<?=$barNew?>',
			'tags' => [
				0 => $tagOne->id,
			],
			'user_id' => $user->id,
		];

		$recipe = $this->repo->edit($recipe, $newData);

		$this->tester->seeRecord('recipes', ['title' => 'fooNew', 'description' => 'barNew', 'code' => '<?=$barNew?>']);
		$this->tester->seeRecord('recipe_tag', ['recipe_id' => $recipe->id, 'tag_id' => $tagOne->id]);
		$this->tester->dontSeeRecord('recipe_tag', ['recipe_id' => $recipe->id, 'tag_id' => $tagTwo->id]);
	}

	/** @test */
	public function list_tag_ids_for_a_recipe()
	{
		$recipe = Factory::create('CookBook\Recipes\Recipe');
		list($tagOne, $tagTwo) = Factory::times(2)->create('CookBook\Tags\Tag');

		DB::table('recipe_tag')->insert([
			['tag_id' => $tagOne->id, 'recipe_id' => $recipe->id],
			['tag_id' => $tagTwo->id, 'recipe_id' => $recipe->id],
		]);

		$result = $this->repo->listTagsIdsForRecipe($recipe);

		$this->assertCount(2, $result);
		$this->assertContains($tagOne->id, $result);
		$this->assertContains($tagTwo->id, $result);
	}

	/** @test */
	public function determine_if_recipe_is_owned_by_user()
	{
		$recipe = Factory::create('CookBook\Recipes\Recipe');

		$this->assertTrue($this->repo->recipeOwnedByUser($recipe->slug, $recipe->user_id));
		$this->assertNotTrue($this->repo->recipeOwnedByUser($recipe->slug, $recipe->user_id + 1));
		$this->assertNotTrue($this->repo->recipeOwnedByUser($recipe->slug.'2', $recipe->user_id));
	}

	/** @test */
	public function get_recipes_by_user_paginated()
	{
		$user = Factory::create('CookBook\Accounts\User');
		Factory::times(3)->create('CookBook\Recipes\Recipe', ['user_id' => $user->id]);

		$this->assertCount(2, $this->repo->getByUser($user, 2));
		$this->assertCount(3, $this->repo->getByUser($user, 4));
	}

	/** @test */
	public function increase_view_count()
	{
	  $recipe = Factory::create('CookBook\Recipes\Recipe');

		$this->assertEquals(0, $recipe->views);
		$this->repo->increaseViewCount($recipe);
		$this->assertEquals(1, $recipe->views);
	}

	/** @test */
	public function create_a_recipe_with_tags()
	{
		$user = Factory::create('CookBook\Accounts\User');
		list($tagOne, $tagTwo) = Factory::times(2)->create('CookBook\Tags\Tag');

		$recipe = [
			'title' => 'foo',
			'description' => 'bar',
			'code' => '<?=$bar?>',
			'tags' => [
				0 => $tagOne->id,
				1 => $tagTwo->id
			],
			'user_id' => $user->id,
		];

		$recipe = $this->repo->create($recipe);

		$this->tester->seeRecord('recipes', ['title' => 'foo', 'description' => 'bar']);
		$this->tester->seeRecord('recipe_tag', ['recipe_id' => $recipe->id, 'tag_id' => $tagOne->id]);
		$this->tester->seeRecord('recipe_tag', ['recipe_id' => $recipe->id, 'tag_id' => $tagTwo->id]);
	}

	/** @test */
	public function get_recipes_by_tag_paginated()
	{
		list($tagOne, $tagTwo) = Factory::times(2)->create('CookBook\Tags\Tag');
		list($recipeOne, $recipeTwo, $recipeThree) = Factory::times(3)->create('CookBook\Recipes\Recipe');

		DB::table('recipe_tag')->insert([
			['tag_id' => $tagOne->id, 'recipe_id' => $recipeOne->id],
			['tag_id' => $tagOne->id, 'recipe_id' => $recipeTwo->id],
			['tag_id' => $tagTwo->id, 'recipe_id' => $recipeThree->id],
		]);

		$tagTwoResults = $this->repo->getByTag($tagTwo, 1);

		$this->assertCount(2, $this->repo->getByTag($tagOne, 3));
		$this->assertCount(1, $this->repo->getByTag($tagOne, 1));
		$this->assertCount(1, $this->repo->getByTag($tagTwo, 3));
		$this->assertEquals($recipeThree->slug, $tagTwoResults[0]->title);
	}

}