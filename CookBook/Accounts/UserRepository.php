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
	 * @param $data
	 * @return static
	 */
	public function create($data)
	{
		$user = $this->getNew();

		$user->email = $data['email'];
		$user->username = $data['username'];
		$user->password = $data['password'];
		$user->save();

		return $user;
	}

	/**
	 * @param User $user
	 * @param      $data
	 * @return User
	 */
	public function update(User $user, $data)
	{
		$user->email = $data['email'];

		if (!empty($data['password']))
		{
			$user->password = $data['password'];
		}

		$user->save();

		return $user;
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
