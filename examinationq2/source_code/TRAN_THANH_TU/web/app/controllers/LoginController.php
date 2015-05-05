<?php
/**
 * Login Controller
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-03-24          NgocNguyen     Create File
 */


class LoginController extends \BaseController {

	protected $userModel;
	protected $params;

	public function __construct(\User $user)
	{
		$this->userModel = $user;
	}

	/**
     * @author NgocNguyen
     * @name index
     * @todo show form login
     * @return Response
     */
	public function index()
	{
		return \View::make('login.index');
	}


	/**
     * @author NgocNguyen
     * @name postLogin
     * @todo excute login action
     * @return Response
     */
	public function postLogin()
	{
		if($this->userModel->validate() == false){
			return \Redirect::route('login-index')->withErrors($this->userModel->errors())
												 ->withInput(\Input::except('password'));
		}
		//get params
		$this->params = [
			'username'=>\Input::get('username'),
			'password'=>\Input::get('password'),
		];
		//check login
		if($this->userModel->checkLogin($this->params)){
			return Redirect::route('home');
		}
		return Redirect::route('login-index')->withErrors('Invalid credentials !')
												->withInput(\Input::except('password'));
	}

	/**
     * @author NgocNguyen
     * @name getLogout
     * @todo excute logout action
     * @return Response
     */
	public function getLogout()
	{
		Auth::logout();
		return Redirect::route('login-index')->withFlashMessage(\Session::get('flash_message'));
	}
}
