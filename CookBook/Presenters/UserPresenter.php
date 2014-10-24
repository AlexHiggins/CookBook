<?php namespace CookBook\Presenters;

class UserPresenter extends Presenter {

	/**
	 * @return string
	 */
	public function gravatar()
	{
		return "//gravatar.com/avatar/".md5(strtolower(trim($this->email)))."?d=mm";
	}

	/**
	 * @return mixed
	 */
	public function registerDate()
	{
		return $this->created_at->diffForHumans();
	}

}
