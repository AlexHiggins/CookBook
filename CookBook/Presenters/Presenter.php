<?php namespace CookBook\Presenters;

class Presenter extends \Laracasts\Presenter\Presenter {

	/**
	 * @return mixed
	 */
	public function createdAt()
	{
		return $this->created_at->diffForHumans();
	}

}
