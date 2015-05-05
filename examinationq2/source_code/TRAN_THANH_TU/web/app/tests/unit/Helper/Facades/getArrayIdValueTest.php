<?php
/**
 * Class getArrayIdValueTest support test getArrayIdValue function
 *
 * @author Dung Le
 *
 * To do list
 * 1. testShouldReturnFalse_WhenInputIsNotArray.
 * 2. testShouldReturnArray_WhenEmlementIsArray.
 * 3. testShouldReturnArray_WhenEmlementIsObject.
 */
class getArrayIdValueTest extends \Codeception\TestCase\Test {
	
	protected function _before()
	{
		parent::_before();
		\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		\DB::table('classes')->delete();
	}

	protected function _after()
	{
		parent::_after();
	}

	public function testShouldReturnArray_WhenEmlementIsArray()
	{
		// Give
		$class_id = 1;
		$arrData = [[
			'class_id'			=> $class_id,
			'class_name' 		=> 'class 1',
			'course_id'			=> '1',
			'trainer_id' 		=> '1',
			'duration' 			=> rand(1,8).'.00',
			'has_examination' 	=> rand(0,1).'',
			'date' 				=> date("Y-m-d"),
			'created_at' 		=> '0000-00-00 00:00:00',
			'updated_at' 		=> '0000-00-00 00:00:00'
		]];
		$expected[$class_id] = $arrData[0]['class_name'];
		// When
		$actual = \Helper::getArrayIdValue($arrData, 'class_id', 'class_name');

		// verify
		$this->assertEquals($actual, $expected);
	}

	public function testShouldReturnArray_WhenEmlementIsObject()
	{
		// Give
		$class_id = 1;
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

		$data = \DB::table('classes')->get();

		foreach ($data as $key => $value) {
			$expected[$value->class_id] = $value->class_name;
		}
		// When
		$actual = \Helper::getArrayIdValue($data, 'class_id', 'class_name');

		// verify
		$this->assertEquals($actual, $expected);
	}

}