<?php
/**
 * Soft skill management Unit test
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-03-31          LamKy     Create File
 */

namespace models;
require_once 'TestBase.php';
/**
 * TODO: List test cases for function get full name of engineer.
 *  1. Get detail with params: engineer_id is existed
 *  2. Get detail with params: engineer_id isn't existed (or engineer_id has existed 
 *      in "engineer_soft_skill_level_history" table but has not existed in "engineers")
 */

class EngineerFullnameTest extends TestBase
{
    protected $tester;
    
    protected function _before()
    {
        parent::_before();
        $this->tester = new \SoftSkillManagement();
    }
    
    protected function _after()
    {
        parent::_after();
    }
    
    /*
     * support unit test for function getEngineerFullname($engineer_id)
     * with params: $enginneer_id is invalid
     */
    public function testShouldBeReturnFalseWhenEngineerIdInvalid()
    {
        // GIVEN
        $engineer_id = null;
        // WHEN
        $expected = false;
        $actual = $this->tester->getEngineerFullname($engineer_id);
        // THEN
        $this->assertEquals($expected, $actual);
    }
    
    /*
     * support unit test for function getEngineerFullname($engineer_id)
     * with params: $enginneer_id is valid
     */
    public function testShouldBeReturnArrayDataWhenEngineerIdIsValid()
    {
        // GIVEN
        $tmp = \DB::table('engineers')->first();
        $data = get_object_vars($tmp);
        $engineer_id = $data['engineer_id'];
        //WHEN
        $expected = "Engineer 1" ;
        $actual = $this->tester->getEngineerFullname($engineer_id);
        //THEN
        $this->assertEquals($expected, $actual);
    }
}