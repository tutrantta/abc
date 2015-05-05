<?php 
namespace models\TechnicalResult;
/**
 * DoValidateTest
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-15          Trieu Nguyen     Create File
 *
 * To do list
 * 1. testShouldReturnError_WhenTechnicalUpdateResultDoValidate_WithExaminationResultCharater
 * 2. testShouldReturnError_WhenTechnicalUpdateResultDoValidate_WithExaminationResultLessThanZero
 * 3. testShouldReturnError_WhenTechnicalUpdateResultDoValidate_WithExaminationResultlGreaterThan100
 * 4. testShouldReturnError_WhenTechnicalUpdateResultDoValidate_WithExaminationResultCharaterTrue
 * 5. testShouldReturnError_WhenTechnicalUpdateResultDoValidate_WithExaminationResultCharaterFalse
 * 6. testShouldReturnTrue_WhenTechnicalUpdateResultDoValidate_WithExaminationResult90
 * 7. testShouldReturnError_WhenTechnicalUpdateResultDoValidate_WithPassExaminationCharater
 * 8. testShouldReturnTrue_WhenTechnicalUpdateResultDoValidate_WithPassExaminationTrue
 * 9. testShouldReturnTrue_WhenTechnicalUpdateResultDoValidate_WithPassExaminationFalse
*/

class DoValidateTest extends \Codeception\TestCase\Test
{
    protected $technicalResult;
    protected $params;

    protected function _before()
    {
        $this->technicalResult = new \TechnicalResult();
    }

    protected function _after()
    {

    }

    public function testShouldReturnError_WhenTechnicalUpdateResultDoValidate_WithExaminationResultCharater()
    {
        // give
        $validate = $this->technicalResult->doValidate([
            'class_id' => 1,
            'engineer_id' =>  3,
            'examination_result' => 'test abc'
        ]);
        // when
        $errorMsg = [
            'The examination result must be a number.',
        ];
        // then
        $this->assertEquals($errorMsg, $validate->errors()->all());
    }

    public function testShouldReturnError_WhenTechnicalUpdateResultDoValidate_WithExaminationResultLessThanZero()
    {
        // give
        $validate = $this->technicalResult->doValidate([
            'class_id' => 1,
            'engineer_id' =>  3,
            'examination_result' => -10
        ]);
        // when
        $errorMsg = [
            'The examination result must be between 0 and 100.',
        ];
        // then
        $this->assertEquals($errorMsg, $validate->errors()->all());
    }

    public function testShouldReturnError_WhenTechnicalUpdateResultDoValidate_WithExaminationResultlGreaterThan100()
    {
        // give
        $validate = $this->technicalResult->doValidate([
            'class_id' => 1,
            'engineer_id' =>  3,
            'examination_result' => 120
        ]);
        // when
        $errorMsg = [
            'The examination result must be between 0 and 100.',
        ];
        // then
        $this->assertEquals($errorMsg, $validate->errors()->all());
    }

    public function testShouldReturnError_WhenTechnicalUpdateResultDoValidate_WithExaminationResultCharaterTrue()
    {
        // give
        $validate = $this->technicalResult->doValidate([
            'class_id' => 1,
            'engineer_id' =>  3,
            'examination_result' => 'true'
        ]);
        // when
        $errorMsg = [
            'The examination result must be a number.',
        ];
        // then
        $this->assertEquals($errorMsg, $validate->errors()->all());
    }

    public function testShouldReturnError_WhenTechnicalUpdateResultDoValidate_WithExaminationResultCharaterFalse()
    {
        // give
        $validate = $this->technicalResult->doValidate([
            'class_id' => 1,
            'engineer_id' =>  3,
            'examination_result' => 'false'
        ]);
        // when
        $errorMsg = [
            'The examination result must be a number.',
        ];
        // then
        $this->assertEquals($errorMsg, $validate->errors()->all());
    }


    public function testShouldReturnTrue_WhenTechnicalUpdateResultDoValidate_WithExaminationResult90()
    {
        // give
        $validate = $this->technicalResult->doValidate([
            'class_id' => 1,
            'engineer_id' =>  3,
            'examination_result' => 90
        ]);
        // then
        $this->assertTrue($validate);
    }


    public function testShouldReturnError_WhenTechnicalUpdateResultDoValidate_WithPassExaminationCharater()
    {
        // give
        $validate = $this->technicalResult->doValidate([
            'class_id' => 1,
            'engineer_id' =>  3,
            'pass_examination' => 'sdasd'
        ]);
        // when
        $errorMsg = [
            'The pass examination field must be true or false.',
        ];
        // then
        $this->assertEquals($errorMsg, $validate->errors()->all());
    }

    public function testShouldReturnTrue_WhenTechnicalUpdateResultDoValidate_WithPassExaminationTrue()
    {
        // give
        $validate = $this->technicalResult->doValidate([
            'class_id' => 1,
            'engineer_id' =>  3,
            'pass_examination' => true
        ]);
        // then
        $this->assertTrue($validate);
    }

    public function testShouldReturnTrue_WhenTechnicalUpdateResultDoValidate_WithPassExaminationFalse()
    {
        // give
        $validate = $this->technicalResult->doValidate([
            'class_id' => 1,
            'engineer_id' =>  3,
            'pass_examination' => false
        ]);
        // then
        $this->assertTrue($validate);
    }
}