<?php namespace models\TrainingClassManagement;
require_once 'TestBase.php';
/**
 * Class doInsertTest support test doInsert function
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
 * 9. testShouldReturnFalse_WhenClassNameMoreThan50Characters
 */
class doInsertTest extends TestBase {
	
	protected $number = 5;
	protected function _before()
	{
		parent::_before();
		// set up master table
		// $this->setUpClass($this->number);
		// $this->setUpClassAssignment($this->number);
	}

	protected function _after()
	{
		parent::_after();
	}

	public function testShouldReturnFalse_WhenClassNameIsEmpty()
	{
		// Give
		$expected = array('The class name field is required.');
		$arrData = [
			'class_name'        => '',
            'course_id'         => '1',
            'date'              => '2000-01-01',
            'duration'          => '1',
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doInsert();
		$actual = $this->objTraining->errors()->get('class_name');

		// verify
		$this->assertFalse($return);
		$this->assertEquals($actual, $expected);
	}

	public function testShouldReturnFalse_WhenClassNameIsExist()
	{
		// Give
		$expected = array('The class name has already been taken.');
		$this->setUpClass(1);
		$arrData = [
			'class_name'        => 'class 1',
            'course_id'         => '1',
            'date'              => '2000-01-01',
            'duration'          => '1',
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doInsert();
		$actual = $this->objTraining->errors()->get('class_name');


		// verify
		$this->assertFalse($return);
		$this->assertEquals($actual, $expected);
	}

	public function testShouldReturnFalse_WhenCourseIsEmpty()
	{
		// Give
		$expected = array('The course id field is required.');
		$arrData = [
			'class_name'        => 'class 1',
            'course_id'         => '',
            'date'              => '2000-01-01',
            'duration'          => '1',
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doInsert();
		$actual = $this->objTraining->errors()->get('course_id');


		// verify
		$this->assertFalse($return);
		$this->assertEquals($actual, $expected);
	}
	public function testShouldReturnFalse_WhenCourseIsCharacter()
	{
		// Give
		$expected = array('The course id must be a number.');
		$arrData = [
			'class_name'        => 'class 1',
            'course_id'         => 'test',
            'date'              => '2000-01-01',
            'duration'          => '1',
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doInsert();
		$actual = $this->objTraining->errors()->get('course_id');


		// verify
		$this->assertFalse($return);
		$this->assertEquals($actual, $expected);
	}
	public function testShouldReturnFalse_WhenDateIsIncorrectFormat()
	{
		// Give
		$expected = array('The date is not a valid date.');
		$arrData = [
			'class_name'        => 'class 1',
            'course_id'         => '1',
            'date'              => '2000',
            'duration'          => '1',
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doInsert();
		$actual = $this->objTraining->errors()->get('date');


		// verify
		$this->assertFalse($return);
		$this->assertEquals($actual, $expected);
	}
	public function testShouldReturnFalse_WhenDateIsEmpty()
	{
		// Give
		$expected = array('The date field is required.');
		$arrData = [
			'class_name'        => 'class 1',
            'course_id'         => '1',
            'date'              => '',
            'duration'          => '1',
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doInsert();
		$actual = $this->objTraining->errors()->get('date');

		// verify
		$this->assertFalse($return);
		$this->assertEquals($actual, $expected);
	}
	public function testShouldReturnFalse_WhenExamIsCharacter()
	{
		// Give
		$expected = array('The has examination field must be true or false.');
		$arrData = [
			'class_name'        => 'class 1',
            'course_id'         => '1',
            'date'              => '2000-01-02',
            'duration'          => '1',
            'has_examination'   => 'aaaa',
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doInsert();
		$actual = $this->objTraining->errors()->get('has_examination');

		// verify
		$this->assertFalse($return);
		$this->assertEquals($actual, $expected);
	}
	public function testShouldReturnFalse_WhenExamIsInteger()
	{
		// Give
		$expected = array('The has examination field must be true or false.');
		$arrData = [
			'class_name'        => 'class 1',
            'course_id'         => '1',
            'date'              => '2000-01-02',
            'duration'          => '1',
            'has_examination'   => '3',
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doInsert();
		$actual = $this->objTraining->errors()->get('has_examination');

		// verify
		$this->assertFalse($return);
		$this->assertEquals($actual, $expected);
	}
	public function testShouldReturnTrue_WhenInsertSuccessfull()
	{
		// Give
		$expected = array();
		$arrData = [
			'class_name'        => 'class 1',
            'course_id'         => '1',
            'date'              => '2000-01-02',
            'duration'          => '1',
            'has_examination'   => true,
		];
		\Input::merge($arrData);

		// When
		$return = $this->objTraining->doInsert();
		$actual = $this->objTraining->errors()->all();

		// verify
		$this->assertTrue($return);
		$this->assertEquals($actual, $expected);
	}

	public function testShouldReturnFalse_WhenClassNameMoreThan50Characters()
	{
		// Give
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
		$return = $this->objTraining->doInsert();
		$actual = $this->objTraining->errors()->get('class_name');

		// verify
		$this->assertFalse($return);
		$this->assertEquals($actual, $expected);
	}
}