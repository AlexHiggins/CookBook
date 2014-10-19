<?php

use CookBook\Tags\Tag;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 20) as $index)
		{
			Tag::create(['name' => $faker->unique()->word()]);
		}
	}

}
