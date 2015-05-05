<?php 
namespace models\TechnicalResult;
/**
 * UpdateResultTest
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-15          Trieu Nguyen     Create File
 *
 * To do list
 * 1. testShouldReturnTrue_WhenTechnicalUpdateResultUpdate_WithExaminationResult
 * 2. testShouldReturnTrue_WhenTechnicalUpdateResultUpdate_WithPassExamination
*/

class UpdateResultTest extends \Codeception\TestCase\Test
{
    protected $technicalResult;

    protected function _before()
    {
        $this->technicalResult = new \TechnicalResult();
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // drop data
        \DB::table('class_assignments')->delete();
        // insert data
        $class_assignments_insert = array(
            array(
                'engineer_id' => 101,
                'class_id' => 2,
                'examination_result' => 70,
                'pass_examination' => 1
            ),
            array(
                'engineer_id' => 102,
                'class_id' => 2,
                'examination_result' => 80,
                'pass_examination' => 1
            ),
            array(
                'engineer_id' => 103,
                'class_id' => 2,
                'examination_result' => 40,
                'pass_examination' => 0
            ),
        );
        \DB::table('class_assignments')->insert($class_assignments_insert);
    }

    protected function _after()
    {

    }

    public function testShouldReturnTrue_WhenTechnicalUpdateResultUpdate_WithExaminationResult()
    {
        // give
        $classId = 2;
        $engineerId = 101;
        $updateData = array('examination_result' => 50);
        
        $update = $this->technicalResult->updateResult($classId, $engineerId, $updateData);
        if ($update) 
        {
            $actual = true;
        } 
        else
        {
            $actual = false;
        }
        // then
        $this->assertTrue($actual);
    }

    public function testShouldReturnTrue_WhenTechnicalUpdateResultUpdate_WithPassExamination()
    {
        // give
        $classId = 2;
        $engineerId = 101;
        $updateData = array('pass_examination' => 0);
        
        $update = $this->technicalResult->updateResult($classId, $engineerId, $updateData);
        if ($update) 
        {
            $actual = true;
        } 
        else
        {
            $actual = false;
        }
        // then
        $this->assertTrue($actual);
    }

}