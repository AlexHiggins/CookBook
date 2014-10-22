<?php namespace CookBook\Forms;

use Laracasts\Validation\FormValidator;

class PasswordResetForm extends FormValidator {

	/**
	 * @var array
	 */
	protected $rules = [
		'email' => 'required',
	];

}
