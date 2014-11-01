<?php namespace CookBook\Mailers;

use CookBook\Contracts\Contactable;

class RecipeMailer extends Mailer {

	/**
	 * @param Contactable  $user
	 * @param array $recipe
	 * @return mixed
	 */
	public function recipePublished(Contactable $user, $recipe)
	{
		$view = 'emails.recipe.published';
		$subject = "[Laravel Cookbook] - Recipe Published";

		return $this->sendTo($user, $subject, $view, $recipe);
	}

}
