<?php
/**
 * GetInterviewTest
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-07          Bui Nguyen     Create File
 */
namespace models;
require_once 'InterviewForm_TestBase.php';
class GetInterviewTest extends InterviewForm_TestBase {
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
    public function testShouldReturnListWorkingAreaCorrect()
    {
        $expected = $this->arrAreas;
        $position = $this->objInterview->getArea();
        foreach($position as $area)
        {
            $actual[] = array(
                'working_area_id' => $area->working_area_id,
                'working_area_name' => $area->working_area_name,
                'is_active' => $area->is_active
            );
        }
        $this->assertEquals($expected, $actual);
    }
    public function testShouldReturnListLevelsCorrect()
    {
        $expected = $this->arrLevels;
        $position = $this->objInterview->getLevels();
        foreach($position as $item)
        {
            $actual[] = array(
                'level_id' => $item->level_id,
                'level_name' => $item->level_name,
                'is_active' => $item->is_active
            );
        }
        $this->assertEquals($expected, $actual);
    }
    public function testShouldReturnListTechniquesCorrect()
    {
        $expected = $this->arrTechniques;
        $array = $this->objInterview->getTechniques();
        foreach($array as $item)
        {
            $actual[] = array(
                'technique_id' => $item->technique_id,
                'technique_name' => $item->technique_name,
                'technique_description' => $item->technique_description,
                'is_active' => $item->is_active
            );
        }
        $this->assertEquals($expected, $actual);
    }
    public function testShouldReturnListSoftsCorrect()
    {
        $expected = $this->arrSofts;
        $array = $this->objInterview->getSofts();
        foreach($array as $item)
        {
            $actual[] = array(
                'soft_skill_id' => $item->soft_skill_id,
                'soft_skill_name' => $item->soft_skill_name,
                'soft_skill_description' => $item->soft_skill_description,
                'is_active' => $item->is_active
            );
        }
        $this->assertEquals($expected, $actual);
    }
    public function testShouldReturnListSoftsUpdateCorrect()
    {
        $expected = $this->arrSoftsUpdate;
        $array = $this->objInterview->getSoftsUpdate($this->engineer_id);
        foreach($array as $item)
        {
            $actual[] = array(
                'engineer_id' => $item->engineer_id,
                'soft_skill_id' => $item->soft_skill_id,
                'updated_time' => $item->updated_time,
                'soft_skill_level' => $item->soft_skill_level,
                'is_current' => $item->is_current,
                'is_first_update' => $item->is_first_update
            );
        }
        $this->assertEquals($expected, $actual);
    }
    public function testShouldReturnListTechsUpdateCorrect()
    {
        $expected = $this->arrTechsUpdate;
        $array = $this->objInterview->getTechniquesUpdate($this->engineer_id);
        foreach($array as $item)
        {
            $actual[] = array(
                'engineer_id' => $item->engineer_id,
                'technique_id' => $item->technique_id,
                'level_id' => $item->level_id,
                'updated_time' => $item->updated_time,
                'is_current' => $item->is_current,
                'is_first_update' => $item->is_first_update
            );
        }
        $this->assertEquals($expected, $actual);
    }
    public function testShouldReturnBasicInfoInterviewFormCorrect()
    {
        $expected = $this->arrForm;
        $expected['fullname'] = $this->engineer_id;
        $expected['position'] = $this->engineer_id;
        $actual = $this->objInterview->getInterviewForm($this->engineer_id)->toArray()[0];
        unset($actual['created_at']);
        unset($actual['updated_at']);
        $this->assertEquals($expected, $actual);
    }
    public function testShouldReturnEngineerNameCorrect()
    {
        $expected = $this->engineer_id; // name = $this->engineer_id
        $actual = $this->objInterview->getEngineerName($this->engineer_id)[0]->fullname;
        $this->assertEquals($expected, $actual);
    }
    

}