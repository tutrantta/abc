<?php
/**
 * InterviewForm_TestBase
 * set up data for test
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-07          Bui Nguyen     Create File
 */
namespace models;

class InterviewForm_TestBase extends \Codeception\TestCase\Test {

	public $arrEngineer 				= array();
	public $arrDepartment 				= array();
	public $arrLevel 					= array();
	public $arrMonthlyUtilization 		= array();
	public $arrWorkingArea 				= array();
	public $arrEngineerPositionHistory 	= array();
	
	protected function _before()
	{
		parent::_before();
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		$this->objInterview = new \Interview();
        $this->engineer_id = 100;
	}

	protected function _after()
	{
		parent::_after();
	}

	public function setUpArea($number)
	{
		\DB::table('working_areas')->delete();
		
		for ($i = 1; $i < $number; $i++) {
			$this->arrAreas[] = [
				'working_area_id'	=> $i,
				'working_area_name' => 'php '.$i,
				'is_active'		=> 1
			];
		}
		foreach ($this->arrAreas as $value) {
			\DB::table('working_areas')->insert($value
				);
		}
	}
    public function setUpLevel($number)
	{
		\DB::table('levels')->delete();
		
		for ($i = 1; $i < $number; $i++) {
			$this->arrLevels[] = [
				'level_id'	=> $i,
				'level_name' => 'PG '.$i,
				'is_active'		=> 1
			];
		}
		foreach ($this->arrLevels as $value) {
			\DB::table('levels')->insert($value
				);
		}
	}
    public function setUpTechnique($number)
	{
		\DB::table('techniques')->delete();
		
		for ($i = 1; $i < $number; $i++) {
			$this->arrTechniques[] = [
				'technique_id'	=> $i,
				'technique_name' => 'test '.$i,
				'technique_description'		=> 'abc',
                'is_active' => 1
			];
		}
		foreach ($this->arrTechniques as $value) {
			\DB::table('techniques')->insert($value
				);
		}
	}
    public function setUpSoft($number)
	{
		\DB::table('soft_skills')->delete();
		
		for ($i = 1; $i < $number; $i++) {
			$this->arrSofts[] = [
				'soft_skill_id'	=> $i,
				'soft_skill_name' => 'test '.$i,
				'soft_skill_description'		=> 'abc',
                'is_active' => 1
			];
		}
		foreach ($this->arrSofts as $value) {
			\DB::table('soft_skills')->insert($value
				);
		}
	}
    public function setUpSoftUpdate($number)
	{
		\DB::table('engineer_soft_skill_level_history')->delete();
		for ($i = 1; $i < $number; $i++) {
			$this->arrSoftsUpdate[] = [
				'engineer_id'	=> $this->engineer_id,
				'soft_skill_id' => $i,
				'updated_time'    => '2015-04-07',
                'soft_skill_level' => 1,
                'is_current' => 0,
                'is_first_update' => 1
			];
		}
		foreach ($this->arrSoftsUpdate as $value) {
			\DB::table('engineer_soft_skill_level_history')->insert($value
				);
		}
	}
    public function setUpTechUpdate($number)
	{
		\DB::table('engineer_technique_level_history')->delete();
		for ($i = 1; $i < $number; $i++) {
			$this->arrTechsUpdate[] = [
				'engineer_id'	=> $this->engineer_id,
				'technique_id' => $i,
                'level_id' => 1,
				'updated_time'  => '2015-04-07',
                'is_current' => 0,
                'is_first_update' => 1
			];
		}
		foreach ($this->arrTechsUpdate as $value) {
			\DB::table('engineer_technique_level_history')->insert($value
				);
		}
	}
    public function setUpBasicInfoInterviewForm()
	{
		\DB::table('interview_forms')->delete();
        $this->arrForm = [
            'id'	=> $this->engineer_id,
            'engineer_id' => $this->engineer_id,
            'technique_skill_feedback'  => 1,
            'management_skill_feedback' => 1,
            'other_feedback' => 2,
            'interview_date' => '2015-04-07',
            'working_area_id' => 1,
            'interviewer' => 'abc',
            'interviewer_department' => 'abc',
            'is_approve' => 0
        ];
        \DB::table('interview_forms')->insert($this->arrForm);
	}
    public function setUpPositionHistory()
	{
		\DB::table('engineer_position_history')->delete();
        $this->arrPositionHistory = [
            'engineer_id' => $this->engineer_id,
            'level_id'  => $this->engineer_id,
            'updated_time' => '2015-04-07',
            'is_current' => 1,
            'is_first_update' => 1,
        ];
        \DB::table('engineer_position_history')->insert($this->arrPositionHistory);
	}
    public function setUpEngineer()
	{
		\DB::table('engineers')->delete();
        $this->arrEngineer = [
            'engineer_id' => $this->engineer_id,
            'employee_code'  => 1,
            'department_id' => 1,
            'fullname' => $this->engineer_id,
            'has_interview_form' => 1,
        ];
        \DB::table('engineers')->insert($this->arrEngineer);
	}
}

