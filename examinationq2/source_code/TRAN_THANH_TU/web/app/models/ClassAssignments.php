<?php
/**
 * Class Assignments Model
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-15          NgocNguyen     Create File
 */

class ClassAssignments extends \BaseModel {
	
	protected $table = 'class_assignments';
	
	protected $primaryKey = '';
	
	protected $fillable = ['class_id','engineer_id'];
	
	public static $rules = [];

	/**
     * @author NgocNguyen
     * @name scopeWhereArray
     * @todo group by where in array
     * @return array
     */
	public function scopeWhereArray($query, $array) {
		foreach($array as $field => $value) {
			$query->where($field, $value);
		}
		return $query;
	}



	/**
     * @author NgocNguyen
     * @name getListById
     * @todo get list by class id
     * @return array
     */
	public function getListById($id)
	{
		if(!isset($id) || (int)$id == 0){
			return false;
		}
		return \DB::table($this->table)
		->select("engineer_id")
		->where('class_id', '=', $id)
		->get();
	}

	/**
     * @author NgocNguyen
     * @name excuteSave
     * @todo save list engineer assignment
     * @return bool
     */
	public function excuteSave($param){
		try{
			return $this->insert($param);
		} catch(\Illuminate\Database\QueryException $e){
			return false;
		}
	}

	/**
     * @author NgocNguyen
     * @name excuteDelete
     * @todo delete list engineer not assignment
     * @return bool
     */
	public function excuteDelete($id,$param){
		//check param
		if(!isset($id) || empty($param)){
			return false;
		}
		//excute delete
		foreach ($param as $key => $value) {
			$results=$this->WhereArray([
				'class_id'=> $id,
				'engineer_id'=>$value])->delete();
		}
		return $results;
	}

}