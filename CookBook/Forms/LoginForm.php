<?php namespace CookBook\Forms;

use Laracasts\Validation\FormValidator;

class LoginForm extends FormValidator {

	/**
	 * @var array
	 */
	protected $rules = [
		'username' => 'required',
		'password' => 'required'
	];

}
