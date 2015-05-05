<?php
/**
 * Test GetListEngineer function
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-15          Vo Le Quynh My     Create File
 *
 *
 * To Do List
 * 1. test Should Return Correct Data When Get Detail Trainer By Trainer Id
 */
namespace models\TrainerManagement;
class GetDetailTrainerTest extends \Codeception\TestCase\Test {

    protected $trainer;
    protected $dataExpect = array(
            'trainer_id' => 1,
            'trainer_name' => 'Engineer 1',
            'employee_code' => 'code1',
            'description' => null,
    );
    
    protected function _before()
    {
        $this->trainer = new \TrainerManagement();
    }

    protected function _after()
    {
    }
    //test return trainer by id
    public function testShouldReturnCorrectDataWhenGetDetailTrainerByTrainerId()
    {
        // Give
        $trainer_id = 1;
        // When
        $actual = $this->trainer->getDetailTrainer($trainer_id)->toArray();
        unset($actual['created_at']);
        unset($actual['updated_at']);
        //Then
        $this->assertEquals($this->dataExpect, $actual);
    }
}