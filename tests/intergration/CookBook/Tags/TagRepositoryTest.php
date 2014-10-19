<?php

use CookBook\Tags\TagRepository;
use Laracasts\TestDummy\Factory;

class TagRepositoryTest extends \Codeception\TestCase\Test {

	/**
	 * @var \IntegrationTester
	 */
	protected $tester;

	/**
	 * @var TagRepository
	 */
	protected $repo;

	protected function _before()
	{
		$this->repo = $this->tester->grabService('CookBook\Tags\TagRepository');
	}

	/** @test */
	public function list_all_tags()
	{
		list($tagOne, $tagTwo, $tagThree) = Factory::times(3)->create('CookBook\Tags\Tag');

		$expected = [
			$tagOne->id => $tagOne->name,
			$tagTwo->id => $tagTwo->name,
			$tagThree->id => $tagThree->name
		];

		$actual = $this->repo->listAll();

		$this->assertEquals($expected, $actual);
	}

	/** @test */
	public function return_all_tags_with_count()
	{
		list($tagOne, $tagTwo) = Factory::times(2)->create('CookBook\Tags\Tag');

		$recipes = Factory::times(3)->create('CookBook\Recipes\Recipe');

		DB::table('recipe_tag')->insert([
			['tag_id' => $tagOne->id, 'recipe_id' => $recipes[0]->id],
			['tag_id' => $tagOne->id, 'recipe_id' => $recipes[1]->id],
			['tag_id' => $tagOne->id, 'recipe_id' => $recipes[2]->id],
			['tag_id' => $tagTwo->id, 'recipe_id' => $recipes[1]->id],
		]);

		list($tagResultOne, $tagResultTwo) = $this->repo->getAllTagsWithCount();

		$this->assertEquals(3, $tagResultOne->count);
		$this->assertEquals($tagOne->name, $tagResultOne->name);

		$this->assertEquals(1, $tagResultTwo->count);
		$this->assertEquals($tagTwo->name, $tagResultTwo->name);
	}
}