<?php
/**
 * Test addEngineer function
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-02          Vo Le Quynh My     Create File
 * 
 * 
 * To Do List
 * 1. test Should Return True When Add Engineer Success
 * 2. test Should Return Message When Engineer Name Null
 * 3. test Should Return True When Engineer Name Valid
 * 4. test Should Return Message When Engineer Id Null
 * 5. test Should Return True When Engineer Id Valid
 * 6. test Should Return Message When Email Not Valid
 * 7. test Should Return True When Email Valid
 */
namespace models;
class AddEngineerTest extends \Codeception\TestCase\Test {
    
    protected $engineer;
    protected $data = [
            'fullname'=>'my',
            'employee_code'=>'123456',
            'phone' => '1234567891',
            'email' => 'a@gmail.com'
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
     * @name testShouldReturnTrueWhenAddEngineerSuccess
     * @todo test Should Return True When Add Engineer Success
     *
     * @access public
     */
    public function testShouldReturnTrueWhenAddEngineerSuccess()
    {
        // Give
        $expected  = 1;
        // When
        $this->engineer->fill($this->data);
        $actual    = $this->engineer->addEngineer();
        //Then
        $this->assertEquals($expected, $actual);
    }
    /**
     * @author Vo Le Quynh My
     * @name testShouldReturnMessageWhenEngineerNameNull
     * @todo test Should Return Message When Engineer Name Null
     *
     * @access public
     */
    public function testShouldReturnMessageWhenEngineerNameNull()
    {
        // Give
        $expected  = 'The fullname field is required.';
        // When
        $this->engineer->fill(['fullname' => '']);
        $result    = $this->engineer->addEngineer();
        $message = $this->engineer->errors()->get('fullname');
        $actual    = $message[0];
        //Then
        $this->assertFalse($result);
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @author Vo Le Quynh My
     * @name testShouldReturnTrueWhenEngineerNameValid
     * @todo test Should Return False When Engineer Name Valid
     *
     * @access public
     */
    public function testShouldReturnTrueWhenEngineerNameValid()
    {
        // Give
        $expected  = array();
        // When
        $this->engineer->fill(['fullname' => 'my']);
        $result    = $this->engineer->addEngineer();
        $message = $this->engineer->errors()->get('fullname');
        $actual    = $message;
        //Then
        $this->assertFalse($result);
        $this->assertEquals($expected, $actual);
    }
    /**
     * @author Vo Le Quynh My
     * @name testShouldReturnMessageWhenEmployeeCodeNull
     * @todo test Should Return Message When Employee Code Null
     *
     * @access public
     */
    public function testShouldReturnMessageWhenEmployeeCodeNull()
    {
        // Give
        $expected  = 'The employee code field is required.';
        // When
        $this->engineer->fill(['employee_code' => '']);
        $result    = $this->engineer->addEngineer();
        $message = $this->engineer->errors()->get('employee_code');
        $actual    = $message[0];
        //Then
        $this->assertFalse($result);
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @author Vo Le Quynh My
     * @name testShouldReturnTrueWhenEmployeeCodeValid
     * @todo test Should Return False When Employee Code Valid
     *
     * @access public
     */
    public function testShouldReturnTrueWhenEmployeeCodeValid()
    {
        // Give
        $expected  = array();
        // When
        $this->engineer->fill(['employee_code' => 'my01']);
        $result    = $this->engineer->addEngineer();
        $message = $this->engineer->errors()->get('employee_code');
        $actual    = $message;
        //Then
        $this->assertFalse($result);
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @author Vo Le Quynh My
     * @name testShouldReturnMessageWhenEmailNotValid
     * @todo test Should Return Message When Email Not Valid
     *
     * @access public
     */
    public function testShouldReturnMessageWhenEmailNotValid()
    {
        // Give
        $expected  = 'The email must be a valid email address.';
        // When
        $this->engineer->fill(['email' => 'my']);
        $result    = $this->engineer->addEngineer();
        $message = $this->engineer->errors()->get('email');
        $actual    = $message[0];
        //Then
        $this->assertFalse($result);
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @author Vo Le Quynh My
     * @name testShouldReturnTrueWhenEmailValid
     * @todo test Should Return False When Email Valid
     *
     * @access public
     */
    public function testShouldReturnTrueWhenEmailValid()
    {
        // Give
        $expected  = array();
        // When
        $this->engineer->fill(['email' => 'my@gmail.com']);
        $result    = $this->engineer->addEngineer();
        $message = $this->engineer->errors()->get('email');
        $actual    = $message;
        //Then
        $this->assertFalse($result);
        $this->assertEquals($expected, $actual);
    }

}