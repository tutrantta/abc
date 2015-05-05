<?php namespace models\TrainingGeneralReport;
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
        $this->objGenaral = new \TrainingGeneralReport();
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
        $this->objGenaral->fill(['date_from' => '']);
        $return    = $this->objGenaral->doValidate();
        $msg_error = $this->objGenaral->errors()->get('date_from');
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
        $this->objGenaral->fill(['date_to' => '']);
        $return    = $this->objGenaral->doValidate();
        $msg_error = $this->objGenaral->errors()->get('date_to');
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
        $this->objGenaral->fill(['date_to' => '01-01-2015', 'date_from' => '02-02-2015']);
        $return    = $this->objGenaral->doValidate();
        $msg_error = $this->objGenaral->errors()->get('date_from');
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
        $this->objGenaral->fill(['report_date' => '000002015']);
        $return    = $this->objGenaral->doValidate();
        $msg_error = $this->objGenaral->errors()->get('report_date');
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
        $this->objGenaral->fill(['date_to' => '02-02-2015', 'date_from' => '01-01-2015', 'report_date' => '01-01-1111']);
        $return    = $this->objGenaral->doValidate();
        $msg_error = $this->objGenaral->errors()->all();
        $actual    = $msg_error;

        // Verify return
        $this->assertTrue($return);
        // Verify content
        $this->assertEquals($expected, $actual);
    }
}