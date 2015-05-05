<?php
/**
 * Class checkExistTest support test checkExist function
 *
 * @author Dung Le
 *
 * To do list
 * 1. testShouldReturnFalse_WhenDontExist.
 * 2. testShouldReturnTrue_WhenExist.
 * 
 */
class checkExistTest extends \Codeception\TestCase\Test {
	
	protected function _before()
	{
		parent::_before();
		\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
	}

	protected function _after()
	{
		parent::_after();
	}

	public function testShouldReturnFalse_WhenDontExist()
	{
		// Give
		$expected = false;
		\DB::table('classes')->delete();
		// When
		$actual = \Helper::checkExist(732891, 'class_id', 'classes');

		// verify
		$this->assertEquals($actual, $expected);
	}

	public function testShouldReturnTrue_WhenExist()
	{
		// Give
		$class_id = 1;
		$expected = true;
		\DB::table('classes')->delete();
		$arrData = [
			'class_id'			=> $class_id,
			'class_name' 		=> 'class 1',
			'course_id'			=> '1',
			'trainer_id' 		=> '1',
			'duration' 			=> rand(1,8).'.00',
			'has_examination' 	=> rand(0,1).'',
			'date' 				=> date("Y-m-d"),
			'created_at' 		=> '0000-00-00 00:00:00',
			'updated_at' 		=> '0000-00-00 00:00:00'
		];
		\DB::table('classes')->insert($arrData);
		// When
		$actual = \Helper::checkExist($class_id, 'class_id', 'classes');

		// verify
		$this->assertEquals($actual, $expected);
	}

}