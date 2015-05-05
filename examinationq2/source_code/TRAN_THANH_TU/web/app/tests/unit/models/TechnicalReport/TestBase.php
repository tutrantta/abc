<?php namespace models\TechnicalReport;
/**
 * TestBase support setup data before test
 * 
 * @author lqdung
 *
 */
class TestBase extends \Codeception\TestCase\Test {

    public $arrEngineer                 = array();
    public $arrTechniques               = array();
    public $arrLevel                    = array();
    public $arrTechnicalHistory         = array();
    
    protected function _before()
    {
        parent::_before();
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    }

    protected function _after()
    {
        parent::_after();
    }

    // setup data for techtical history table
    public function setUpTechticalLevelHistory()
    {
        \DB::table('engineer_technique_level_history')->delete();

        $eids = \DB::table('engineers')->lists('engineer_id');
        $tids = \DB::table('techniques')->lists('technique_id');
        $lids = \DB::table('levels')->lists('level_id');
        
        foreach($eids as $eid){
            foreach($tids as $tid){
                $this->arrTechnicalHistory[] = [
                    'engineer_id'  => $eid,
                    'technique_id' => $tid,
                    'updated_time' => date("Y-m-d"),
                    'level_id'     => $lids[array_rand($lids,1)]
                ];
            }
            
        }
        \DB::table('engineer_technique_level_history')->insert($this->arrTechnicalHistory);
    }
    // setup data for engineer table
    public function setUpEngineer($number)
    {
        \DB::table('engineers')->delete();
        
        for ($i = 1; $i < $number; $i++) {
            $this->arrEngineer[] = [
                'engineer_id'    => $i,
                'employee_code'  => 'TA0'.$i,
                'fullname'       => 'Engineer '.$i,
                'email'          => 'engineer'.$i . '@tctav.com',
                'is_active'      => 1,
                'department_id'  => rand(1,3)
            ];
        }
            \DB::table('engineers')->insert($this->arrEngineer);
    }

    // setup data for techniques table
    public function setUpTechnique()
    {
        \DB::table('techniques')->delete();
        
        $this->arrTechniques[] = [
            'technique_id'    => 1,
            'technique_name' => 'Understang Requirement',
            'is_active'=> 1
        ];
        $this->arrTechniques[] = [
            'technique_id'    => 2,
            'technique_name' => 'OOP/MVC',
            'is_active'=> 1
        ];
        $this->arrTechniques[] = [
            'technique_id'    => 3,
            'technique_name' => 'UML',
            'is_active'=> 1
        ];
        $this->arrTechniques[] = [
            'technique_id'    => 4,
            'technique_name' => 'Coding',
            'is_active'=> 1
        ];
        $this->arrTechniques[] = [
            'technique_id'    => 5,
            'technique_name' => 'Testing',
            'is_active'=> 1
        ];
        \DB::table('techniques')->insert($this->arrTechniques);
    }

    // setup data for levels table
    public function setUpLevels()
    {
        \DB::table('levels')->delete();

        for ($i = 1; $i <= 4; $i++) {
            $this->arrLevel[] = [
                'level_id'       => $i,
                'level_name'     => 'PG'.$i,
                'is_active'      => 1
            ];
        }
        
        for ($i = 5; $i <= 8; $i++) {
            $this->arrLevel[] = [
                'level_id'       => $i,
                'level_name'     => 'SE'.$i,
                'is_active'      => 1
            ];
        }

        \DB::table('levels')->insert($this->arrLevel);
    }
    /**
     * sortArrayByColum function support sort array output
     * @param array $arr
     * @param string $col
     * @param string $order
     * @return void
     */
    public function sortArrayByColum(array &$arr, $col, $order = SORT_DESC)
    {
        $arrSortColumn = array();
        foreach ($arr as $key => $row) {
            $arrSortColumn[$key] = $row[$col];
        }
        array_multisort($arrSortColumn, $order, $arr);
    }
}