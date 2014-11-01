<?php namespace CookBook\Accounts;

trait ContactableTrait {

	/**
	 * Get the e-mail address when a recipe is published.
	 *
	 * @return string
	 */
	public function getEmailAddress()
	{
		return $this->email;
	}

}
