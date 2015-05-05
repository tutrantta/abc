<?php namespace models;
/**
 * GetListTest
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-08          Trieu Nguyen     Create File
 *
 * To do list
 * 1. testShouldReturnArray_WhenListSoftSkill_WithEqual
 * 2. testShouldReturnArray_WhenListSoftSkill_WithNotEqual
*/

class GetListTest extends \Codeception\TestCase\Test
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

    public function testShouldReturnArray_WhenListSoftSkill_WithEqual()
    {
        //codecept_debug($data);
        //GIVEN

        //WHEN
        $resultList = $this->tester->getList()->toArray();

        unset($resultList[0]['created_at'], $resultList[0]['updated_at']);
        unset($resultList[1]['created_at'], $resultList[1]['updated_at']);
        unset($resultList[2]['created_at'], $resultList[2]['updated_at']);

        $resultData[0] = [
            'soft_skill_id' => 1,
            'soft_skill_name'=> 'PHP Developer',
            'soft_skill_description'=> 'Desciption PHP Developer',
            'is_active' => 1
        ];

        $resultData[1] = [
            'soft_skill_id' => 2,
            'soft_skill_name'=> 'HTML Developer',
            'soft_skill_description'=> 'Desciption HTML Developer',
            'is_active'=> 1
        ];

        $resultData[2] = [
            'soft_skill_id' => 3,
            'soft_skill_name'=> 'JavaScript Developer',
            'soft_skill_description'=> 'Desciption JavaScript Developer',
            'is_active'=> 1
        ];
        // //THEN
        $this->assertEquals($resultList, $resultData);
    }

    public function testShouldReturnArray_WhenListSoftSkill_WithNotEqual()
    {
        //codecept_debug($data);
        //GIVEN

        //WHEN
        $resultList = $this->tester->getList()->toArray();

        unset($resultList[0]['created_at'], $resultList[0]['updated_at']);
        unset($resultList[1]['created_at'], $resultList[1]['updated_at']);
        unset($resultList[2]['created_at'], $resultList[2]['updated_at']);

        $resultData[0] = [
            'soft_skill_id' => 1,
            'soft_skill_name'=> 'PHP Developer1',
            'soft_skill_description'=> 'Desciption PHP Developer',
            'is_active' => 1
        ];
        // //THEN
        $this->assertNotEquals($resultList, $resultData);
    }
}