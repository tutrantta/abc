<?php
/**
 * InsertInterviewTest
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-07          Bui Nguyen     Create File
 */
namespace models;
require_once 'InterviewForm_TestBase.php';
class InsertInterviewTest extends InterviewForm_TestBase {
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
    public function testGetSoftsShouldReturnArraSoftsCorrectWhenInsertSuccess()
    {
        $arrSoft = array();
        $arrSoft[] = array(
                'engineer_id' => $this->engineer_id,
                'soft_skill_id' => 1,
                'soft_skill_level' => 1,
                'updated_time' => '2015-04-07',
                'is_current' => 1,
                'is_first_update' => 1
            );
        $expected = $arrSoft;
        \DB::table('engineer_soft_skill_level_history')->delete();
        $this->objInterview->insertSofts($arrSoft);
        $softs = \DB::table('engineer_soft_skill_level_history')->where('engineer_id', $this->engineer_id)
                ->where('is_first_update', 1)->get()[0];
        $actual = array();
        $actual[] = (json_decode(json_encode($softs), true));
        unset($actual[0]['created_at']);
        unset($actual[0]['updated_at']);
        $this->assertEquals($expected, $actual);
    }
    public function testGetTechsShouldReturnArraTechsCorrectWhenInsertSuccess()
    {
        $arrTech = array();
        $arrTech[] = array(
                'engineer_id' => $this->engineer_id,
                'technique_id' => 1,
                'level_id' => 1,
                'updated_time' => '2015-04-07',
                'is_current' => 1,
                'is_first_update' => 1
            );
        $expected = $arrTech;
        \DB::table('engineer_technique_level_history')->delete();
        $this->objInterview->insertTechs($arrTech);
        $techs = \DB::table('engineer_technique_level_history')->where('engineer_id', $this->engineer_id)
                ->where('is_first_update', 1)->get()[0];
        $actual = array();
        $actual[] = (json_decode(json_encode($techs), true));
        unset($actual[0]['created_at']);
        unset($actual[0]['updated_at']);
        $this->assertEquals($expected, $actual);
    }
    public function testGetPositionHistoryShouldReturnArraPositionCorrectWhenInsertSuccess()
    {
        $data = array(
            'engineer_id' => $this->engineer_id,
            'applied_position' => 1,
            'current_date' => '2015-04-07'
        );
        $arrPosition[] = array(
                   'engineer_id' => $data['engineer_id'], 
                    'level_id' => $data['applied_position'],
                    'updated_time' => $data['current_date'],
                    'is_current' => 1,
                    'is_first_update' => 1
                );
        $expected = $arrPosition;
        \DB::table('engineer_position_history')->delete();
        $this->objInterview->insertPositionEngineer($data);
        $pos = \DB::table('engineer_position_history')->where('engineer_id', $this->engineer_id)
                ->where('is_first_update', 1)->get()[0];
        $actual = array();
        $actual[] = (json_decode(json_encode($pos), true));
        unset($actual[0]['created_at']);
        unset($actual[0]['updated_at']);
        $this->assertEquals($expected, $actual);
    }
    public function testShouldReturnTrueWhenInsertInterviewFormBasicSuccess()
    {
        $data = array(
            'working_area_id' => 1,
            'engineer_id' => $this->engineer_id,
            'interviewer' => 1,
            'technique_skill_feedback' => 1,
            'management_skill_feedback' => 1,
            'other_feedback' => 1,
            'interview_date' => '2015-04-07',
            'interviewer_department' => 1
        );
        $this->objInterview->fill($data);
        $expected = true;
        $actual = $this->objInterview->insertInterviewForm();
        $this->assertEquals($expected, $actual);
    }
    
}