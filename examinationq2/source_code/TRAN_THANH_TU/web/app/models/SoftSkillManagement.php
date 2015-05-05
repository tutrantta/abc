<?php
/**
 * Soft skill management Models
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-03-31          LamKy     Create File
 */

class SoftSkillManagement extends BaseModel
{
    protected $fillable = ['updated_time', 'soft_skill_name', 'soft_skill_level'];
    
    /**
     * 
     * @param string $engineer_id
     * @return array
     * @author LamKy
     * @method get soft skill detail of engineer
     */
    public function getSoftSkillDetail($engineer_id, $params)
    {
        // get soft skill histories of engineer
        $result_db = DB::table('engineer_soft_skill_level_history as T1')
            ->join('soft_skills as T2', function($join) use ($engineer_id)
            {
                $join->on('T1.soft_skill_id', '=','T2.soft_skill_id')
                     ->where('T1.engineer_id', '=', $engineer_id);
            })
            ->select('T1.*', 'T2.soft_skill_name')
            // support search on datatable
            ->where('T2.soft_skill_name','like', '%'.$params['searchValue'].'%')
            ->orWhere('T1.updated_time','=', $params['searchValue'])
            ->orWhere('T1.soft_skill_level','=', $params['searchValue']);
       // count total result, show on layout
       $total = $result_db->count();
       // support pagination, sort
       $data = $result_db->take($params['limit'])
            ->skip($params['offset'])
            ->orderby($params['order'], $params['sort'])
            ->get();
        // check empty
        if (empty($data)) 
        {
            return false;
        }
        
        foreach ($data as $key => $value)
        {
            $arrValue = get_object_vars($value);
            
            $arrSkillDetail[$key]['soft_skill_name']     = $arrValue['soft_skill_name'];
            $arrSkillDetail[$key]['updated_time']        = $arrValue['updated_time'];
            $arrSkillDetail[$key]['soft_skill_level']    = $arrValue['soft_skill_level'];
        }
        
        return ['count' => $total, 'data' => $arrSkillDetail];
    }
    
    /**
     * 
     * @param string $engineer_id
     * @return string $fullname of engineer
     * @author Lamky
     * @method get fullname of engineer
     */
    public function getEngineerFullname($engineer_id)
    {
        $result_db = DB::table('engineer_soft_skill_level_history as T1')
            ->join('engineers as T2', function($join) use ($engineer_id)
            {
                $join->on('T1.engineer_id', '=', 'T2.engineer_id')
                     ->where('T1.engineer_id','=', $engineer_id);
            })
            ->select('T2.fullname')
            ->first();
        if (!$result_db)
        {
            return false;
        }
        $fullname = get_object_vars($result_db);
        return $fullname['fullname'];
    }
}