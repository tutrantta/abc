<?php
/**
 * Login Controller
 *
 * Date                Author         Content
 * ----------------------------------------------------
 * 2015-05-05          tttu           Create File
 */


class LoginController extends \BaseController {

	protected $userModel;
	protected $params;

	public function __construct(\User $user)
	{
		$this->userModel = $user;
	}

	/**
     * @author tttu
     * @name index
     * load login form
     * @return Response
     */
	public function index()
	{
		return \View::make('login.index');
	}


	/**
     * @author tttu
     * @name postLogin
     *
     * @return Response
     */
	public function postLogin()
	{
		//check login
		if($this->userModel->checkLogin(\Input::get('user_name'), \Input::get('password'))){
			return Redirect::route('product-list');
		}
		return Redirect::refresh()->withErrors($this->userModel->errors())->withInput(\Input::except('password'));
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
