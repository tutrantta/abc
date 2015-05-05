<?php namespace models;
/**
 * GetIdTest
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-08          Trieu Nguyen     Create File
 *
 * To do list
 * 1. testShouldReturnArray_WhenGetIdSoftSkill_WithEqual
 * 2. testShouldReturnArray_WhenGetIdSoftSkill_WithNotEqual
*/

class GetIdTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $params;

    protected function _before()
    {
        $this->tester = new \SoftSkillIndex();
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('soft_skills')->delete();
        
        // setup data
        $this->params[0] = [
            'soft_skill_id' => 1,
            'soft_skill_name'=> 'PHP Developer',
            'soft_skill_description'=> 'Desciption PHP Developer',
            'is_active'=> 1
        ];

        $this->params[1] = [
            'soft_skill_id' => 2,
            'soft_skill_name'=> 'HTML Developer',
            'soft_skill_description'=> 'Desciption HTML Developer',
            'is_active'=> 1
        ];

        $this->params[2] = [
            'soft_skill_id' => 3,
            'soft_skill_name'=> 'JavaScript Developer',
            'soft_skill_description'=> 'Desciption JavaScript Developer',
            'is_active'=> 1
        ];

        \DB::table('soft_skills')->insert($this->params);
    }

    protected function _after()
    {

    }

    public function testShouldReturnArray_WhenGetIdSoftSkill_WithEqual()
    {
        //codecept_debug($data);
        //GIVEN

        //WHEN
        $resultList = $this->tester->getid(1)->toArray();

        unset($resultList['created_at'], $resultList['updated_at']);
     
        $resultData = [
            'soft_skill_id' => 1,
            'soft_skill_name'=> 'PHP Developer',
            'soft_skill_description'=> 'Desciption PHP Developer',
            'is_active' => 1
        ];
        // //THEN
        $this->assertEquals($resultList, $resultData);
    }

    public function testShouldReturnArray_WhenGetIdSoftSkill_WithNotEqual()
    {
        //codecept_debug($data);
        //GIVEN

        //WHEN
       $resultList = $this->tester->getid($this->params[0]['soft_skill_id'])->toArray();

        unset($resultList[0]['created_at'], $resultList[0]['updated_at']);

        $resultData[0] = [
            'soft_skill_id' => 2,
            'soft_skill_name'=> 'PHP Developer',
            'soft_skill_description'=> 'Desciption PHP Developer',
            'is_active' => 1
        ];
        // //THEN
        $this->assertnotEquals($resultList, $resultData);
    }
}