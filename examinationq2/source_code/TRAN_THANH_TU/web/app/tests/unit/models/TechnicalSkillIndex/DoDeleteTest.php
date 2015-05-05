<?php 
namespace models\TechnicalSkillIndex;
/**
 * DoDeleteTest
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-07          Trieu Nguyen     Create File
 *
 * To do list
 * 1. testShouldReturnTrue_WhenDeleteTechniqueSkill_WithDeleteSuccess
*/

class DoDeleteTest extends \Codeception\TestCase\Test
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

    public function testShouldReturnTrue_WhenDeleteTechniqueSkill_WithDeleteSuccess()
    {
        //codecept_debug($data);
        //GIVEN
        $result = $this->tester->doDelete($this->params[1]['technique_id']);
        //WHEN
        $resultList = $this->tester->getList()->toArray();
        unset($resultList[0]['created_at'], $resultList[0]['updated_at']);
        unset($resultList[1]['created_at'], $resultList[1]['updated_at']);

        $resultData[0] = [
            'technique_id' => 1,
            'technique_name'=> 'PHP Developer',
            'technique_description'=> 'Desciption PHP Developer',
            'is_active' => 1
        ];

        $resultData[1] = [
            'technique_id' => 3,
            'technique_name'=> 'JavaScript Developer',
            'technique_description'=> 'Desciption JavaScript Developer',
            'is_active'=> 1
        ];
        
        // //THEN
        $this->assertTrue($result);
        $this->assertEquals($resultList, $resultData);
    }
}