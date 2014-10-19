<?php namespace Codeception\Module;

use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\DB;

class FunctionalHelper extends \Codeception\Module {

	public function signIn()
	{
		$username = 'alex';
		$password = 'password';
		$email = 'alex@example.com';

		$this->haveAnAccount(compact('username', 'email', 'password'));

		$I = $this->getModule('Laravel4');

		$I->amOnPage('/login');
		$I->fillField('username', $username);
		$I->fillField('password', $password);
		$I->click('Login', 'input[type="submit"]');
	}

	/**
	 * @throws \Codeception\Exception\Module
	 */
	public function signOut()
	{
		$I = $this->getModule('Laravel4');
		$I->click('Logout');
	}

	/**
	 * @param array $overrides
	 * @return mixed
	 */
	public function haveTag($overrides = [])
	{
		return $this->have('CookBook\Tags\Tag', $overrides);
	}

	/**
	 * @param array $overrides
	 * @return mixed
	 */
	public function haveRecipe($overrides = [])
	{
		return $this->have('CookBook\Recipes\Recipe', $overrides);
	}


	/**
	 * Create a CookBook user account in the database.
	 *
	 * @param array $overrides
	 * @return mixed
	 */
	public function haveAnAccount($overrides = [])
	{
		return $this->have('CookBook\Accounts\User', $overrides);
	}

	/**
	 * Insert a dummy record into a database table.
	 *
	 * @param $model
	 * @param array $overrides
	 * @return mixed
	 */
	public function have($model, $overrides = [])
	{
		return Factory::create($model, $overrides);
	}

	/**
	 * @param $recipe
	 * @param $tag
	 */
	public function assignTagToRecipe($recipe, $tag)
	{
		DB::table('recipe_tag')->insert(['tag_id' =>  $tag->id, 'recipe_id' => $recipe->id]);
	}

}