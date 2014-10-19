<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

  /**
   * @var array
   */
  protected $tables = [
    'recipe_tag',
    'recipes',
    'tags',
    'users',
  ];

  /**
   * @var array
   */
  protected $seeders = [
    'UsersTableSeeder',
    'RecipeTableSeeder',
    'TagTableSeeder',
    'TagRecipeTableSeeder'
  ];

	/**
	 * Run the database seeds.
	 */
	public function run()
	{
		Model::unguard();
    $this->cleanDatabase();

    foreach($this->seeders as $seed)
    {
      $this->call($seed);
    }
	}

  /**
   * Truncate tables before repopulating them with fresh data
   */
  public function cleanDatabase()
  {
    DB::statement('SET FOREIGN_KEY_CHECKS=0');

    foreach($this->tables as $table)
    {
      DB::table($table)->truncate();
    }

    DB::statement('SET FOREIGN_KEY_CHECKS=1');
  }

}
