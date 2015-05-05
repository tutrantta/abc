<?php
/**
 * Test GetListEngineerTest function
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-02          Vo Le Quynh My     Create File
 *
 *
 * To Do List
 * 1. test Should Return All Item When Get All Engineer In Database
 * 2. test Should Return Empty Array When Database Empty
 */
namespace models;
class GetListEngineerTest extends \Codeception\TestCase\Test {

    protected $engineer;
    protected $data_engineer = array(
            'engineer_id' => 1,
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
            'is_active' => 1
    );
    protected $data_department = array(
            'department_id' => 1,
            'department_name' => 'technical',
            'is_active' => 1,
    );
    
    protected $dataExpect = array(
            'engineer_id' => 1,
            'employee_code' => 'Ta01',
            'department_id' => 1,
            'fullname' => 'aaa',
            'birthday' => '0000-00-00',
            'address' => 'aaa',
            'phone' => 'aaa',
            'other_information' => 'aaa',
            'email' => 'aa',
            'gender' => 'f',
            'is_active' => 1,
            'has_interview_form' => 1,
            'department_name' => 'technical',
            'created_at' => '0000-00-00 00:00:00',
            'updated_at' => '0000-00-00 00:00:00'
    );
    protected $params = array(
            'offset'        => 0,
            'limit'         => 10,
            'order'         => 'engineer_id',
            'sort'          => 'ASC',
            'search'   => null
    ); 
    protected function _before()
    {
        
        $this->engineer = new \Engineer();
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        //Delete data
        \DB::table('engineers')->delete();
        \DB::table('departments')->delete();
        //Insert data
        \DB::table('engineers')->insert($this->data_engineer);
        \DB::table('departments')->insert($this->data_department);
    }

    protected function _after()
    {
    }
    /**
     * @author Vo Le Quynh My
     * @name testShouldReturnAllItemWhenGetAllEngineerInDatabase
     * @todo test Should Return All Item When Get All Engineer In Database
     *
     * @access public
     */
    public function testShouldReturnAllItemWhenGetAllEngineerInDatabase()
    {
        //Give
        $expected = array (
                'count'=> 1,
                'data' => $this->dataExpect
        );
        //When
        $result = $this->engineer->getListEngineer($this->params);
        foreach ($result['data'] as $key => $value) 
        {
            $actual['data'] = get_object_vars($value);
        }
        $actual['count'] = $result['count'];
        //Then
        $this->assertEquals($expected, $actual);
    }
    /**
     * @author Vo Le Quynh My
     * @name testShouldReturnEmptyArrayWhenDatabaseEmpty
     * @todo test Should Return Empty Array When Database Empty
     *
     * @access public
     */
    public function testShouldReturnEmptyArrayWhenDatabaseEmpty()
    {
        //Give
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('engineers')->delete();
        \DB::table('departments')->delete();
        $expected = array (
                'count'=> 0,
                'data' => array()
        );
        //When
        $result = $this->engineer->getListEngineer($this->params);
        $actual['count']  = $result['count'];
        $actual['data'] = $result['data'];
        
        //Then
        $this->assertEquals($expected, $actual);
    }
}