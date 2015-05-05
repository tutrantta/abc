<?php namespace UserManagement;
/**
 * User Controller
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-01          NgocNguyen     Create File
 */

class UserController extends \BaseController {

	protected $userModel;

	public function __construct(\User $user)
	{
		$this->userModel = $user;
	}
	/**
     * @author NgocNguyen
     * @name index
     * @todo Show list user
     * @return Response
     */
	public function index()
	{
		return \View::make('user_management.index');
	}

	/**
     * @author NgocNguyen
     * @name getList
     * @todo get user list
     * @return Response
     */
	public function getList()
	{
		$dataTable = new \Datatable;
		$dataTable->model = $this->userModel;
		$dataTable->primary = 'id';
		$dataTable->columns = ['id','username','full_name', 'is_admin', 'email','is_active'];
		$dataTable->search = ['username', 'email', 'full_name'];
		$dataTable->condition = \Auth::user()->id;
		return $dataTable->render();
	}

	/**
     * @author NgocNguyen
     * @name create
     * @todo show view create user
     * @return Response
     */
	public function create()
	{
		return \View::make('user_management.create');
	}


	/**
     * @author NgocNguyen
     * @name store
     * @todo excute store user
     * @return Response
     */
	public function store()
	{
		if($this->userModel->excuteSave() == false){
			return \Redirect::route('user-add')->withErrors($this->userModel->errors());
		}
		return \Redirect::route('user-list')->withFlashMessage('User Created Successfully.');
	}


	/**
     * @author NgocNguyen
     * @name show
     * @todo view detail user information
     * @return Response
     */
	public function show($id)
	{
		$data = $this->getdata($id);
		return \View::make('user_management.show',compact('data'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = $this->getdata($id);
		return \View::make('user_management.edit',compact('data'));
	}


	/**
     * @author NgocNguyen
     * @name update
     * @todo excute update user
     * @return Response
     */
	public function update($id)
	{
		$results = $this->userModel->excuteUpdate($id);
		//Excute update
		if(is_object($results))
		{
			return \Redirect::route('user-edit',$id)->withErrors($results);
		}
		if(\Auth::user()->is_admin == \Config::get('configs.is_admin')){
			return \Redirect::route('user-list')->withFlashMessage('User updated Successfully.');
		}
		return \Redirect::route('user-detail',$id)->withFlashMessage('update information Successfully.');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	/**
     * @author NgocNguyen
     * @name getData
     * @todo get user data from id
     * @return Response
     */
	public function getData($id)
	{
		$data = $this->userModel->getDetail($id);
		if($data == false){
			\App::abort(404);
		}
		return $data;
	}

	/**
     * @author NgocNguyen
     * @name changePassword
     * @todo show form change password
     * @return Response
     */
	public function changePassword($id)
	{
		if($id != \Auth::user()->id){
			\App::abort(404);
		}
		$data = $this->getData($id);
		return \View::make('user_management.change_password',compact('data'));
	}
	/**
     * @author NgocNguyen
     * @name excuteChangePassword
     * @todo excute change password
     * @return Response
     */
	public function excuteChangePassword($id)
	{
		$data = $this->getData($id);
		//get params
		$params = [
		'old_password'=>\Input::get('old_password'),
		'password'=>\Input::get('password'),
		'password_confirmation'=>\Input::get('password_confirmation'),
		];
		//check old password
		if (\Hash::check($params['old_password'], $data['password']) == false)
		{
			return \Redirect::route('user-change-password',$id)->withErrors('Wrong old password !');
		}

		//excute save password
		$results = $this->userModel->changePassword($id);
		if(is_object($results)){
			return \Redirect::route('user-change-password',$id)->withErrors($results);
		}
		return \Redirect::route('logout')->withFlashMessage('Change password successful. Please Login again !');
	}
	/**
     * @author NgocNguyen
     * @name resetPassword
     * @todo show form reset password
     * @return Response
     */
	public function resetPassword($id){
		$data = $this->getData($id);
		return \View::make('user_management.reset_password',compact('data'));
	}

	/**
     * @author NgocNguyen
     * @name excuteResetPassword
     * @todo excute reset password
     * @return Response
     */
	public function excuteResetPassword($id)
	{
		$data = $this->getData($id);
		//get params
		$params = [
		'password'=>\Input::get('password'),
		'password_confirmation'=>\Input::get('password_confirmation'),
		];

		//excute save password
		$results = $this->userModel->changePassword($id);
		if(is_object($results)){
			return \Redirect::route('user-reset-password',$id)->withErrors($results);
		}
		if(\Auth::user()->is_admin == \Config::get('configs.is_admin')){
			return \Redirect::route('user-list')->withFlashMessage('Reset password successful !');
		}
		return \Redirect::route('home')->withFlashMessage('Reset password successful !');
	}				
}
