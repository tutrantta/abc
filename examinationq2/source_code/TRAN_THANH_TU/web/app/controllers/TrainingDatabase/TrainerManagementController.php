<?php namespace TrainingDatabase;
/**
 * Trainer Management Controller
 *
 * Date                  Author         Content
 * ----------------------------------------------------
 * 2015-04-13          NguyenHien           Create File
 * 2015-04-15          Vo Le Quynh My       Update File
 */

class TrainerManagementController extends \BaseController {

	protected $trainerManagementModel;

	public function __construct(\TrainerManagement $trainerManagement)
	{
		$this->trainerManagementModel = $trainerManagement;
	}

	/**
     * @author NguyenHien
     * @name index
     * @todo Show list course
     * @return Response
     */
	public function getIndex()
	{
		return \View::make('training_database.trainer_management.index');
	}

	/**
     * @author NguyenHien
     * @name index
     * @todo Show list course
     * @return dataTable
     */
	public function getList()
	{
		$dataTable = new \Datatable;
		$dataTable->model = $this->trainerManagementModel;
		$dataTable->primary = 'trainer_id';
		$dataTable->columns = ['employee_code', 'trainer_name', 'description', 'trainer_id'];
		$dataTable->search = ['employee_code', 'trainer_name'];
		return $dataTable->render();
	}

	/**
     * @author NguyenHien
     * @name getAdd
     * @todo Show list course
     * @return dataTable
     */
	public function getAdd()
	{
        list($code, $arrNames) = $this->trainerManagementModel->getListEngineerForView();
        $data = array(
                'arrEmp'  => $code,
                'arrName' => $arrNames,
        );

		return \View::make('training_database.trainer_management.add')->with($data);
	}
	/**
     * @author Vo Le Quynh My
     * @name addTrainer
     * @todo Add Trainer
     * @return Boolean
     */
	public function addTrainer()
	{
	    if ($this->trainerManagementModel->addTrainer() == false)
	    {
	        return \Redirect::route('trainer-add')->withErrors($this->trainerManagementModel->errors());
	    }
	    return \Redirect::route('trainer-list')->withFlashMessage('Trainer Created Successfully.');
	}
	/**
	 * @author Vo Le Quynh My
	 * @name getDetailTrainer
	 * @todo get detail trainer by id
	 * @return 
	 */
	public function getDetailTrainer($trainer_id)
	{
	    $data = $this->trainerManagementModel->getDetailTrainer($trainer_id);
	    if ($data == false)
	    {
	        return \App::abort(404);
	    }
        list($code, $arrNames) = $this->trainerManagementModel->getListEngineerForView();
        
	    return \View::make('training_database.trainer_management.edit')->with(['data' => $data, 'code' => $code]);
	}
	/**
	 * @author Vo Le Quynh My
	 * @name updateTrainer
	 * @todo update trainer
	 * @return
	 */
	public function updateTrainer($trainer_id)
	{
        $result = $this->trainerManagementModel->updateTrainer($trainer_id);
        if(is_object($result))
        {
            return \Redirect::route('trainer-detail', array($trainer_id))->withErrors($result);
        }
        return \Redirect::route('trainer-list')->withFlashMessage('Engineer Update Successfully.');
	}

}
