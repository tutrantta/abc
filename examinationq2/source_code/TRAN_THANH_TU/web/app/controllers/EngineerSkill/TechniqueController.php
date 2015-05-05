<?php
/**
 * Technique Controller
 *
 * Date                Author         Content
 * ----------------------------------------------------
 * 2015-04-01         NguyenHien     Create File
 */

namespace EngineerSkill;

class TechniqueController extends \BaseController {

	protected $techniqueModel;

	public function __construct(\Technique $technique)
     {
		$this->techniqueModel = $technique;
	}

     /**
     * 
     * @param $engineer_id
     * @return 
     * @method create view and ajax datatables for techinique skill detail of engineer
     * @author HienNguyen
     */
    public function getDetail($engineer_id)
    {
       // get technique skill detail and full name of engineer

       $fullname = $this->techniqueModel->getEngineerFullname($engineer_id);
       if (!$fullname) 
       {
           \App::abort(404);
       }
       
       // create ajax for datatable.
       if (\Request::ajax())
       {
            $columns = array('updated_time', 'technique_name', 'level_name');
            $request = \Input::all();
            $params = [
                'offset' => !empty($request['start']) ? $request['start'] : 0,
                'limit' => !empty($request['length']) ? $request['length'] : 10,
                'order' => !empty($request['order'][0]['column']) ? $columns[$request['order'][0]['column']] : 'technique_id',
                'sort' => !empty($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'asc',
                'search' => !empty($request['search']['value']) ? $request['search']['value'] : null,
            ];
            // get data for table
            $technique_skill = $this->techniqueModel->getTechniqueSkillDetail($engineer_id, $params);
            $total = $technique_skill['count'];
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

            if(!empty($technique_skill['data'])){
                foreach ($technique_skill['data'] as $rows) 
                {
                    $dataRow = array();
                    $dataRow['updated_time']      = $rows['updated_time'];
                    $dataRow['technique_name']    = $rows['technique_name'];
                    $dataRow['level_name']        = $rows['level_name'];
                    $output['data'][]             = $dataRow;
                }
            }
            // return string json
            return json_encode($output);
        }
        return \View::make('engineer_skill.techniques.detail',['fullname'=>$fullname,'engineer_id'=>$engineer_id]);

    }



}
