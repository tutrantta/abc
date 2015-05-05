<?php
/**
 * Test UpdateInformationEngineerTest function
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-13          Vo Le Quynh My     Create File
 * 
 * 
 * To Do List
 * 1. test Should Return True When Update Engineer Success
 */
namespace models;
class UpdateInformationEngineerTest extends \Codeception\TestCase\Test {
    
    protected $engineer;
    protected $data = [
            'employee_code' => 'Ta01',
            'department_id' => 1,
            'fullname' => 'aaa',
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
    protected function _before()
    {
        $this->engineer = new \Engineer();
    }
    
    protected function _after()
    {
    }
    /**
     * @author Vo Le Quynh My
     * @name testShouldReturnTrueWhenUpdateEngineerSuccess
     * @todo test Should Return True When Update Engineer Success
     *
     * @access public
     */
    public function testShouldReturnTrueWhenUpdateEngineerSuccess()
    {
        // Give
        $expected  = 1;
        $engineer_id = 1;
        // When
        \Input::merge($this->data);
        $actual    = $this->engineer->updateEngineer($engineer_id);
        //Then
        $this->assertEquals($expected, $actual);
    }

}