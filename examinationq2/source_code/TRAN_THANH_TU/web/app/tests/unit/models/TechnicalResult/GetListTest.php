<?php 
namespace models\TechnicalResult;
/**
 * GetListTest
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-15          Trieu Nguyen     Create File
 *
 * To do list
 * 1. testShouldReturnNull_WhenTechnicalUpdateResultGetList_WithClassEmpty
 * 2. testShouldReturnNotEquals_WhenTechnicalUpdateResultGetList_WithClassEqual2
 * 3. testShouldReturnNull_WhenTechnicalUpdateResultGetList_WithClassEqual2
*/

class GetListTest extends \Codeception\TestCase\Test
{
    protected $technicalResult;

    protected function _before()
    {
        $this->technicalResult = new \TechnicalResult();
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // drop data
        \DB::table('class_assignments')->delete();
        \DB::table('engineers')->delete();
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

        $engineers_insert = array(
            array(
                'engineer_id' => '101',
                'employee_code' => 'code2',
                'fullname' => 'Engineer 101',
                'is_active' => 1
            ),
            array(
                'engineer_id' => '102',
                'employee_code' => 'code102',
                'fullname' => 'Engineer 102',
                'is_active' => 1
            ),
            array(
                'engineer_id' => '103',
                'employee_code' => 'code103',
                'fullname' => 'Engineer 103',
                'is_active' => 1
            ),
        );
        \DB::table('class_assignments')->insert($class_assignments_insert);
        \DB::table('engineers')->insert($engineers_insert);
    }

    protected function _after()
    {

    }


    public function testShouldReturnNull_WhenTechnicalUpdateResultGetList_WithClassEmpty()
    {
        // give
        $arrData = $this->technicalResult->getList();
        
        $arrTechnicalList = array();
        foreach ($arrData['data'] as $key => $value) {
            $arrTechnicalList[] = get_object_vars($value);
        }
        // then
        $this->assertEquals(0, $arrData['count']);
        $this->assertEquals(array(), $arrTechnicalList);
    }

    public function testShouldReturnNotEquals_WhenTechnicalUpdateResultGetList_WithClassEqual2()
    {
        // give
        $arrData = $this->technicalResult->getList(2);
        
        $arrTechnicalList = array();
        foreach ($arrData['data'] as $key => $value) {
            $arrTechnicalList[] = get_object_vars($value);
        }

        $dataOuput[0] =  array(
                 'fullname' => 'Engineer 101',
                 'class_id' => 2,
                 'examination_result' => 70,
                 'pass_examination' => 1,
                 'employee_code' => 'code2',
                 'engineer_id' => 101
        );
        $dataOuput[1] =  array(
                'fullname' => 'Engineer 103',
                'class_id' => 2,
                'examination_result' => 40,
                'pass_examination' => 0,
                'employee_code' => 'code103',
                'engineer_id' => 103
        );
        // then
        $this->assertEquals(3, $arrData['count']);
        $this->assertNotEquals($dataOuput, $arrTechnicalList);
    }

    public function testShouldReturnNull_WhenTechnicalUpdateResultGetList_WithClassEqual2()
    {
        // give
        $arrData = $this->technicalResult->getList(2);
        
        $arrTechnicalList = array();
        foreach ($arrData['data'] as $key => $value) {
            $arrTechnicalList[] = get_object_vars($value);
        }

        $dataOuput[0] =  array(
                 'fullname' => 'Engineer 101',
                 'class_id' => 2,
                 'examination_result' => 70,
                 'pass_examination' => 1,
                 'employee_code' => 'code2',
                 'engineer_id' => 101
        );
        $dataOuput[1] =  array(
                'fullname' => 'Engineer 103',
                'class_id' => 2,
                'examination_result' => 40,
                'pass_examination' => 0,
                'employee_code' => 'code103',
                'engineer_id' => 103
        );
        $dataOuput[2] =  array(
                'fullname' => 'Engineer 102',
                'class_id' => 2,
                'examination_result' => 80,
                'pass_examination' => 1,
                'employee_code' => 'code102',
                'engineer_id' => 102
        );
        // then
       $this->assertEquals(3, $arrData['count']);
       $this->assertEquals($dataOuput, $arrTechnicalList);
    }


}