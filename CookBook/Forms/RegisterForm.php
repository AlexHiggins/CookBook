<?php namespace CookBook\Forms;

use Laracasts\Validation\FormValidator;

class RegisterForm extends FormValidator {

	/**
	 * @var array
	 */
	protected $rules = [
		'username' => 'required|unique:users',
		'email' => 'required|email|unique:users',
		'password' => 'required|confirmed|min:8',
	];

}
