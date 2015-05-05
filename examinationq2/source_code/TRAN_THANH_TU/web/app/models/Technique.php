<?php
/**
 * Technique skill management Models
 *
 * Date                 Author          Content
 * ----------------------------------------------------
 * 2015-04-01          NguyenHien     Create File
 */

class Technique extends BaseModel
{
    protected $fillable = ['updated_time', 'technique_name', 'level_name'];
    
    /**
     * 
     * @param string $technique_id
     * @return array
     * @author NguyenHien
     * @method get soft skill detail of engineer
     */
    public function getTechniqueSkillDetail($engineer_id, $params)
    {
        //check empty
        if (empty($engineer_id)) {
            return false;
        }
        // get soft skill histories of engineer
        $result_db = DB::table('engineer_technique_level_history as T1')
            ->select('T3.level_name','T1.*', 'T2.technique_name')
            ->join('techniques as T2', function($join) use ($engineer_id)
            {
                $join->on('T1.technique_id', '=','T2.technique_id')
                     ->where('T1.engineer_id', '=', $engineer_id)
                     ->where('T2.is_active', '=', 1);
            })

            //join table levels
            ->join('levels as T3', function($join) use ($engineer_id)
            {
                $join->on('T1.level_id', '=','T3.level_id')
                     ->where('T1.engineer_id', '=', $engineer_id)
                     ->where('T3.is_active', '=', 1);
            })
            
            // support search on datatable
            ->where('T3.level_name','like', '%'.$params['search'].'%')
            ->orwhere('T2.technique_name','like', '%'.$params['search'].'%')
            ->orWhere('T1.updated_time','=', $params['search']);
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
            $arrTechniqueDetail[] = get_object_vars($value);
        }
        
        return ['count' => $total, 'data' => $arrTechniqueDetail];
    }
    
    /**
     * 
     * @param string $engineer_id
     * @return string $fullname of engineer
     * @author NguyenHien
     * @method get fullname of engineer
     */
    public function getEngineerFullname($engineer_id)
    {
        $result_db = DB::table('engineer_technique_level_history as T1')
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