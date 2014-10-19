<?php namespace tests\unit\CookBook\Events;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use CookBook\Recipes\Recipe;
use CookBook\Recipes\RecipeRepository;

class RecipeSubscriberSpec extends ObjectBehavior {

	public function let(RecipeRepository $recipeRepo)
	{
		$this->beConstructedWith($recipeRepo);
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType('CookBook\Events\RecipeSubscriber');
	}

	public function it_increases_the_view_count_for_a_recipe(Recipe $recipe, RecipeRepository $recipeRepo)
	{
		$recipeRepo->increaseViewCount($recipe)->shouldBeCalledTimes(1);
		$this->recipeViewed($recipe);
	}
}
