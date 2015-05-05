<?php 
namespace models\TechnicalSkillIndex;
/**
 * DoUpdateTest
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-07          Trieu Nguyen     Create File
 *
 * To do list
 * 1. testShouldReturnFalseAndErrorMessage_WhenUpdateTechniqueSkill_WithEmptyAllParams
 * 2. testShouldReturnFalseAndErrorMessage_WhenUpdateTechniqueSkill_WithEmptySkillName
 * 3. testShouldReturnTrue_WhenUpdateTechniqueSkill_WithSuccess
 * 4. testShouldReturnFalse_WhenUpdateTechniqueSkill_WithSkillnameExits
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
        $this->tester = new \TechnicalSkillIndex();
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('techniques')->delete();
        // setup data
        $this->params[0] = [
            'technique_id' => 1,
            'technique_name'=> 'PHP Developer',
            'technique_description'=> 'Desciption PHP Developer',
            'is_active'=> 1
        ];
        $this->params[1] = [
            'technique_id' => 2,
            'technique_name'=> 'HTML Developer',
            'technique_description'=> 'Desciption HTML Developer',
            'is_active'=> 1
        ];
        \DB::table('techniques')->insert($this->params);
    }

    protected function _after()
    {

    }

    public function testShouldReturnFalseAndErrorMessage_WhenUpdateTechniqueSkill_WithEmptyAllParams()
    {
        //GIVEN
        $params = [
            'technique_name'=> null,
            'technique_description'=> null,
            'is_active'=> 1
        ];
        $this->messageExpert = [
            'The technique name field is required.'
        ];
        \Input::merge($params);
        //WHEN
        $results = $this->tester->doUpdate($this->params[0]['technique_id']);
        is_object($results) ? $flag = false : $flag = true;
        //THEN
        // test validate
        $this->assertFalse($flag);
        $this->assertEquals($results->all(), $this->messageExpert);
    }

    public function testShouldReturnFalseAndErrorMessage_WhenUpdateTechniqueSkill_WithEmptySkillName()
    {
        //GIVEN
        $params = [
            'technique_name'=> null,
            'technique_description'=> 'Desciption update',
            'is_active'=> 1
        ];
        $this->messageExpert = [
            'The technique name field is required.'
        ];
        \Input::merge($params);
        //WHEN
        $results = $this->tester->doUpdate($this->params[0]['technique_id']);
        is_object($results) ? $flag = false : $flag = true;
        //THEN
        // test validate
        $this->assertFalse($flag);
        $this->assertEquals($results->all(), $this->messageExpert);
    }

    public function testShouldReturnTrue_WhenUpdateTechniqueSkill_WithSuccess()
    {
        //GIVEN
        $params = [
            'technique_name'=> 'PHP Developer 2',
            'technique_description'=> 'Desciption update',
            'is_active'=> 1
        ];
        \Input::merge($params);
        //WHEN
        // update technique 
        $results = $this->tester->doUpdate($this->params[0]['technique_id']);
        // get technique
        $dataResults = $this->tester->getId($this->params[0]['technique_id'])->toArray();
        unset($dataResults['created_at'], $dataResults['updated_at']);
        // 
        $arrayCompare = [
            'technique_id' => 1,
            'technique_name' => 'PHP Developer 2',
            'technique_description' => 'Desciption update',
            'is_active'=> 1
        ];
        //THEN
        $this->assertTrue($results);
        $this->assertEquals($arrayCompare, $dataResults);
    }

    public function testShouldReturnFalse_WhenUpdateTechniqueSkill_WithSkillnameExits()
    {
        //GIVEN
        $params = [
            'technique_name'=> 'HTML Developer',
            'technique_description'=> 'Desciption HTML Developer',
            'is_active'=> 1
        ];

        $this->messageExpert = [
            'The technique name has already been taken.'
        ];
        \Input::merge($params);
        //WHEN
        $results = $this->tester->doUpdate($this->params[0]['technique_id']);
        is_object($results) ? $flag = false : $flag = true;
        //THEN
        // test validate
        $this->assertFalse($flag);
        $this->assertEquals($results->all(), $this->messageExpert);
    }
}