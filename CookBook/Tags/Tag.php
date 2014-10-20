<?php namespace CookBook\Tags;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Tag extends Model implements SluggableInterface {

	use SluggableTrait;

	/**
	 * @var array
	 */
	protected $fillable = [
		'name',
		'slug',
		'created_at',
		'updated_at',
	];

	/**
	 * @var array
	 */
	protected $sluggable = [
		'build_from' => 'name',
		'save_to' => 'slug',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function recipes()
	{
		return $this->belongsToMany('CookBook\Recipes\Recipe');
	}
}
