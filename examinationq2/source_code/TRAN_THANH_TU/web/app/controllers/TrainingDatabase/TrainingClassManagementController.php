<?php namespace TrainingDatabase;
/**
 * TechnicalSkillIndexController
 *
 * Date                Author         Content
 * ----------------------------------------------------
 * 2015-04-13          LamKy        Create File
 * 2015-04-15          Ngoc Nguyen  Add new function
 * 2015-04-15          Dung Le      Modify|Refactor
 * 2015-05-04          Dung Le      Modify
 */

class TrainingClassManagementController extends \BaseController {
    protected $trainingClassManagement;
    protected $engineerModel;
    protected $classAssignmentsModel;
    protected $params;
    protected $objCourse;
    protected $trainerManagement;

    public function __construct(\TrainingClassManagement $trainingClassManagement,
                                \Engineer $engineer,
                                \ClassAssignments $classAssignments,
                                \TrainerManagement $trainer,
                                \Course $course)
    {
        $this->trainingClassManagement = $trainingClassManagement;
        $this->engineerModel = $engineer;
        $this->classAssignmentsModel = $classAssignments;
        $this->trainerManagement = $trainer;
        $this->objCourse = $course;
    }
    
    /**
     * @author NgocNguyen
     * @name getAssignEngineer
     * @todo Show form assign Engineer
     * @return Response
     */
    public function getAssignEngineer($id)
    {
        //get params
        $engineerAssign = $this->classAssignmentsModel->getListById($id);
        $listEngineer = (array)$this->engineerModel->getLists()->ToArray();
        $listAssign = [];
        $idHaveAssigned = [];
        $class = $this->trainingClassManagement->getClass($id);
        
        //check engineers have already assigned
        foreach ($listEngineer as $key => $value) {
            foreach ($engineerAssign as $key2 => $item) {
                if($value['engineer_id'] == $item->engineer_id){
                    $idHaveAssigned[] = $item->engineer_id;
                    $listAssign[]=$listEngineer[$key];
                    unset($listEngineer[$key]);
                }
                if($value['engineer_id'] == $class->trainer_id){
                    unset($listEngineer[$key]);
                }

            }   
        }
        //send data to view
        $data = [
        'class' => $class,
        'lists'=> $listEngineer,
        'listAssign'=>$listAssign,
        'idHaveAssigned'=>implode(',', $idHaveAssigned)
        ];
        return \View::make('training_database.training_class.assign_engineer',compact('data'));
    }

    
    /**
     * @author NgocNguyen
     * @name postAssignEngineer
     * @todo save list engineer assignment
     * @return Response
     */
    public function postAssignEngineer($id)
    {
        //get params
        $data = \Input::all();
        $this->params = [
            'listAttent' => explode(',', \input::get('input-attent')),
            'listAttentRemove'=> explode(',', \input::get('input-attent-delete')),
            'class_id' => \Input::get('class_id'),
            'checked'=> isset($data['submit_and_update']) ? true : false
        ];

        $listSave = [];

        foreach ($this->params['listAttent'] as $key => $value) {
            $listSave[]=[
                'class_id'=> $this->params['class_id'],
                'engineer_id'=> $value,
            ];
        }

        $flag = $this->checkSubmit($this->params['checked'],$id);

        //save list assign
        if(!empty($this->params['listAttent'][0])){
            //excute save
            $results = $this->classAssignmentsModel->excuteSave($listSave);
        }
        //delete list assign
        if(!empty($this->params['listAttentRemove'][0])){
            //excute save
            $results = $this->classAssignmentsModel->excuteDelete($id,$this->params['listAttentRemove']);
        }
        
        if($flag != false){
            return $flag;
        }

        if(empty($this->params['listAttent'][0]) && empty($this->params['listAttentRemove'][0])){
            return \Redirect::route('assign-engineer',$id)->withFlashMessage('Assign Engineer to class Successful !');
        }

        if($results == true){
            return \Redirect::route('assign-engineer',$id)->withFlashMessage('Assign Engineer to class Successful !');
        }
        return \Redirect::route('assign-engineer',$id)->withErrors('Assign fail !');
    }
    
    public function checkSubmit($checked,$id){
        if($checked ==  true){
            return \Redirect::route('technical-result-list',$id);
        }
        return false;
    }
    
    /**
     * @method get all training classes list
     * @author LamKy
     */
    public function getClassesList()
    {
        // get ajax 
        if (\Request::ajax()) 
        {
            return $this->trainingClassManagement->ajax_();
        }
        //show view
        return \View::make('training_database.training_class.index');
    }
    
    /**
     * 
     * @param integer $class_id
     * @return void
     * @method get detail of training class
     * @author LamKy | Dung Le
     */
    public function getClassDetail($class_id)
    {
        $exist_class = \Helper::checkExist($class_id);
        if (!is_numeric($class_id) || !$exist_class) {
            return \Redirect::route('list-class')->withErrors(["class_id" => "The class is not exist."]);
        }
        $arrDetail   = $this->trainingClassManagement->getClass($class_id);
        $arrCourse   = $this->trainingClassManagement->getAllCourses();
        $arrTrainer  = $this->trainerManagement->getListTrainerWithStatus();
        $arrCode     = array();
        $arrName     = array();
        $arrAreaList = array();
        $view = 'training_database.training_class.view';

        $exist_relationship = \Helper::checkExist($class_id, 'class_id', 'class_assignments');
        if ($exist_relationship !== true) {
            $view = 'training_database.training_class.edit';
            list($arrCode, $arrName)  = $this->trainerManagement->getListEngineerForView();
            $arrAreaList = $this->trainingClassManagement->getAllAreas();
        }
        
        return \View::make($view)->with(compact('arrDetail', 'arrCourse', 'arrTrainer', 'arrCode', 'arrName', 'arrAreaList'));
   }
    
   /**
    * 
    * @param $class_id
    * @return
    * @method update detail training class
    * @author LamKy | Dung Le
    */
    public function doUpdate($class_id)
    {
        $result = $this->trainingClassManagement->doUpdate($class_id);
        if ($result === true)
        {
            return \Redirect::route('list-class')->withFlashMessage('Training Class Has Updated Successfully.');
        }
        // update error
        return \Redirect::refresh()->withErrors($result);
    }
    /**
     * create training class, support show view
     * @author LamKy | Dung Le
     */
    public function createTrainingClass()
    {
        $arrCourse  = $this->trainingClassManagement->getAllCourses();
        $arrTrainer = $this->trainerManagement->getListTrainerWithStatus();

        list($arrCode, $arrName)  = $this->trainerManagement->getListEngineerForView();

        $arrAreaList = $this->trainingClassManagement->getAllAreas();
        
        return \View::make('training_database.training_class.create')->with(compact('arrCourse', 'arrTrainer', 'arrCode', 'arrName', 'arrAreaList'));
    }
    
    /**
     * @param
     * @return
     * @method create training class, support connect models
     * @author LamKy | Dung Le
     */
    public function doCreate()
    {
        $result = $this->trainingClassManagement->doInsert();
        if (!$result) 
        {
            return \Redirect::refresh()->withErrors($this->trainingClassManagement->errors());
        }
        return \Redirect::route('list-class')->withFlashMessage('Training Class Created Successfully.');
    }
    /**
     * @method create course in popup.
     * @author Dung Le
     */
    public function addCourse()
    {
        $validate = $this->objCourse->checkValidation(\Input::get('area_id'), trim(\Input::get('course_name')));
        if ($validate !== true)
        {
            return json_encode(array('status' => 'error', 'msg' => [$validate]));
        }

        $result = $this->objCourse->saveCourse();

        if ($result == false) {
            return json_encode(array('status' => 'error', 'msg' => $this->objCourse->errors()->all()));
        }
        \Session::flash('flash_message', 'Add Course Successful!');
        return json_encode(array('status' => 'success', 'msg' => "Update success!"));
    }

    /**
     * @method create trainer in popup.
     * @author Dung Le
     */
    public function addTrainer()
    {
        $result = $this->trainerManagement->addTrainer();

        if ($result == false) {
            return json_encode(array('status' => 'error', 'msg' => $this->trainerManagement->errors()->all()));
        }
        \Session::flash('flash_message', 'Add Trainer Successful!');
        return json_encode(array('status' => 'success', 'msg' => "Update success!"));
    }
}
