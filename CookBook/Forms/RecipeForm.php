<?php namespace CookBook\Forms;

use Laracasts\Validation\FormValidator;

class RecipeForm extends FormValidator {

	/**
	 * @var array
	 */
	protected $rules = [
		'title' => 'required|max:70',
		'description' => 'required',
		'code' => 'required',
		'tags' => 'required',
		'user_id' => 'required',
	];

}
