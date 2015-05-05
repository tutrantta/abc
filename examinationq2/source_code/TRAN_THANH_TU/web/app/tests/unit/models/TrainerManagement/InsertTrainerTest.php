<?php
namespace models;
 /**
 * Test InsertTrainer function
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-15          Vo Le Quynh My     Create File
 * 
  * 
 * To Do List
 * 1. test Should Return True When Add Trainer Success
 * 2. test Should Return Message When Trainer Name Null
 * 3. test Should Return True When Trainer Name Valid
 * 4. test Should Return Message When Description Over 1000 characters
 * 5. test Should Return True When Description Valid
 */
namespace models\TrainerManagement;
class InsertTrainerTest extends \Codeception\TestCase\Test
{
    protected $trainer;

    protected $dataExpert = [
        'trainer_name'=>'admin1',
        'employee_code'=>'123456',
        'description'=> 'description'
    ];

    protected function _before()
    {
        $this->trainer = new \TrainerManagement();
    }

    protected function _after()
    {
    }
    
    //add trainer susscess
    public function testShouldReturnTrueWhenAddTrainerSuccess()
    {
        // Give
        $expected  = 1;
        // When
        $this->trainer->fill($this->dataExpert);
        $actual = $this->trainer->addTrainer();
        //Then
        $this->assertEquals($expected, $actual);
    }
    //trainer name null
    public function testShouldReturnFalseWhenTrainerNameNull()
    {
        // Give
        $expected  = 'The trainer name field is required.';
        // When
        $this->trainer->fill(['trainer_name' => '']);
        $result    = $this->trainer->addtrainer();
        $message = $this->trainer->errors()->get('trainer_name');
        $actual    = $message[0];
        //Then
        $this->assertFalse($result);
        $this->assertEquals($expected, $actual);
    }
    //trainer name valid
    public function testShouldReturnFalseWhenTrainerNameValid()
    {
        // Give
        $expected  = array();
        // When
        $this->trainer->fill(['trainer_name' => 'My']);
        $result    = $this->trainer->addtrainer();
        $message = $this->trainer->errors()->get('trainer_name');
        $actual    = $message;
        //Then
        $this->assertFalse($result);
        $this->assertEquals($expected, $actual);
    }
    //Description valid
    public function testShouldReturnFalseWhenDescriptionValid()
    {
        // Give
        $expected  = array();
        // When
        $this->trainer->fill(['description' => 'My']);
        $result    = $this->trainer->addtrainer();
        $message = $this->trainer->errors()->get('description');
        $actual    = $message;
        //Then
        $this->assertFalse($result);
        $this->assertEquals($expected, $actual);
    }
}