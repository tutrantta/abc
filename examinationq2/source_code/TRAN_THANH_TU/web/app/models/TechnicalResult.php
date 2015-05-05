<?php
/**
 * TechnicalResult Model
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-14          Trieu Nguyen     Create File
 */
class TechnicalResult extends BaseModel {

    protected $table = 'class_assignments';
    protected $primaryKey = 'class_id';
    protected $fillable = [
        'class_id',
        'engineer_id',
        'examination_result',
        'pass_examination'
    ];
    
    public static $rules = [
        'class_id' => 'required',
        'engineer_id' => 'required',
        'examination_result' => 'between:0,100|numeric',
        'pass_examination' => 'boolean'
    ];

    /**
     * @author Nguyen Trieu
     * @name get list technical result
     * @param $class_id int
     * @return array
     */
    public function getList($class_id = 0)
    {
        // show col 
        $col = ['t2.employee_code', 't2.fullname', 't1.examination_result', 't1.pass_examination'];
        // get request datatable
        $datatableRequest = \Datatable::request($col, 't2.employee_code', 'desc');
        // get search value
        $searchValue = $datatableRequest['search'];
        // build query
        $query = \DB::table('class_assignments as t1');
        
        $query->join('engineers as t2', 't1.engineer_id', '=', 't2.engineer_id');
        $query->where('t1.class_id', '=', $class_id);
        $query->where('t2.is_active', '=', 1);
        $query->where('t2.fullname', 'like', '%'.$searchValue.'%');

        $query->select('t2.fullname', 't1.class_id', 't1.examination_result', 't1.pass_examination', 't2.employee_code', 't2.engineer_id');
        // count total record
        $total = $query->count();
        // build limit and order by
        $query->skip($datatableRequest['offset']);
        $query->take($datatableRequest['limit']);
        $query->orderBy($datatableRequest['order'], $datatableRequest['sort']);
        // get data
        $data = $query->get(); 
        // return data
        return ['data' => $data, 'count' => $total];
    }

    /**
    * @author Nguyen Trieu
    * @name update technical result
    * @param $class_id int
    * @param $engineer_id int
    * @param $updateData array
    * @return bool
    */
    public function updateResult($class_id, $engineer_id, array $updateData)
    {
        $query = \DB::table('class_assignments');
        $query->where('class_id', $class_id);
        $query->where('engineer_id', $engineer_id);
        $query->update($updateData);
        return $query;
    }
    
    /**
    * @author Nguyen Trieu
    * @name validation
    * @param $arrData array
    * @return mixed
    */
    public function doValidate($arrData)
    {
        $validate = Validator::make($arrData, self::$rules);
        if ($validate->fails()) {
            return $validate;
        }
        return true;
    }
}