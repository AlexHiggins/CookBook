<?php namespace CookBook\Recipes;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Recipe extends Model implements SluggableInterface {

	use PresentableTrait, SluggableTrait;

	/**
	 * @var array
	 */
	protected $fillable = [
		'title',
		'slug',
		'description',
		'code',
		'user_id',
		'created_at',
		'updated_at'
	];

	/**
	 * @var array
	 */
	protected $sluggable = [
		'build_from' => 'title',
		'save_to' => 'slug',
		'on_update' => true
	];

	/**
	 * @var string
	 */
	protected $presenter = 'CookBook\Presenters\RecipePresenter';

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('CookBook\Accounts\User');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tags()
	{
		return $this->belongsToMany('CookBook\Tags\Tag');
	}
}
