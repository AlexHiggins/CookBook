<?php namespace CookBook\Forms;

use Illuminate\Support\Facades\Auth;
use Laracasts\Validation\FormValidator;

class UpdateProfileForm extends FormValidator {

	/**
	 * @var array
	 */
	protected $rules = [];

	/**
	 * {@inheritdoc}
	 */
	public function validate($formData)
	{
		$this->rules = [
			'password' => 'confirmed|min:8',
			'email' => 'required|email|unique:users,email,'.Auth::user()->id
		];

		return parent::validate($formData);
	}
}
