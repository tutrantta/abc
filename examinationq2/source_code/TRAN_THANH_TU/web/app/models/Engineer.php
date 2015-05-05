<?php
/**
 * Engineer Model
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-01          Vo Le Quynh My     Create File
 */
class Engineer extends BaseModel {
    
    protected $fillable = [
            'engineer_id',
            'employee_code',
            'department_id',
            'fullname',
            'birthday',
            'email',
            'address',
            'phone',
            'other_information',
            'gender',
            'has_interview_form',
            'is_active'
    ];
    static $rules = [
            'employee_code'=>'required|max:20|unique:engineers',
            'fullname'=>'required|max:50',
            'email' => 'email|max:100',
            'phone' => 'numeric|digits_between:10, 15',
            'birthday' => 'date'
    ];
    /**
     * @author Quynh My
     * @name addEngineer
     * @todo Add engineer
     * 
     */
    public function addEngineer()
    {
        return $this->save();
    }
    /**
     * @author Quynh My
     * @name getListEngineer
     * @todo Show list engineer
     * @return array
     */
    public function getListEngineer($params = [])
    {
        $query = \DB::table('engineers')->leftJoin('departments', function($join)
        {
            $join->on('engineers.department_id', '=', 'departments.department_id');
            
        })
        ->select('engineers.*', 'departments.department_name');
        // seach
        $query->where('engineers.fullname', 'like', '%' . $params['search'] . '%');
        $query->orWhere('engineers.employee_code', 'like', '%' . $params['search'] . '%');
        // count all
        $count = $query->count();
        // build query limit
        $query->skip($params['offset']);
        $query->take($params['limit']);
        // build query orderby
        $query->orderBy($params['order'], $params['sort']);
        // get all data
        $data = $query->get();
        // return data
        return ['data' => $data, 'count' => $count];
    }
    
    /**
     * @author Quynh My
     * @name checkValidate
     * @todo check validate
     * @return boolean
     */
    public function checkValidate()
    {
        if (Input::get('employee_code_hidden') == Input::get('employee_code'))
        {
            unset(self::$rules['employee_code']);
        }
        $validator = \Validator::make(Input::all(), self::$rules);
        if($validator->fails())
        {
            return $validator->messages();
        }
        return true;
    }
    /**
     * @author Quynh My
     * @name getDetailEngineer
     * @todo get Detail Engineer
     * @param integer $engineer_id
     * @return array
     */
    public function getDetailEngineer($engineer_id)
    {
        $tmp = \DB::table('engineers')
                    ->leftJoin('interview_forms', 'engineers.engineer_id', '=', 'interview_forms.engineer_id')
                    ->where('engineers.engineer_id', '=', $engineer_id)
                    ->select('engineers.*', 'interview_forms.working_area_id')->get();
        // if array null return false
        if(empty($tmp))
        {
            return false;
        }
        //convert from object to array
        foreach($tmp as $values)
        {
            $data = get_object_vars($values);
        }
        return $data;
    }
    /**
     * @author Quynh My
     * @name getPositionIsCurrent
     * @todo get Position Is Current
     * @return array
     */
    public function getPositionIsCurrent($engineer_id)
    {
        $result = \DB::table('levels')->Join('engineer_position_history', 'engineer_position_history.level_id', '=', 'levels.level_id')
                                      ->where('engineer_position_history.engineer_id', '=', $engineer_id)
                                      ->where('is_current', '=', 1)
                                      ->select('level_name')
                                      ->get();
        return isset($result[0]) ? $result[0]->level_name : NULL;
    }
    /**
     * @author Quynh My
     * @name getListDepartment
     * @todo get List Department
     * @return array
     */
    public function getListDepartment()
    {
        $result = \DB::table('departments')->where('is_active', '=', '1')->get();
        // if array null return false
        if(empty($result))
        {
            return false;
        }
        //convert from object to array
        foreach ($result as $value) {
            $arrDepartment[] = get_object_vars($value);
        }
        return $arrDepartment;
    }
    /**
     * @author Quynh My
     * @name getWorkingSkillEngineer
     * @todo get Working Skill Engineer
     * @return array
     */
    public function getWorkingSkillEngineer($working_area_id)
    {
        $result = \DB::table('working_areas')->where('working_area_id', '=', $working_area_id)
                                             ->select('working_area_name')
                                             ->get();
        return isset($result[0]) ? $result[0]->working_area_name : NULL;
    }
    /**
     * @author Quynh My
     * @name getListTechniqueCurrent
     * @todo get List Technique Current Of Engineer
     * @param integer $engineer_id
     * @return array
     */
    public function getListTechniqueCurrent($engineer_id)
    {
        $tmp = \DB::table('engineer_technique_level_history')
                      ->join('techniques', 'techniques.technique_id', '=', 'engineer_technique_level_history.technique_id')
                      ->join('levels', 'levels.level_id', '=', 'engineer_technique_level_history.level_id')
                      ->where('engineer_technique_level_history.engineer_id', '=', $engineer_id)
                      ->where('engineer_technique_level_history.is_current', '=', '1')
                      ->select('techniques.technique_name', 'levels.level_name')
                      ->get();
        // if array null return false
        if(empty($tmp))
        {
            return false;
        }
        foreach($tmp as $value)
        {
            $arrTechnique[] = get_object_vars($value);
        }
        return $arrTechnique;
    }
    /**
     * @author Quynh My
     * @name getListSoftSkillCurrent
     * @todo get List Soft Skill Current Of Engineer
     * @param integer $engineer_id
     * @return array
     */
    public function getListSoftSkillCurrent($engineer_id)
    {
        $tmp = \DB::table('engineer_soft_skill_level_history')
                    ->join('soft_skills', 'engineer_soft_skill_level_history.soft_skill_id', '=', 'soft_skills.soft_skill_id')
                    ->where('engineer_soft_skill_level_history.engineer_id', '=', $engineer_id)
                    ->where('engineer_soft_skill_level_history.is_current', '=', '1')
                    ->select('soft_skills.soft_skill_name', 'engineer_soft_skill_level_history.soft_skill_level')
                    ->get();
        // if array null return false
        if(empty($tmp))
        {
            return false;
        }
        foreach($tmp as $value)
        {
            $arrSoftSkill[] = get_object_vars($value);
        }
        return $arrSoftSkill;
    
    }
    /**
     * @author Quynh My
     * @name updateEngineer
     * @todo update Engineer
     * @param integer engineer_id
     * @return boolean
     */
    public function updateEngineer($engineer_id)
    {
        $employee_code_hidden = Input::get('employee_code_hidden');
        $data = array(
        'fullname'         => Input::get('fullname'),
        'employee_code'    => Input::get('employee_code'),
        'address'          => Input::get('address'),
        'phone'            => Input::get('phone'),
        'gender'           => Input::get('gender'),
        'birthday'         => date('Y-m-d', strtotime(Input::get('birthday'))),
        'is_active'        => Input::get('is_active'),
        'department_id'    => Input::get('department_id'),
        'other_information'=> Input::get('other_information')
        );
        if ($employee_code_hidden == Input::get('employee_code'))
        {
            unset($data['employee_code']);
        }
        return $this->where('engineers.engineer_id', $engineer_id)->update($data);
    }
    /**
     * @author NgocNguyen
     * @name getListEngineer
     * @todo get list engineer
     * @param 
     * @return array
     */
    public function getLists(){
        return $this->where('is_active','=', \Config::get('configs.user_active'))->get();
    }
}