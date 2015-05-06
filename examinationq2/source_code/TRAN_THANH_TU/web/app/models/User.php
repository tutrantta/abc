<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class User extends BaseModel implements UserInterface, RemindableInterface
{

	use UserTrait, RemindableTrait;

	//Remove password_confirmation
	public $autoPurgeRedundantAttributes = true;
	public static $passwordAttributes = array('password');
	public $autoHashPasswordAttributes = true;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tbl_user';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	protected $fillable = ['user_name', 'password', 'isactive', 'first_name', 'last_name'];

	public static $rules = [
		'user_name' => 'required',
		'password' => 'required',
	];

	public $timestamps = false;

	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	public function getAuthPassword()
	{
		return Hash::make($this->password);
	}

	public function getRememberToken()
	{
		return null;
	}

	public function setRememberToken($value)
	{
		return null;
	}

	public function getRememberTokenName()
	{
		return null;
	}

	public function getReminderEmail()
	{
		return $this->email;
	}

	public function setAttribute($key, $value)
	{
		$isRememberTokenAttribute = $key == $this->getRememberTokenName();

		if (!$isRememberTokenAttribute) {
			parent::setAttribute($key, $value);
		}
	}

	/**
	 * @author tttu
	 * @name checkLogin
	 * @return Boolean
	 */
	public function checkLogin($username, $password)
	{
		//validate
		if(!$this->validate()) return false;

		if (\Auth::attempt(array('user_name' => $username, 'password' => hash('sha256', $password)))) {
			if ((int)\Auth::user()->isactive == \Config::get('configs.user_active')) return true;
		}

		$this->validationErrors->getMessageBag()->add('invalid', 'Invalid Credentials!');
		return false;
	}
}