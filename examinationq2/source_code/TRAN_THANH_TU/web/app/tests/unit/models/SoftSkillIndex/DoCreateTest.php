<?php namespace models;
/**
 * DoCreateTest
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-08          Trieu Nguyen     Create File
 *
 * To do list
 * 1. testShouldReturnFalse_WhenCreateSoftSkill_WithEmptyAllParams
 * 2. testShouldReturnFalse_WhenCreateSoftSkill_WithEmptySkillName
 * 3. testShouldReturnTrue_WhenCreateSoftSkill_WithEmptySkillDescription
 * 4. testShouldReturnFalse_WhenCreateSoftSkill_WithSkillExits
*/

class DoCreateTest extends \Codeception\TestCase\Test
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
    }

    protected function _after()
    {

    }

    public function testShouldReturnFalse_WhenCreateSoftSkill_WithEmptyAllParams()
    {
        //GIVEN
        $this->params = [
            'soft_skill_name'=> null,
            'soft_skill_description'=> null,
            'is_active'=> 1
        ];
        $this->messageExpert = [
            'The soft skill name field is required.'
        ];
        $this->tester->fill($this->params);
        //WHEN
        $results = $this->tester->doInsert();
        //THEN
        // test return
        $this->assertFalse($results);
        // test validate
        $this->assertEquals($this->tester->errors()->all(), $this->messageExpert);
    }

    public function testShouldReturnFalse_WhenCreateSoftSkill_WithEmptySkillName()
    {
        //GIVEN
        $this->params = [
            'soft_skill_name'=> null,
            'soft_skill_description'=> 'description',
            'is_active'=> 1
        ];
        $this->messageExpert = [
            'The soft skill name field is required.'
        ];
        $this->tester->fill($this->params);
        //WHEN
        $results = $this->tester->doInsert();
        //THEN
        // test return
        $this->assertFalse($results);
        // test validate
        $this->assertEquals($this->tester->errors()->all(), $this->messageExpert);
    }

    public function testShouldReturnTrue_WhenCreateSoftSkill_WithEmptySkillDescription()
    {
        //GIVEN
        $this->params = [
            'soft_skill_name'=> 'PHP Developer',
            'soft_skill_description'=> null,
            'is_active'=> 1
        ];
        $this->messageExpert = [];
        $this->tester->fill($this->params);
        //WHEN
        $results = $this->tester->doInsert();
        // test return
        $this->assertTrue($results);
        //THEN
        $this->assertEquals($this->tester->errors()->all(), $this->messageExpert);
    }


    public function testShouldReturnFalse_WhenCreateSoftSkill_WithSkillExits()
    {
        //GIVEN
        $this->params = [
            'soft_skill_name'=> 'PHP Developer',
            'soft_skill_description'=> null,
            'is_active'=> 1
        ];

        $this->messageExpert = [
            'The soft skill name has already been taken.'
        ];

        $this->tester->fill($this->params);
        $this->tester->doInsert();
        
        //WHEN
        $results = $this->tester->doInsert();

        // test return
        $this->assertFalse($results);
        //THEN
        $this->assertEquals($this->tester->errors()->all(), $this->messageExpert);
    }
}