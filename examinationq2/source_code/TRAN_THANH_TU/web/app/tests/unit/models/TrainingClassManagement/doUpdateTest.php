<?php namespace models\TrainingClassManagement;
require_once 'TestBase.php';
/**
 * Class doUpdateTest support test doUpdate function
 *
 * @author Dung Le
 *
 * To do list
 * 1. testShouldReturnFalse_WhenClassNameIsEmpty
 * 2. testShouldReturnFalse_WhenClassNameIsExist
 * 3. testShouldReturnFalse_WhenCourseIsEmpty
 * 4. testShouldReturnFalse_WhenCourseIsCharacter
 * 5. testShouldReturnFalse_WhenDateIsIncorrectFormat
 * 6. testShouldReturnFalse_WhenDateIsEmpty
 * 7. testShouldReturnFalse_WhenExamIsCharacter
 * 8. testShouldReturnTrue_WhenInsertSuccessfull
 * 9. testShouldReturnFalse_WhenClassNameIsMoreThan50Characters
 */
class doUpdateTest extends TestBase {
	
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

	public function testShouldReturnFalse_WhenClassNameIsEmpty()
	{
		// Give
		$class_id = 1;
		$expected = array('The class name field is required.');
		$arrData = [
			'class_name'        => '',
            'course_id'         => '1',
            'date'              => '2000-01-01',
            'duration'          => '1',
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doUpdate($class_id);
		$actual = $return->all();

		// verify
		$this->assertEquals($actual, $expected);
	}

	public function testShouldReturnFalse_WhenClassNameIsExist()
	{
		// Give
		$class_id = 1;
		$expected = array('The class name has already been taken.');
		$arrData = [
			'class_name'        => 'class 2',
            'course_id'         => '1',
            'date'              => '2000-01-01',
            'duration'          => '1',
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doUpdate($class_id);
		$actual = $return->all();

		// verify
		$this->assertEquals($actual, $expected);
	}

	public function testShouldReturnFalse_WhenCourseIsEmpty()
	{
		// Give
		$class_id = 1;
		$expected = array('The course id field is required.');
		$arrData = [
			'class_name'        => 'class 1',
            'course_id'         => '',
            'date'              => '2000-01-01',
            'duration'          => '1',
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doUpdate($class_id);
		$actual = $return->get('course_id');

		// verify
		$this->assertEquals($actual, $expected);
	}
	public function testShouldReturnFalse_WhenCourseIsCharacter()
	{
		// Give
		$class_id = 1;
		$expected = array('The course id must be a number.');
		$arrData = [
			'class_name'        => 'class 1',
            'course_id'         => 'test',
            'date'              => '2000-01-01',
            'duration'          => '1',
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doUpdate($class_id);
		$actual = $return->get('course_id');

		// verify
		$this->assertEquals($actual, $expected);
	}
	public function testShouldReturnFalse_WhenDateIsIncorrectFormat()
	{
		// Give
		$class_id = 1;
		$expected = array('The date is not a valid date.');
		$arrData = [
			'class_name'        => 'class 1'.$this->number + 1,
            'course_id'         => '1',
            'date'              => '2000',
            'duration'          => '1',
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doUpdate($class_id);
		$actual = $return->get('date');


		// verify
		$this->assertEquals($actual, $expected);
	}
	public function testShouldReturnFalse_WhenDateIsEmpty()
	{
		// Give
		$class_id = 1;
		$expected = array('The date field is required.');
		$arrData = [
			'class_name'        => 'class 1'.$this->number + 1,
            'course_id'         => '1',
            'date'              => '',
            'duration'          => '1',
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doUpdate($class_id);
		$actual = $return->get('date');

		// verify
		$this->assertEquals($actual, $expected);
	}
	public function testShouldReturnFalse_WhenExamIsCharacter()
	{
		// Give
		$class_id = 1;
		$expected = array('The has examination field must be true or false.');
		$arrData = [
			'class_name'        => 'class 1'.$this->number + 1,
            'course_id'         => '1',
            'date'              => '2000-01-02',
            'duration'          => '1',
            'has_examination'   => 'aaaa',
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doUpdate($class_id);
		$actual = $return->get('has_examination');

		// verify
		$this->assertEquals($actual, $expected);
	}
	public function testShouldReturnFalse_WhenExamIsInteger()
	{
		// Give
		$class_id = 1;
		$expected = array('The has examination field must be true or false.');
		$arrData = [
			'class_name'        => 'class 1'.$this->number + 1,
            'course_id'         => '1',
            'date'              => '2000-01-02',
            'duration'          => '1',
            'has_examination'   => '3',
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doUpdate($class_id);
		$actual = $return->get('has_examination');

		// verify
		$this->assertEquals($actual, $expected);
	}
	public function testShouldReturnTrue_WhenInsertSuccessfull()
	{
		// Give
		$class_id = 1;
		$expected = true;
		$arrData = [
			'class_name'        => 'class 1'.$this->number + 1,
            'course_id'         => '1',
            'date'              => '2000-01-02',
            'duration'          => '1',
            'has_examination'   => true,
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doUpdate($class_id);
		$actual = $return;

		// verify
		$this->assertEquals($actual, $expected);
	}

	public function testShouldReturnFalse_WhenClassNameIsMoreThan50Characters()
	{
		// Give
		$class_id = 1;
		$expected = array('The class name may not be greater than 50 characters.');
		$className = '';
		for($i = 1; $i <= 51; $i++) $className .= 'a';
		$arrData = [
			'class_name'        => $className,
			'course_id'         => '1',
			'date'              => '2000-01-01',
			'duration'          => '1',
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doUpdate($class_id);
		$actual = $return->all();

		// verify
		$this->assertEquals($actual, $expected);
	}
}