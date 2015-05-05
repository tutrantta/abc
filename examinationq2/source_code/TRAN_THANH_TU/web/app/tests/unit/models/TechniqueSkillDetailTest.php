<?php
namespace models;
/*
---------TO DO LIST-----------
1.Input engineer_id is null
2.Input engineer_id is not integer
3.Input engineer_id is not exits
4.Input engineer_id but fullname show not true
5.Input engineer_id and searchValue
6.Input engineer_id is a string
7.Input engineer_id is not exits for getEngineerFullname
*/


class TechniqueSkillDetailTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $params = [
        'search'=>'OOP/MVC',
        'limit'=>'10',
        'offset'=>'0',
        'order'=>'technique_id',
        'sort'=>'asc'
    ];

    protected function _before()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->tester = new \Technique();
        $this->engineer_id = 1;
        $this->setUpTechnique();
        $this->setUpLevels();
        $this->setUpTechUpdate();
        $this->setUpEngineer();
    }
    public function setUpTechnique()
    {
        \DB::table('techniques')->delete();
        $this->arrTechniques[] = [
                'technique_id'   => '1',
                'technique_name' => 'Understanding Requirement',
                'is_active'=> 1
        ];
        $this->arrTechniques[] = [
                'technique_id'   => '2',
                'technique_name' => 'OOP/MVC',
                'is_active'=> 1
        ];
        $this->arrTechniques[] = [
                'technique_id'   => '3',
                'technique_name' => 'UML',
                'is_active'=> 1
        ];
        $this->arrTechniques[] = [
                'technique_id'   => '4',
                'technique_name' => 'Coding',
                'is_active'=> 1
        ];
        $this->arrTechniques[] = [
                'technique_id'   => '5',
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
    
        \DB::table('levels')->insert($this->arrLevel);
    }
    
    public function setUpTechUpdate()
    {
        \DB::table('engineer_technique_level_history')->delete();
        
        $this->arrTechsUpdate = [
                'engineer_id'	=> $this->engineer_id,
                'technique_id' => 2,
                'level_id' => 1,
                'updated_time'  => '2015-04-07',
                'is_current' => 1,
                'is_first_update' => 1
        ];
        \DB::table('engineer_technique_level_history')->insert($this->arrTechsUpdate);
    }
    public function setUpEngineer()
    {
        \DB::table('engineers')->delete();
        $this->arrEngineer = [
                'engineer_id' => $this->engineer_id,
                'employee_code' => 'Ta01',
                'department_id' => 1,
                'fullname' => 'Engineer 1',
                'birthday' => '0000-00-00',
                'address' => 'aaa',
                'phone' => 'aaa',
                'other_information' => 'aaa',
                'email' => 'aa',
                'gender' => 'f',
                'has_interview_form' => 1,
                'is_active' => 1
        ];
        \DB::table('engineers')->insert($this->arrEngineer);
    }

    protected function _after()
    {
    }

    /**
     * @author HienNguyen
     * @name testShouldReturnFalseWhenInputEngineer_idIsNull
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenInputEngineer_idIsNull()
    {
        //GIVEN   
        $engineer_id = null;

        // WHEN
        $results = $this->tester->getTechniqueSkillDetail($engineer_id, $this->params);

        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author HienNguyen
     * @name testShouldReturnFalseWhenInputEngineer_idIsNotInteger
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenInputEngineer_idIsNotInteger()
    {
        //GIVEN
        $engineer_id = 'hien';
        // WHEN
        $results = $this->tester->getTechniqueSkillDetail($engineer_id, $this->params);
        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author HienNguyen
     * @name testShouldReturnFalseWhenInputEngineer_idIsNotInteger
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenInputEngineer_idIsNotExits()
    {
        //GIVEN
        $engineer_id = '1000';
        // WHEN
        $results = $this->tester->getTechniqueSkillDetail($engineer_id, $this->params);
        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author HienNguyen
     * @name testShouldReturnFullNameTrueWhenInputEngineer_idTrue
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFullNameTrueWhenInputEngineerIdTrue()
    {
        //GIVEN
        $engineer_id = 1;
        $arrayExpert = 'Engineer 1';
        // WHEN
        $results = $this->tester->getEngineerFullname($engineer_id);

        // THEN
        $this->assertEquals($arrayExpert, $results);
    }

    /**
     * @author HienNguyen
     * @name testShouldReturnFalseWhenInputEngineer_idIsNotInteger
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnArrayWhenInputEngineer_idAndInputSearchValue()
    {
        //GIVEN
        $engineer_id = 1;
        $stringExpert = 'OOP/MVC';
        // WHEN
        $results = $this->tester->getTechniqueSkillDetail($engineer_id, $this->params);
        // THEN
        $this->assertEquals($results['data'][0]['technique_name'], $stringExpert);
    }

    /**
     * @author HienNguyen
     * @name testShouldReturnFalseWhenInputEngineer_idIsAString
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenInputEngineer_idIsAString()
    {
        //GIVEN
        $engineer_id = 'hien';
        // WHEN
        $results = $this->tester->getEngineerFullname($engineer_id);
        // THEN
        $this->assertFalse($results);
    }

    /**
     * @author HienNguyen
     * @name testShouldReturnFalseWhenInputEngineer_idIsAString
     * @todo 
     *
     * @access public
     */
    public function testShouldReturnFalseWhenInputEngineer_idIsNotExit()
    {
        //GIVEN
        $engineer_id = '1000';
        // WHEN
        $results = $this->tester->getEngineerFullname($engineer_id);
        // THEN
        $this->assertFalse($results);
    }

} 