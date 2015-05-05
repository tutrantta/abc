<?php namespace models\TrainerReport;
require_once __DIR__ . '/../TestBase.php';
/**
 * Class doValidateTest support test doValidate function
 *
 * @author Dung Le
 *
 * To do list
 * 1. testShouldReturnErrorWhenInputFromDateIsEmpty
 * 2. testShouldReturnErrorWhenInputToDateIsEmpty
 * 3. testShouldReturnErrorWhenInputFromDateGreaterThanToDate
 * 4. testShouldReturnErrorWhenInputIsIncorrectSubmitDate
 * 5. testShouldReturnTrueWhenInputIsCorrectFormat
 */
class doValidateTest extends \TestBase {

    protected function _before()
    {
        parent::_before();
        $this->objTrainerReport = new \TrainerReport();

    }

    protected function _after()
    {
        parent::_after();
    }

    public function testShouldReturnErrorWhenInputFromDateIsEmpty()
    {
        // Give
        $expected  = 'The date from field is required.';
        // When
        $this->objTrainerReport->fill(['date_from' => '']);
        $return    = $this->objTrainerReport->doValidate();
        $msg_error = $this->objTrainerReport->errors()->get('date_from');
        $actual    = $msg_error[0];

        // Verify return
        $this->assertFalse($return);
        // Verify content
        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnErrorWhenInputToDateIsEmpty()
    {
        // Give
        $expected  = 'The date to field is required.';
        // When
        $this->objTrainerReport->fill(['date_to' => '']);
        $return    = $this->objTrainerReport->doValidate();
        $msg_error = $this->objTrainerReport->errors()->get('date_to');
        $actual    = $msg_error[0];

        // Verify return
        $this->assertFalse($return);
        // Verify content
        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnErrorWhenInputFromDateGreaterThanToDate()
    {
        // Give
        $expected  = 'The date from must be a date before date to.';
        // When
        $this->objTrainerReport->fill(['date_to' => '01-01-2015', 'date_from' => '02-02-2015']);
        $return    = $this->objTrainerReport->doValidate();
        $msg_error = $this->objTrainerReport->errors()->get('date_from');
        $actual    = $msg_error[0];

        // Verify return
        $this->assertFalse($return);
        // Verify content
        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnErrorWhenInputIsIncorrectSubmitDate()
    {
        // Give
        $expected  = 'The report date does not match the format d-m-Y.';
        // When
        $this->objTrainerReport->fill(['report_date' => '000002015']);
        $return    = $this->objTrainerReport->doValidate();
        $msg_error = $this->objTrainerReport->errors()->get('report_date');
        $actual    = $msg_error[0];

        // Verify return
        $this->assertFalse($return);
        // Verify content
        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnTrueWhenInputIsCorrectFormat()
    {
        // Give
        $expected  = array();
        // When
        $this->objTrainerReport->fill(['date_to' => '02-02-2015', 'date_from' => '01-01-2015', 'report_date' => '01-01-1111']);
        $return    = $this->objTrainerReport->doValidate();
        $msg_error = $this->objTrainerReport->errors()->all();
        $actual    = $msg_error;

        // Verify return
        $this->assertTrue($return);
        // Verify content
        $this->assertEquals($expected, $actual);
    }
}