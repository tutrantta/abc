<?php
/**
 * UpdateInterviewTest
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-07          Bui Nguyen     Create File
 */
namespace models;
require_once 'InterviewForm_TestBase.php';
class UpdateInterviewTest extends InterviewForm_TestBase {
    /**
     * @var \UnitTester
     */
    protected $objInterview;
    protected $number = 3;

    protected function _before()
    {
        parent::_before();
        $this->objInterview = new \Interview();
        $this->setUpArea($this->number);
        $this->setUpLevel($this->number);
        $this->setUpTechnique($this->number);
        $this->setUpSoft($this->number);
        $this->setUpSoftUpdate($this->number);
        $this->setUpTechUpdate($this->number);
        $this->setUpBasicInfoInterviewForm();
        $this->setUpPositionHistory();
        $this->setUpEngineer();
    }
    
    protected function _after()
    {
        parent::_after();
    }
    public function testUpdatePositionShouldReturnCorrectLevelWhenUpdateSuccess()
    {
        $expected = 2;
        $this->objInterview->updatePosition($expected);
        $get = \DB::table('engineer_position_history')->where('engineer_id', $this->engineer_id)->get();
        $actual = $get[0]->level_id;
        $this->assertEquals($expected, $actual);
    }
    public function testUpdateEngineersShouldReturnCorrectHasFormtWhenUpdateSuccess()
    {
        $expected = 1;
        $this->objInterview->updateEngineerForm($this->engineer_id);
        $get = \DB::table('engineers')->where('engineer_id', $this->engineer_id)->get();
        $actual = $get[0]->has_interview_form;
        $this->assertEquals($expected, $actual);
    }
    
    
}