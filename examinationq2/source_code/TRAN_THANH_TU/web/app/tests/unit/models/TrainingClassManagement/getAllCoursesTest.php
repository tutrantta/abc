<?php namespace models\TrainingClassManagement;
require_once 'TestBase.php';
/**
 * Class getAllCoursesTest support test getAllCourses function
 *
 * @author Dung Le
 *
 * To do list
 * 1. testShouldReturnEmpty_WhenCourseTableIsEmpty.
 * 2. testShouldReturnAll_WhenCourseTableHasData.
 * 
 */
class getAllCoursesTest extends TestBase {
	
	protected $number = 5;
	protected function _before()
	{
		parent::_before();
		// set up table
		$this->setUpAreas($this->number);
		$this->setUpCourse($this->number);
	}

	protected function _after()
	{
		parent::_after();
	}

	public function testShouldReturnEmpty_WhenCourseTableIsEmpty()
	{
		// Give
		$expected = array();
		\DB::table('courses')->delete();
		// When
		$actual = $this->objTraining->getAllCourses();

		// verify
		$this->assertEquals($actual, $expected);
	}

	public function testShouldReturnAll_WhenCourseTableHasData()
	{
		// Give
		foreach ($this->arrCourse as $key => $value) {
			$expected[$value['course_id']] = $value['course_name'];
		}
		// When
		$actual = $this->objTraining->getAllCourses();

		// verify
		$this->assertEquals($actual, $expected);
	}
}