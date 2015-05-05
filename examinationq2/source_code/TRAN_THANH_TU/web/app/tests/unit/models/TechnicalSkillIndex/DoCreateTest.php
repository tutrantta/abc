<?php 
namespace models\TechnicalSkillIndex;
/**
 * DoCreateTest
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-07          Trieu Nguyen     Create File
 *
 * To do list
 * 1. testShouldReturnFalse_WhenCreateTechniqueSkill_WithEmptyAllParams
 * 2. testShouldReturnFalse_WhenCreateTechniqueSkill_WithEmptySkillName
 * 3. testShouldReturnTrue_WhenCreateTechniqueSkill_WithEmptySkillDescription
 * 4. testShouldReturnFalse_WhenCreateTechniqueSkill_WithSkillExits
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
        $this->tester = new \TechnicalSkillIndex();
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('techniques')->delete();
    }

    protected function _after()
    {

    }

    public function testShouldReturnFalse_WhenCreateTechniqueSkill_WithEmptyAllParams()
    {
        //GIVEN
        $this->params = [
            'skill_name'=> null,
            'skill_description'=>null,
            'is_active'=> 1
        ];
        $this->messageExpert = [
            'The technique name field is required.'
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

    public function testShouldReturnFalse_WhenCreateTechniqueSkill_WithEmptySkillName()
    {
        //GIVEN
        $this->params = [
            'technique_name'=> null,
            'technique_description'=> 'description',
            'is_active'=> 1
        ];
        $this->messageExpert = [
            'The technique name field is required.'
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

    public function testShouldReturnTrue_WhenCreateTechniqueSkill_WithEmptySkillDescription()
    {
        //GIVEN
        $this->params = [
            'technique_name'=> 'PHP Developer',
            'technique_description'=> null,
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


    public function testShouldReturnFalse_WhenCreateTechniqueSkill_WithSkillExits()
    {
        //GIVEN
        $this->params = [
            'technique_name'=> 'PHP Developer',
            'technique_description'=> null,
            'is_active'=> 1
        ];

        $this->messageExpert = [
            'The technique name has already been taken.'
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