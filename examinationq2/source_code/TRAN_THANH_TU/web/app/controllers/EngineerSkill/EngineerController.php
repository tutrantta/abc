<?php namespace EngineerSkill;
/**
 * Engineer Controller
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-01          Vo Le Quynh My     Create File
 */

class EngineerController extends \BaseController {
    
    protected $engineerModel;
    
    public function __construct(\Engineer $engineer)
    {
        $this->engineerModel = $engineer;
    }
    public function index()
    {
        return \View::make('engineer_skill.engineers.add');
    }
    /**
     * @author Vo Le Quynh My
     * @name add
     * @todo
     * @return Response
     */
    public function add()
    {
        if (\Input::get('birthday') !== '')
        {
            $birthday = date('Y-m-d', strtotime(\Input::get('birthday')));
            \Input::merge(['birthday' => $birthday]);
        }
        if($this->engineerModel->addEngineer() == false)
        {
            return \Redirect::refresh()->withErrors($this->engineerModel->errors());
        }
        return \Redirect::route('engineer-list')->withFlashMessage('Engineer Created Successfully.');
    }
    /**
     * @author Vo Le Quynh My
     * @name detail
     * @todo
     * @return Response
     */
    public function detail()
    {
        return \View::make('engineer_skill.engineers.detail');
    }
    /**
     * @author Vo Le Quynh My
     * @name getList
     * @todo
     * @return Response
     */
    public function getlist()
    {
        return \View::make('engineer_skill.engineers.list');
    }
    /**
     * @author Vo Le Quynh My
     * @name getListAjax
     * @todo
     * @return array
     */
    public function getListAjax()
    {
        $columns = ['fullname', 'employee_code', 'engineers.is_active', 'department_name', 'engineer_id', 'gender','email', 'birthday', 'address'];

       $params = \Datatable::request($columns, 'fullname', 'asc');
        // get data
        $engineer = $this->engineerModel->getListEngineer($params);
        $total = $engineer['count'];

        $engineerList = array();
        // create data for row on datatables
        foreach ($engineer['data'] as $rows)
        {
            $dataRow = array();
            $dataRow['fullname'] = $rows->fullname;
            $dataRow['employee_code'] = $rows->employee_code;
            $dataRow['is_active'] = 'OFF';
            if ($rows->is_active == 1)
            {
                $dataRow['is_active'] = 'ON';
            }
            $dataRow['department_name'] = $rows->department_name;
            $dataRow['gender'] = '';
            if ($rows->gender == 'f')
            {
                $dataRow['gender'] = 'Female';
            }
            elseif ($rows->gender == 'm')
            {
                $dataRow['gender'] = 'Male';
            }
            elseif ($rows->gender == 'o')
            {
                $dataRow['gender'] = 'Other';
            }
            $dataRow['email'] = $rows->email;
            $dataRow['birthday'] = ($rows->birthday != '0000-00-00' && $rows->birthday != null) ? date('d-m-Y', strtotime($rows->birthday)) : '';
            $dataRow['address'] = $rows->address;
            $dataRow['action'] = '<a href="detail/'.$rows->engineer_id.'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></a>';
            $engineerList[] = $dataRow;
        }

        return \Datatable::output($engineerList, $total);
        
    }
    /**
     * @author Vo Le Quynh My
     * @name edit
     * @todo
     * @return Response
     */
    public function getDetailEngineer($engineer_id)
    {
        $arrPositions = array();
        $arrDepartments = array();
        $arrSoftSkills = array();
        $arrTechniques = array();
        
        $engineer = $this->engineerModel->getDetailEngineer($engineer_id);
        
        if(!is_array($engineer))
        {
            return \App::abort(404);
        }
        //get position name
        $engineer['level_name'] = $this->engineerModel->getPositionIsCurrent($engineer['engineer_id']);
        $engineer['birthday'] = ($engineer['birthday'] != '0000-00-00' && $engineer['birthday'] != null) ? date('d-m-Y', strtotime($engineer['birthday'])) : '';
        //get list department
        $arrDepartment = $this->engineerModel->getListDepartment();
            //arrDepartment empty
        if(is_array($arrDepartment))
        {
            //arrDepartment not empty
            foreach($arrDepartment as $department)
            {
                $arrDepartments[$department['department_id']] = $department['department_name'];
            }
        }
        
        //get working skill name
        $engineer['working_area_name'] = $this->engineerModel->getWorkingSkillEngineer($engineer['working_area_id']);
        //get list techniques and level of engineer at is_current
        $arrTechniques = $this->engineerModel->getListTechniqueCurrent($engineer_id);
        //get list soft skill and level of engineer at is_current
        $arrSoftSkills = $this->engineerModel->getListSoftSkillCurrent($engineer_id);
        
        $data = array(
                'data'              => $engineer,
                'arrPosition'       => $arrPositions,
                'arrDepartment'     => $arrDepartments,
                'arrTechnique'      => $arrTechniques,
                'arrSoftSkill'      => $arrSoftSkills
        );
        return \View::make('engineer_skill.engineers.detail')->with($data);
    }
    /**
     * @author Vo Le Quynh My
     * @name updateEngineer
     * @todo update Engineer
     * @param integer engineer_id
     */
    public function updateEngineer($engineer_id)
    {
        $validate = $this->engineerModel->checkValidate();
        if ($validate === true)
        {
            if($this->engineerModel->updateEngineer($engineer_id) == false)
            {
                return \Redirect::route('engineer-detail', array($engineer_id))->withErrors($this->engineerModel->errors());
            }
            return \Redirect::route('engineer-list')->withFlashMessage('Engineer Update Successfully.');
        }
        else
        {
            return \Redirect::route('engineer-detail', array($engineer_id))->withErrors($validate);
        }
    }

}