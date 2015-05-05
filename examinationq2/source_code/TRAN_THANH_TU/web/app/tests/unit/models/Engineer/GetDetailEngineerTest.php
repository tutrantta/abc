<?php
/**
 * Test GetDetailEngineerTest function
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-13          Vo Le Quynh My     Create File
 * 
 * 
 * To Do List
 * 1. test Should Return Correct Data When Get Detail Engineer By Engineer Id
 * 2. test Should Return Correct Data When Get Working Area By Working Area Id
 * 3. test Should Return Correct Data When Get Position Is Current By Engineer Id
 * 4. test Should Return Correct Data When Get List Department From Database
 * 5. test Should Return Correct Data When Get List Technique Skill Current By Engineer Id
 * 6. test Should Return Correct Data When Get List Soft Skill Current By Engineer Id
 * 
 */
namespace models;
require_once 'Engineer_TestBase.php';
class GetDetailEngineerTest extends Engineer_TestBase {
    
    protected $number = 3;
    protected $engineer;
    
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
            'working_area_id' => '',
            'created_at' => '0000-00-00 00:00:00',
            'updated_at' => '0000-00-00 00:00:00'
    );
    
    protected function _before()
    {
        parent::_before();
        $this->engineer = new \Engineer();
        
        $this->setUpArea($this->number);
        $this->setUpLevel($this->number);
        $this->setUpTechnique($this->number);
        $this->setUpSoft($this->number);
        $this->setUpPositionHistory();
        $this->setUpEngineer();
        $this->setUpDepartment($this->number);
        $this->setUpSoftUpdate($this->number);
        $this->setUpTechUpdate($this->number);
    }
    
    protected function _after()
    {
        parent::_after();
    }
    /**
     * @author Vo Le Quynh My
     * @name testShouldReturnCorrectDataWhenGetDetailEngineerByEngineerId
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnCorrectDataWhenGetDetailEngineerByEngineerId()
    {
        // Give
        $engineer_id = 1;
        // When
        $actual = $this->engineer->getDetailEngineer($engineer_id);
        //Then
        $this->assertEquals($this->dataExpect, $actual);
    }
    /**
     * @author Vo Le Quynh My
     * @name testShouldReturnCorrectDataWhenGetWorkingAreaByWorkingAreaId
     * @todo
     *
     * @access public
     */
    public function testShouldReturnCorrectDataWhenGetWorkingAreaByWorkingAreaId()
    {
        // Give
        $working_area_id = 1;
        $expected = 'Technical 1';
        // When
        $actual = $this->engineer->getWorkingSkillEngineer($working_area_id);
        //Then
        $this->assertEquals($expected, $actual);
    }
    /**
     * @author Vo Le Quynh My
     * @name testShouldReturnCorrectDataWhenGetPositionIsCurrentByEngineerId
     * @todo
     *
     * @access public
     */
    public function testShouldReturnCorrectDataWhenGetPositionIsCurrentByEngineerId()
    {
        // Give
        $engineer_id = 1;
        $expected = 'PG 1';
        // When
        $actual = $this->engineer->getPositionIsCurrent($engineer_id);
        //Then
        $this->assertEquals($expected, $actual);
    }
    /**
     * @author Vo Le Quynh My
     * @name testShouldReturnCorrectDataWhenGetListDepartmentFromDatabase
     * @todo
     *
     * @access public
     */
    public function testShouldReturnCorrectDataWhenGetListDepartmentFromDatabase()
    {
        // Give
        $expected = $this->arrDepartments;
        // When
        $actual = $this->engineer->getListDepartment();
        //Then
        $this->assertEquals($expected, $actual);
    }
    /**
     * @author Vo Le Quynh My
     * @name testShouldReturnCorrectDataWhenGetListTechniqueSkillCurrentByEngineerId
     * @todo
     *
     * @access public
     */
    public function testShouldReturnCorrectDataWhenGetListTechniqueSkillCurrentByEngineerId()
    {
        // Give
        $engineer_id = 1;
        $expected = '';
        // When
        $actual = $this->engineer->getListTechniqueCurrent($engineer_id);
        //Then
        $this->assertEquals($expected, $actual);
    }
    /**
     * @author Vo Le Quynh My
     * @name testShouldReturnCorrectDataWhenGetListSoftSkillCurrentByEngineerId
     * @todo
     *
     * @access public
     */
    public function testShouldReturnCorrectDataWhenGetListSoftSkillCurrentByEngineerId()
    {
        // Give
        $engineer_id = 1;
        $expected = '';
        // When
        $actual = $this->engineer->getListSoftSkillCurrent($engineer_id);
        //Then
        $this->assertEquals($expected, $actual);
    }
    

}