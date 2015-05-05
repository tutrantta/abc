<?php
/**
 * Technique Controller
 * @author Tung Ly
 * 
 */
class Level extends \BaseModel {
	
	protected $table = 'levels';

	/**
	 * @author Dung Le
	 */
    public static function getLevels()
    {
    	return \DB::table('levels')->where('is_active', '=', 1)->orderBy('level_name', 'asc')->get();
    }
}