<?php namespace models\TrainingClassManagement;
require_once 'TestBase.php';
/**
 * Class getAllTrainerTest support test getAllTrainer function
 *
 * @author Dung Le
 *
 * To do list
 * 1. testShouldReturnEmpty_WhenCourseTableIsEmpty.
 * 2. testShouldReturnAll_WhenCourseTableHasData.
 * 
 */
class getAllTrainerTest extends TestBase {
	
	protected $number = 5;
	protected function _before()
	{
		parent::_before();
		// set up table
		$this->setUpTrainer($this->number);
	}

	protected function _after()
	{
		parent::_after();
	}

	public function testShouldReturnEmpty_WhenCourseTableIsEmpty()
	{
		// Give
		$expected = array();
		\DB::table('trainers')->delete();
		// When
		$actual = $this->objTraining->getAllTrainer();

		// verify
		$this->assertEquals($actual, $expected);
	}

	public function testShouldReturnAll_WhenCourseTableHasData()
	{
		// Give
		foreach ($this->arrTrainer as $key => $value) {
			$expected[$value['trainer_id']] = $value['trainer_name'];
		}
		// When
		$actual = $this->objTraining->getAllTrainer();

		// verify
		$this->assertEquals($actual, $expected);
	}
}