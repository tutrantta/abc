<?php namespace models\TrainingClassManagement;
require_once 'TestBase.php';
/**
 * Class getClassTest support test getClass function
 *
 * @author Dung Le
 *
 * To do list
 * 1. testShouldReturnArray_WhenClassIdCorrect
 * 2. testShouldReturnEmpty_WhenClassIdIncorrect
 */
class getClassTest extends TestBase {
	
	protected $number = 5;
	protected function _before()
	{
		parent::_before();
		// set up master table
		$this->setUpClass($this->number);
		// $this->setUpClassAssignment($this->number);
	}

	protected function _after()
	{
		parent::_after();
	}

	public function testShouldReturnArray_WhenClassIdCorrect()
	{
		// Give
		$class_id = 1;
		$expected = $this->arrClass[0];

		// When
		$actual = get_object_vars($this->objTraining->getClass($class_id));
		// verify
		$this->assertEquals($actual, $expected);
	}
	public function testShouldReturnEmpty_WhenClassIdIncorrect()
	{
		// Give
		$class_id = $this->number + 1;
		$expected = NULL;

		// When
		$actual = $this->objTraining->getClass($class_id);
		// verify
		$this->assertEquals($actual, $expected);
	}
}