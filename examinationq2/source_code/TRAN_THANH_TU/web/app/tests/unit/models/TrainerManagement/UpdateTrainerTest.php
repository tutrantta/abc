<?php
namespace models;
 /**
 * Test UpdateTrainer function
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-15          Vo Le Quynh My     Create File
 * 
  * 
 * To Do List
 * 1. test Should Return True When Update Trainer Success
 */
namespace models\TrainerManagement;
class UpdateTrainerTest extends \Codeception\TestCase\Test
{
    protected $trainer;

    protected $dataExpert = [
        'description'=> 'description',
        'employee_code' => '123456',
        'trainer_name' => 'admin1',
        'created_at' => '0000-00-00 00:00:00',
        'updated_at' => '0000-00-00 00:00:00'
    ];
    
    public function setUpTrainer($number)
    {
        \DB::table('trainers')->delete();
        for ($i = 1; $i < $number; $i++) {
            $this->arrTrainers[] = [
                    'trainer_id' => $i,
                    'trainer_name' => 'Ta'. $i,
                    'employee_code' => 'Name'. $i,
                    'description' => 'description',
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00'
            ];
        }
        foreach ($this->arrTrainers as $value) {
            \DB::table('trainers')->insert($value);
        }
    }

    protected function _before()
    {
        $this->trainer = new \TrainerManagement();
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        //Set up data
        $this->setUpTrainer(3);
    }

    protected function _after()
    {
    }
    //test should return true when update trainer success
    public function testShouldReturnTrueWhenUpdateTrainerSuccess()
    {
        // Give
        $expected  = array();
        $trainer_id = 1;
        // When
        \Input::merge($this->dataExpert);
        
        $result = $this->trainer->updateTrainer($trainer_id);
        $actual = $this->trainer->errors()->all();
        //Then
        $this->assertTrue($result);
        $this->assertEquals($expected, $actual);
    }
}