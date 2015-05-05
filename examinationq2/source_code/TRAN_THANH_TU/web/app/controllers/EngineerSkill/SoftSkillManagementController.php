<?php
/**
 * Soft skill management Controller
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-03-31          LamKy     Create File
 * 2015-04-02          LamKy     Update function
 */

namespace EngineerSkill;
class SoftSkillManagementController extends \BaseController
{
    protected $softSkillManagement;
    
    public function __construct(\SoftSkillManagement $softSkillManagement)
    {
        $this->softSkillManagement = $softSkillManagement;
    }
    
    /**
     * 
     * @param $engineer_id
     * @return 
     * @method create view and ajax datatables for soft skill detail of engineer
     * @author LamKy
     */
    public function getDetail($engineer_id)
    {
       // get soft skill detail and full name of engineer
       
       $fullname = $this->softSkillManagement->getEngineerFullname($engineer_id);
       // show error 404 screen when cann't get employee name
       if (!$fullname) 
       {
           return  \App::abort(404);
       }
       
       // create ajax for datatable.
       if (\Request::ajax())
       {
            $columns = array('soft_skill_name', 'updated_time', 'soft_skill_level' );
            $request = \Input::all();
            $params = [
                'offset' => !empty($request['start']) ? $request['start'] : 0,
                'limit' => !empty($request['length']) ? $request['length'] : 10,
                'order' => !empty($request['order'][0]['column']) ? $columns[$request['order'][0]['column']] : 'soft_skill_name',
                'sort' => !empty($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'asc',
                'searchValue' => !empty($request['search']['value']) ? $request['search']['value'] : null,
            ];
            // get data for table
            $soft_skill = $this->softSkillManagement->getSoftSkillDetail($engineer_id, $params);
            
            $total = $soft_skill['count'];
            if (!$total) 
            {
                $total = 0;
            }
            $output = [
                'draw'              => $request['draw'],
                'recordsFiltered'   => $total,
                'recordsTotal'      => $total,
                'data'              => array()
            ];
            // create data for row on datatables
            if(!empty($soft_skill['data'])){
                foreach ($soft_skill['data'] as $rows) 
                {
                    $dataRow = array();
                    $dataRow['soft_skill_name']     = $rows['soft_skill_name'];
                    $dataRow['updated_time']        = $rows['updated_time'];
                    $dataRow['soft_skill_level']    = $rows['soft_skill_level'];
                    $output['data'][]               = $dataRow;
                }
            }
            // return string json
            return json_encode($output);
        }
        // create view
        else
        {
            return \View::make('engineer_skill.softskill.detail', ['fullname'=>$fullname,'engineer_id'=>$engineer_id]);
        }
    }
}