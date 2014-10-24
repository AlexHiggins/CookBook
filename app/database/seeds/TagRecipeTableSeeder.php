<?php

use CookBook\Tags\Tag;
use CookBook\Recipes\Recipe;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TagRecipeTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
    $tags = Tag::lists('id');
    $recipes = Recipe::lists('id');

		foreach(range(1, 300) as $index)
		{
      DB::table('recipe_tag')->insert([
        'recipe_id' => $faker->randomElement($recipes),
        'tag_id' => $faker->randomElement($tags)
      ]);
		}
	}

}
