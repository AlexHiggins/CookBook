<?php namespace CookBook\Accounts;

use CookBook\Core\EloquentRepository;

class UserRepository extends EloquentRepository {

	/**
	 * @param User $model
	 */
	public function __construct(User $model)
	{
		$this->model = $model;
	}

	/**
	 * @param $username
	 * @return mixed
	 */
	public function whereUserName($username)
	{
		return $this->model->whereUsername($username)->firstOrFail();
	}

}
