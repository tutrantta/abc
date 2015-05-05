<?php 
namespace models\TechnicalSkillIndex;
/**
 * GetIdTest
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-07          Trieu Nguyen     Create File
 *
 * To do list
 * 1. testShouldReturnArray_WhenGetIdTechniqueSkill_WithEqual
 * 2. testShouldReturnArray_WhenGetIdTechniqueSkill_WithNotEqual
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

        $this->params[2] = [
            'technique_id' => 3,
            'technique_name'=> 'JavaScript Developer',
            'technique_description'=> 'Desciption JavaScript Developer',
            'is_active'=> 1
        ];

        \DB::table('techniques')->insert($this->params);
    }

    protected function _after()
    {

    }

    public function testShouldReturnArray_WhenGetIdTechniqueSkill_WithEqual()
    {
        //codecept_debug($data);
        //GIVEN

        //WHEN
        $resultList = $this->tester->getid(1)->toArray();

        unset($resultList['created_at'], $resultList['updated_at']);
     
        $resultData = [
            'technique_id' => 1,
            'technique_name'=> 'PHP Developer',
            'technique_description'=> 'Desciption PHP Developer',
            'is_active' => 1
        ];
        // //THEN
        $this->assertEquals($resultList, $resultData);
    }

    public function testShouldReturnArray_WhenGetIdTechniqueSkill_WithNotEqual()
    {
        //codecept_debug($data);
        //GIVEN

        //WHEN
       $resultList = $this->tester->getid($this->params[0]['technique_id'])->toArray();

        unset($resultList[0]['created_at'], $resultList[0]['updated_at']);

        $resultData[0] = [
            'technique_id' => 2,
            'technique_name'=> 'PHP Developer',
            'technique_description'=> 'Desciption PHP Developer',
            'is_active' => 1
        ];
        // //THEN
        $this->assertnotEquals($resultList, $resultData);
    }
}