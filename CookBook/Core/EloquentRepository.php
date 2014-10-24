<?php namespace CookBook\Core;

abstract class EloquentRepository {

	/**
	 * @var null
	 */
	protected $model;

	/**
	 * @param null $model
	 */
	public function __construct($model = null)
	{
		$this->model = $model;
	}

	/**
	 * Get a new instance of the model.
	 *
	 * @param  array $attributes
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getNew(array $attributes = array())
	{
		return $this->model->newInstance($attributes);
	}

	/**
	 * @param $data
	 * @return static
	 */
	public function create($data)
	{
		return $this->model->create($data);
	}

	/**
	 * @param $slug
	 * @return mixed
	 */
	public function whereSlug($slug)
	{
		return $this->model->whereSlug($slug)->firstOrFail();
	}

}
