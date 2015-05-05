<?php 
namespace models\UtilizationModel;
/**
 * UtilizationModel_TestBase support setup data before test
 * 
 * @author lqdung
 *
 */
class TestBase extends \Codeception\TestCase\Test {

    public $arrEngineer                 = array();
    public $arrDepartment               = array();
    public $arrLevel                    = array();
    public $arrMonthlyUtilization       = array();
    public $arrWorkingArea              = array();
    public $arrEngineerPositionHistory  = array();
    
    protected function _before()
    {
        parent::_before();
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->objUtilization = new \UtilizationModel();
    }

    protected function _after()
    {
        parent::_after();
    }

    // setup data for engineer table
    public function setUpEngineer($number)
    {
        \DB::table('engineers')->delete();
        
        for ($i = 1; $i < $number; $i++) {
            $this->arrEngineer[] = [
                'engineer_id'   => $i,
                'employee_code' => 'code0'.$i,
                'fullname'      => 'Engineer '.$i,
                'email'         => 'engineer'.$i . '@tctav.com',
                'is_active'     => 1,
                'department_id' => rand(1,3)
            ];
        }
        foreach ($this->arrEngineer as $value) {
            \DB::table('engineers')->insert($value
                );
        }
    }

    // setup data for department table
    public function setUpDepartment()
    {
        \DB::table('departments')->delete();
        
        for ($i = 1; $i < 3; $i++) {
            $this->arrDepartment[] = [
                'department_id'     => $i,
                'department_name'   => 'department '.$i,
                'is_active'         => 1
            ];
        }
        foreach ($this->arrDepartment as $value) {
            \DB::table('departments')->insert($value);
        }
    }

    // setup data for levels table
    public function setUpLevels()
    {
        \DB::table('levels')->delete();

        for ($i = 1; $i <= 4; $i++) {
            $this->arrLevel[] = [
                'level_id'      => $i,
                'level_name'    => 'PG'.$i,
                'is_active'     => 1
            ];
        }
        
        for ($i = 5; $i <= 8; $i++) {
            $this->arrLevel[] = [
                'level_id'      => $i,
                'level_name'    => 'SE'.$i,
                'is_active'     => 1
            ];
        }

        foreach ($this->arrLevel as $value) {
            \DB::table('levels')->insert($value);
        }
    }

    // setup data for engineer position history
    public function setUpEngineerPositionHistory($number)
    {
        \DB::table('engineer_position_history')->delete();
        
        for ($i = 1; $i < $number; $i++) {
            $this->arrEngineerPositionHistory[] = [
                    'engineer_id'       => $i,
                    'level_id'          => rand(1,8),
                    'updated_time'      => date('Y-m-d'),
                    'is_current'        => 1,
                    'is_first_update'   => 1
            ];
        }
        foreach ($this->arrEngineerPositionHistory as $arrData) {
            \DB::table('engineer_position_history')->insert($arrData);
        }
    }

    // setup data for monthly utilization table
    public function setUpMonthlyUtilization($number)
    {
        \DB::table('monthly_utilizations')->delete();
        
        for ($i = 1; $i < $number; $i++) {
            $this->arrMonthlyUtilization[] = [
                    'engineer_id'       => $i,
                    'working_area_id'   => rand(1,3),
                    'month'             => date('Y-m-d'),
                    'utilization'       => rand(10, 100)
            ];
        }
        foreach ($this->arrMonthlyUtilization as $arrData) {
            \DB::table('monthly_utilizations')->insert($arrData);
        }
    }

    // setup data for working area table
    public function setUpWorkingArea()
    {
        \DB::table('working_areas')->delete();

        $this->arrWorkingArea = ['PHP', 'Java', 'Mobile'];
        $id = 1;
        foreach($this->arrWorkingArea as $value) {
            \DB::table('working_areas')->insert([
                'working_area_id'   => $id,
                'working_area_name' => $value
            ]);
            $id++;
        }
    }

}