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
 * 1. test Should Return All Item When Get All Engineer In Database
 * 2. test Should Return Empty Array When Database Empty
 */
namespace models\TrainerManagement;
class GetListEngineerTest extends \Codeception\TestCase\Test {

    protected $engineer;
    
    public function setUpEngineer($number)
	{
	    \DB::table('engineers')->delete();
	
	    for ($i = 1; $i < $number; $i++) {
	        $this->arrEngineers[] = [
	                'engineer_id' => $i,
                    'employee_code' => 'Ta'. $i,
                    'department_id' => Null,
                    'fullname' => 'name'. $i,
                    'birthday' => '0000-00-00',
                    'address' => 'aaa',
                    'phone' => 'aaa',
                    'other_information' => 'aaa',
                    'email' => 'aa',
                    'gender' => 'f',
                    'has_interview_form' => 1,
                    'is_active' => 1,
	                'created_at' => '0000-00-00 00:00:00',
	                'updated_at' => '0000-00-00 00:00:00'
	        ];
	    }
	    foreach ($this->arrEngineers as $value) {
	        \DB::table('engineers')->insert($value
	        );
	    }
	}
    
    protected function _before()
    {
        $this->engineer = new \TrainerManagement();
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        //Delete data
        \DB::table('engineers')->delete();
        //Insert data
        $this->setUpEngineer(3);
    }

    protected function _after()
    {
    }
    //test return array engineer
    public function testShouldReturnCorrectDataWhenGetListEngineerFromDatabase()
    {
        // Give
        $expected = $this->arrEngineers;
        // When
        $actual = $this->engineer->getListEmp();
        //Then
        $this->assertEquals($expected, $actual);
    }
    // test return empty array
    public function testShouldReturnNullWhenGetListEngineerFromDatabaseEmpty()
    {
        //Give
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('engineers')->delete();
        $expected = Null;
        //When
        $actual = $this->engineer->getListEmp();
        
        //Then
        $this->assertEquals($expected, $actual);
    }
}