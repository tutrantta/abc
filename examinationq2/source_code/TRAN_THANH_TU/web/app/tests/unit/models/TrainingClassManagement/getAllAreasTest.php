<?php namespace models\TrainingClassManagement;
require_once 'TestBase.php';
/**
 * Class getAllAreasTest support test getAllAreas function
 *
 * @author Dung Le
 *
 * To do list
 * 1. testShouldReturnEmpty_WhenCourseTableIsEmpty.
 * 2. testShouldReturnAll_WhenCourseTableHasData.
 * 
 */
class getAllAreasTest extends TestBase {
	
	protected $number = 5;
	protected function _before()
	{
		parent::_before();
		// set up table
		$this->setUpAreas($this->number);
	}

	protected function _after()
	{
		parent::_after();
	}

	public function testShouldReturnEmpty_WhenCourseTableIsEmpty()
	{
		// Give
		$expected = array();
		\DB::table('areas')->delete();
		// When
		$actual = $this->objTraining->getAllAreas();

		// verify
		$this->assertEquals($actual, $expected);
	}

	public function testShouldReturnAll_WhenCourseTableHasData()
	{
		// Give
		foreach ($this->arrAreas as $key => $value) {
			$expected[$value['area_id']] = $value['area_name'];
		}
		// When
		$actual = $this->objTraining->getAllAreas();

		// verify
		$this->assertEquals($actual, $expected);
	}
}