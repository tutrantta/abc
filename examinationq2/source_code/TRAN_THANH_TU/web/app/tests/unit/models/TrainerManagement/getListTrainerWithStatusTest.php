<?php namespace models\TrainerManagement;
require_once __DIR__ . '/../TestBase.php';
/**
 * Class getListTrainerWithStatusTest support test getListTrainerWithStatus function
 *
 * @author Dung Le
 *
 * To do list
 * 1. testShouldReturnArrayNullWhenEngineerTableIsEmptyAndTrainerTableIsEmpty
 * 2. testShouldReturnArrayWhenEngineerTableIsEmptyAndTrainerTableHasExternalTrainer
 * 3. testShouldReturnArrayWhenEngineerTableIsNotEmptyAndTrainerTableHasInternalTrainer
 * 4. testShouldReturnArrayWhenEngineerTableIsNotEmptyAndTrainerTableIsNotEmpty
 */
class getListTrainerWithStatusTest extends \TestBase
{	
	protected $number = 5;
	protected function _before()
	{
		parent::_before();
		// set up table
		$this->setUpEngineer($this->number);
		$this->setUpTrainer($this->number);
		$this->objTraining = new \TrainerManagement();
	}

	protected function _after()
	{
		parent::_after();
	}

	public function testShouldReturnArrayNullWhenEngineerTableIsEmptyAndTrainerTableIsEmpty()
	{
		// Give
	    \DB::table('engineers')->delete();
	    \DB::table('trainers')->delete();
	    $expected = array();
		// When
		$actual = $this->objTraining->getListTrainerWithStatus();
		// verify
		$this->assertEquals($actual, $expected);
	}
	
	public function testShouldReturnArrayWhenEngineerTableIsEmptyAndTrainerTableHasExternalTrainer()
	{
	    // Give
	    \DB::table('engineers')->delete();
	    $arrData = [
	            'trainer_id'	=> "".$this->number + 1,
				'trainer_name' 	=> 'External',
                'employee_code' => 'External'
	    ];
	    \DB::table('trainers')->insert($arrData);
	    $expected = [
	            $arrData['trainer_id'] => $arrData['trainer_name']
	    ];
	    // When
	    $actual = $this->objTraining->getListTrainerWithStatus();
	    // verify
	    $this->assertEquals($actual, $expected);
	}
	
	public function testShouldReturnArrayWhenEngineerTableIsNotEmptyAndTrainerTableHasInternalTrainer()
	{
	    // Give
	    $expected = \Helper::getArrayIdValue($this->arrTrainer, 'trainer_id', 'trainer_name');
	    // When
	    $actual = $this->objTraining->getListTrainerWithStatus();
	    // verify
	    $this->assertEquals($actual, $expected);
	}
	public function testShouldReturnArrayWhenEngineerTableIsNotEmptyAndTrainerTableIsNotEmpty()
	{
	    // Give
	    $arrData = [
	            'trainer_id'	=> "".$this->number + 1,
	            'trainer_name' 	=> 'External',
	            'employee_code' => 'External'
	    ];
	    \DB::table('trainers')->insert($arrData);
	    
	    $expected = \Helper::getArrayIdValue(array_merge($this->arrTrainer, [$arrData]), 'trainer_id', 'trainer_name');
	    // When
	    $actual = $this->objTraining->getListTrainerWithStatus();
	    // verify
	    $this->assertEquals($actual, $expected);
	}
}