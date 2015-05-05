<?php 

class WorkingSkill extends \BaseModel {
	protected $table = 'working_areas';

	public static function getWorkingAreas()
	{
		return \DB::table('working_areas')->where('is_active', '=', 1)->orderBy('working_area_id', 'asc')->get();
	}
}