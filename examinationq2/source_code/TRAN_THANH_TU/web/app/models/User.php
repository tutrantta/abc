<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class User extends BaseModel implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	//Remove password_confirmation
	public $autoPurgeRedundantAttributes = true;
	public static $passwordAttributes  = array('password');
	public $autoHashPasswordAttributes = true;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	protected $fillable = ['full_name','username','password','email','is_active','password_confirmation','is_admin'];

	protected $rulesForSave = [
	'full_name' => 'required',
	'username'=>'required|unique:users',
	'password'=>'required|min:6|max:60|confirmed',
	'password_confirmation'=>'required|max:60|min:6',
	'email'=>'required|email|unique:users',
	'is_admin'=>'required',
	'is_active'=>'required'
	];

	public static $rules = [
	'username'=>'required',
	'password'=>'required',
	];

	public function getAuthIdentifier() 
	{
		return $this->getKey();
	}

	public function getAuthPassword() 
	{
		return $this->password;
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

		if( ! $isRememberTokenAttribute )
		{
			parent::setAttribute($key, $value);
		}
	}
	/**
     * @author NgocNguyen
     * @name beforeSave
     * @todo check condition before save
     * @return Boolean
     */
	public function beforeSave() 
	{
		if((int)\Auth::user()->is_admin != (int)\Config::get('configs.is_admin')) {
			self::$rules = [
			'username'=>'required|unique:users',
			'email'=>'required|email|unique:users',
			];
			$this->fillable = ['username','password'];
		}else{
			self::$rules = $this->rulesForSave;
		}
	}

	/**
     * @author NgocNguyen
     * @name checkLogin
     * @todo excute check login when user input
     * @return Boolean
     */
	public function checkLogin($param)
	{
		if(\Auth::attempt($param)){
			if((int)\Auth::user()->is_active == (int)\Config::get('configs.user_active')){
				return true;
			}
		}
		return false;
	}

	/**
     * @author NgocNguyen
     * @name excuteSave
     * @todo excute create user
     * @return Boolean
     */

	public function excuteSave()
	{
		$this->beforeSave();
		return $this->save();
	}

	/**
     * @author NgocNguyen
     * @name getDetail
     * @todo get detail user
     * @return Boolean
     */

	public function getDetail($id)
	{
		if(!isset($id)){
			return false;
		}
		return $this->find($id);
	}

	/**
     * @author NgocNguyen
     * @name excuteUpdate
     * @todo excute create user
     * @return Boolean
     */

	public function excuteUpdate($id)
	{
		//get data
		$data = $this->getDetail($id);
		//set rules
		$this->beforeSave();

		self::$rules = [
		'full_name' => 'required',
		'email' => 'required|email|unique:users,email,'.$id,
		'is_admin'=>'required',
		'is_active'=>'required'
		];
		$this->fillable = ['full_name','username','password','is_admin','is_active'];

		//excute save
		if ($data->save() == false){
			return $data->errors();
		}
		return true;
	}

	/**
     * @author NgocNguyen
     * @name changePassword
     * @todo excute change password
     * @return Boolean
     */

	public function changePassword($id)
	{
		//get data
		$data = $this->getDetail($id);
		
		//set rules
		self::$rules = [
		'password'=>'required|min:6|confirmed',
		'password_confirmation'=>'required|min:6',
		];
		$this->fillable = ['password_confirmation','password'];
		//excute save
		if ($data->save() == false){
			return $data->errors();
		}
		return true;
	}
}