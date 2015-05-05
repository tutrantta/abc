<?php
/**
 * Trainer Management Model
 *
 * Date                  Author         Content
 * ----------------------------------------------------
 * 2015-04-13          NguyenHien           Create File
 * 2015-04-15          Vo Le Quynh My       Update File
 * 2015-05-04          Dung Le              Add new function getListTrainerWithStatus
 */

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class TrainerManagement extends BaseModel {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'trainers';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	protected $fillable = [
	        'trainer_id',
	        'employee_code',
	        'trainer_name',
	        'description'
	];
	protected $primaryKey = 'trainer_id';
	static $rules = [
	        'employee_code'=>'required',
	        'trainer_name'=>'required|max:50',
	        'description' => 'max:1000',
	];

	/**
     * @author NguyenHien
     * @name getListEmp
     * @todo get list employee
     * @return Boolean
     */
	public function getListEmp() 
	{
		$result = \DB::table('engineers')->where('is_active', '=', '1')->get();

		//check object null return false
		if (empty($result))
		{
			return false;
		}

		//convert form object to array
		foreach ($result as $key => $value)
		{
			$arrEmp[] = get_object_vars($value);
		}
		return $arrEmp;
	}
	/**
	 * @author Quynh My
	 * @name getListEngineerForView
	 * @todo 
	 * @return 
	 */
	public function getListEngineerForView()
	{
	    $arrNames = array();
	     
	    //get list employee
	    $arrEmp = $this->getListEmp();
	    $code['External'] = 'External Person';
	    //arrEmp is array
	    if(is_array($arrEmp))
	    {
	        foreach($arrEmp as $emp)
	        {
	            $code[$emp['employee_code']] = $emp['employee_code'];
	            $arrNames[$emp['employee_code']] = $emp['fullname'];
	        }
	    }
	    return [$code, $arrNames];
	}
	/**
     * @author Quynh My
     * @name addTrainer
     * @todo Add Trainer
     * @return Boolean
     */
    public function addTrainer()
	{
	    if (Input::get('employee_code') != 'External')
	    {
	        self::$rules = [
	                'employee_code'=>'required|unique:trainers',
	                'trainer_name'=>'required|max:50|unique:trainers',
	                'description' => 'max:1000',
	        ];
	    }
	    return $this->save();
	}
	
	/**
	 * @author Vo Le Quynh My
	 * @name getDetailTrainer
	 * @todo get detail trainer by id
	 * @return 
	 */
	public function getDetailTrainer($trainer_id)
	{
	    if(!isset($trainer_id))
        {
            return false;
        }
        return $this->find($trainer_id);
	}
	/**
	 * @author Vo Le Quynh My
	 * @name updateTrainer
	 * @todo update trainer
	 * @return
	 */
	public function updateTrainer($trainer_id)
	{
	    $result = $this->getDetailTrainer($trainer_id);
	   
	    if ($result->save() == false)
	    {
	        return $result->errors();
	    }
	    return true;
	}
	
	/**
	 * getListTrainerWithStatus function support get list trainer with status check
	 * 
	 * @author Dung Le
	 * @return array to view
	 */
	public function getListTrainerWithStatus()
	{
	    // get employee list
	    $arrEmp = $this->getListEmp();
	    $arrCode = array();
	    // build array value
	    if (!empty($arrEmp)) {
	        $arrCode = array_map(function($arrEmp) {return $arrEmp['employee_code'];}, $arrEmp);
	    }
        $arrCode = array_merge($arrCode, ['External']); // merge with external code
        // build where condition
        $where  = 'employee_code IN (';
        $where .= implode(',', array_fill(0, count($arrCode), '?'));
        $where .= ')';
        
        $arrRet = $this->whereRaw($where, $arrCode)->get();
        $arrRet = \Helper::getArrayIdValue($arrRet, 'trainer_id', 'trainer_name');
        
        return $arrRet;
	}
}