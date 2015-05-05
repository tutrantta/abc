<?php
/**
 * Soft skill management Unit test
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-03-31          LamKy     Create File
 */
namespace models;

class TestBase extends \Codeception\TestCase\Test 
{
    protected function _before()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->insertEngineerData();
        $this->insertSoftSkillData();
        $this->insertEngineerSoftSkillLevelHistoryData();
    }
    protected function _after()
    {
    }
    
    /**
     * @param
     * @method insert table "engineers" support unit test.
     * @author LamKy
     */
    public function insertEngineerData()
    {
        \DB::table('departments')->delete();
        \DB::table('engineers')->delete();
        $insertItems = [
            'department_name' => 'department 1',
            'is_active'=> 1
        ];
        
        \DB::table('departments')->insert($insertItems);
        $departmentId = \DB::table('departments')->first()->department_id;
        for ($i = 1; $i < 9; $i ++) 
        {
            $insertEngineers = [
                'employee_code' => 'Code' . $i,
                'fullname' => 'Engineer '. $i,
                'email' => 'engineer'. $i . '@tctav.com',
                'is_active'=> 1,
                'department_id' => $departmentId
            ];
            \DB::table('engineers')->insert($insertEngineers);
        }
    } 
    
    /**
     * @param
     * @method insert table "soft_skills" support unit test.
     * @author LamKy
     */
    public function insertSoftSkillData()
    {
        \DB::table('soft_skills')->delete();
        $insertItems = array();
        $insertItems[] = [
            'soft_skill_name' => 'Communication',
            'is_active'=> 1
        ];
        $insertItems[] = [
            'soft_skill_name' => 'Teamwork',
            'is_active'=> 1
        ];
        $insertItems[] = [
            'soft_skill_name' => 'Problem solving',
            'is_active'=> 1
        ];
        $insertItems[] = [
            'soft_skill_name' => 'Leadership (for TL/PM)',
            'is_active'=> 1
        ];
        $insertItems[] = [
            'soft_skill_name' => 'English',
            'is_active'=> 1
        ];
        $insertItems[] = [
            'soft_skill_name' => 'Japanese',
            'is_active'=> 1
        ];
        \DB::table('soft_skills')->insert($insertItems);
    }
    
    /**
     * @param
     * @method insert table "engineer_soft_skill_level_history" support unit test.
     * @author LamKy
     */
    public function insertEngineerSoftSkillLevelHistoryData()
    {
        \DB::table('engineer_soft_skill_level_history')->delete();
        $eids = \DB::table('engineers')->lists('engineer_id');
        $tids = \DB::table('soft_skills')->lists('soft_skill_id');
        
        foreach($eids as $eid){
            foreach($tids as $tid){
                $insertItems[] = [
                    'engineer_id'       => $eid,
                    'soft_skill_id'     => $tid,
                    'updated_time'      => date("Y-m-d"),
                    'is_first_update'   => 1,
                    'soft_skill_level'  => 1,
                    'is_current'        => 1
                ];
            }
        }
        \DB::table('engineer_soft_skill_level_history')->insert($insertItems);
    }
}