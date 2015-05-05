<?php namespace models;
/**
 * DoUpdateTest
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-08          Trieu Nguyen     Create File
 *
 * To do list
 * 1. testShouldReturnFalseAndErrorMessage_WhenUpdateSoftSkill_WithEmptyAllParams
 * 2. testShouldReturnFalseAndErrorMessage_WhenUpdateSoftSkill_WithEmptySkillName
 * 3. testShouldReturnTrue_WhenUpdateSoftSkill_WithSuccess
 * 4. testShouldReturnFalse_WhenUpdateSoftSkill_WithSkillnameExits
*/

class DoUpdateTest extends \Codeception\TestCase\Test
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
        \DB::table('soft_skills')->insert($this->params);
    }

    protected function _after()
    {

    }

    public function testShouldReturnFalseAndErrorMessage_WhenUpdateSoftSkill_WithEmptyAllParams()
    {
        //GIVEN
        $params = [
            'soft_skill_name'=> null,
            'soft_skill_description'=> null,
            'is_active'=> 1
        ];
        $this->messageExpert = [
            'The soft skill name field is required.'
        ];
        \Input::merge($params);
        //WHEN
        $results = $this->tester->doUpdate($this->params[0]['soft_skill_id']);
        is_object($results) ? $flag = false : $flag = true;
        //THEN
        // test validate
        $this->assertFalse($flag);
        $this->assertEquals($results->all(), $this->messageExpert);
    }

    public function testShouldReturnFalseAndErrorMessage_WhenUpdateSoftSkill_WithEmptySkillName()
    {
        //GIVEN
        $params = [
            'soft_skill_name'=> null,
            'soft_skill_description'=> 'Desciption update',
            'is_active'=> 1
        ];
        $this->messageExpert = [
            'The soft skill name field is required.'
        ];
        \Input::merge($params);
        //WHEN
        $results = $this->tester->doUpdate($this->params[0]['soft_skill_id']);
        is_object($results) ? $flag = false : $flag = true;
        //THEN
        // test validate
        $this->assertFalse($flag);
        $this->assertEquals($results->all(), $this->messageExpert);
    }

    public function testShouldReturnTrue_WhenUpdateSoftSkill_WithSuccess()
    {
        //GIVEN
        $params = [
            'soft_skill_name'=> 'PHP Developer 2',
            'soft_skill_description'=> 'Desciption update',
            'is_active'=> 1
        ];
        \Input::merge($params);
        //WHEN
        // update soft skill 
        $results = $this->tester->doUpdate($this->params[0]['soft_skill_id']);
        // get soft skill
        $dataResults = $this->tester->getId($this->params[0]['soft_skill_id'])->toArray();
        unset($dataResults['created_at'], $dataResults['updated_at']);
        // 
        $arrayCompare = [
            'soft_skill_id' => 1,
            'soft_skill_name' => 'PHP Developer 2',
            'soft_skill_description' => 'Desciption update',
            'is_active'=> 1
        ];
        //THEN
        $this->assertTrue($results);
        $this->assertEquals($arrayCompare, $dataResults);
    }

    public function testShouldReturnFalse_WhenUpdateSoftSkill_WithSkillnameExits()
    {
        //GIVEN
        $params = [
            'soft_skill_name'=> 'HTML Developer',
            'soft_skill_description'=> 'Desciption HTML Developer',
            'is_active'=> 1
        ];

        $this->messageExpert = [
            'The soft skill name has already been taken.'
        ];
        \Input::merge($params);
        //WHEN
        $results = $this->tester->doUpdate($this->params[0]['soft_skill_id']);
        is_object($results) ? $flag = false : $flag = true;
        //THEN
        // test validate
        $this->assertFalse($flag);
        $this->assertEquals($results->all(), $this->messageExpert);
    }
}