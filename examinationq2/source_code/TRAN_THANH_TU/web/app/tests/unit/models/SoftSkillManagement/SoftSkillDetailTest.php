<?php
/**
 * Soft skill management Unit test
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-06          LamKy     Create File
 */

namespace models;
require_once 'TestBase.php';
/**
 * TODO: List test cases for function get soft skill detail of engineer.
 *  1. Get detail with params: engineer_id is existed
 *  2. Get detail with params: engineer_id isn't existed 
 */

class SoftSkillDetailTest extends TestBase
{
    protected $tester;
    protected $data;
    protected $params = array(
        'offset'        => 0,
        'limit'         => 10,
        'order'         => 'engineer_id',
        'sort'          => 'ASC',
        'searchValue'   => null
    );
    
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
     * support unit test for function getSoftSkillDetail($engineer_id, $params)
     * with params: $enginneer_id isn't exist or valid
     */
    public function testShouldBeReturnFalseWhenEngineerIdInvalid()
    {
        //GIVEN
        $engineer_id = null;
        //WHEN
        $expected = false;
        $actual = $this->tester->getSoftSkillDetail($engineer_id, $this->params);
        //THEN
        $this->assertEquals($expected, $actual);
    }
    
    /*
     * support unit test for function getSoftSkillDetail($engineer_id, $params)
     * with params: $enginneer_id is exist on table
     */
    public function testShouldBeReturnArrayDataWhenEngineerIdIsValid()
    {
        //GIVEN
        $tmp = \DB::table('engineers')->first();
        $data = get_object_vars($tmp);
        $engineer_id = $data['engineer_id'];
        //WHEN
        $expected = array (
            'count'     => 6,
            'data'      => array (
                '0' => array (
                    'soft_skill_name' => 'Communication',
                    'updated_time' => date("Y-m-d"),
                    'soft_skill_level' => 1
                    
                    ),
                '1' => array (
                    'soft_skill_name' => 'Teamwork',
                    'updated_time' => date("Y-m-d"),
                    'soft_skill_level' => 1
                ),
                
                '2' => array (
                    'soft_skill_name' => 'Problem solving',
                    'updated_time' => date("Y-m-d"),
                    'soft_skill_level' => 1
                ),
                
                '3' => array (
                    'soft_skill_name' => 'Leadership (for TL/PM)',
                    'updated_time' => date("Y-m-d"),
                    'soft_skill_level' => 1
                ),
                '4' => array
                (
                    'soft_skill_name' => 'English',
                    'updated_time' => date("Y-m-d"),
                    'soft_skill_level' => 1
                ),
                '5' => array (
                    'soft_skill_name' => 'Japanese',
                    'updated_time' => date("Y-m-d"),
                    'soft_skill_level' => 1
                )
            )
        );
        $actual = $this->tester->getSoftSkillDetail($engineer_id, $this->params);
        //THEN
        $this->assertEquals($expected, $actual);
    }
}