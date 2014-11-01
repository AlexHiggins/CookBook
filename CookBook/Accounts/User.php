<?php namespace CookBook\Accounts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\UserInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Laracasts\Presenter\PresentableTrait;
use CookBook\Contracts\Contactable;

class User extends Model implements UserInterface, RemindableInterface, Contactable {

	use UserTrait, RemindableTrait, PresentableTrait, ContactableTrait;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token'
	];

	/**
	 * @var array
	 */
	protected $fillable = [
		'email',
		'username',
		'password',
		'created_at',
		'updated_at'
	];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * @var string
	 */
	protected $presenter = 'CookBook\Presenters\UserPresenter';

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function recipes()
	{
		return $this->hasMany('CookBook\Recipes\Recipe');
	}

	/**
	 * @param $value
	 */
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Hash::make($value);
	}

}
