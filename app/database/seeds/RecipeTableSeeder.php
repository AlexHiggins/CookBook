<?php

use CookBook\Accounts\User;
use CookBook\Recipes\Recipe;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class RecipeTableSeeder extends Seeder {

	public function run()
	{
    $files = [];
    $md_files = [1,2,3,4,5];
    $faker = Faker::create();
    $users = User::lists('id');

    foreach($md_files as $file)
    {
      $files[$file] = file_get_contents(
        "https://raw.githubusercontent.com/AlexHiggins/markdown-snippets/master/{$file}.md"
      );
    }

		foreach(range(1, 300) as $index)
		{
      Recipe::create([
        'title' => $faker->sentence(),
        'description' => $faker->paragraph(),
        'user_id' => $faker->randomElement($users),
        'code' => $files[$faker->randomElement($md_files)]
      ]);
		}
	}

}
