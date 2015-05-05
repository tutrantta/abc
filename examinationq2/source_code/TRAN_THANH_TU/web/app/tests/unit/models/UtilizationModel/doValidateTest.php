<?php 
namespace models\UtilizationModel;
require_once 'TestBase.php';
/**
 * Class UtilizationModel_doValidateTest support test doValidate function
 *
 * @author Dung Le
 *
 * To do list
 * 1. testShouldReturnError_WhenInputIsEmpty
 * 2. testShouldReturnError_WhenInputIsIncorrectFormat_OneInput
 * 3. testShouldReturnError_WhenInputIsIncorrectFormat_TwoInput
 * 4. testShouldReturnTrue_WhenInputIsCorrectFormat_OneInput
 * 5. testShouldReturnTrue_WhenInputIsCorrectFormat_TwoInput
 */
class doValidateTest extends TestBase {
    
    protected function _before()
    {
        parent::_before();
    }

    protected function _after()
    {
        parent::_after();
    }

    public function testShouldReturnError_WhenInputIsEmpty()
    {
        // Give
        $expected  = 'The utilization report timeline field is required.';
        // When
        $this->objUtilization->fill(['utilization_report_timeline' => '']);
        $return    = $this->objUtilization->doValidate();
        $msg_error = $this->objUtilization->errors()->get('utilization_report_timeline');
        $actual    = $msg_error[0];

        // Verify return
        $this->assertFalse($return);
        // Verify content
        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnError_WhenInputIsIncorrectFormat_OneInput()
    {
        // Give
        $expected  = 'The utilization report timeline does not match the format m-Y.';
        // When
        $this->objUtilization->fill(['utilization_report_timeline' => '20000']);
        $return    = $this->objUtilization->doValidate();
        $msg_error = $this->objUtilization->errors()->get('utilization_report_timeline');
        $actual    = $msg_error[0];

        // Verify return
        $this->assertFalse($return);
        // Verify content
        $this->assertEquals($expected, $actual);
    }
    
    public function testShouldReturnError_WhenInputIsIncorrectFormat_TwoInput()
    {
        // Give
        $expected  = array(
                '0' => 'The utilization report timeline does not match the format m-Y.',
                '1' => 'The utilization report timeline must be between 7 and 7 characters.',
                '2' => 'The utilization report date does not match the format d-m-Y.'
        );
        // When
        $this->objUtilization->fill(['utilization_report_timeline' => '20000', 'utilization_report_date' => '20000']);
        $return    = $this->objUtilization->doValidate();
        $msg_error = $this->objUtilization->errors()->all();
        $actual    = $msg_error;
    
        // Verify return
        $this->assertFalse($return);
        // Verify content
        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnTrue_WhenInputIsCorrectFormat_OneInput()
    {
        // Give
        $expected  = array();
        // When
        $this->objUtilization->fill(['utilization_report_timeline' => '11-1111']);
        $return    = $this->objUtilization->doValidate();
        $actual    = $this->objUtilization->errors()->get('utilization_report_timeline');
    
        // Verify return
        $this->assertTrue($return);
        // Verify content
        $this->assertEquals($expected, $actual);
    }
    
    public function testShouldReturnTrue_WhenInputIsCorrectFormat_TwoInput()
    {
        // Give
        $expected  = array();
        // When
        $this->objUtilization->fill(['utilization_report_timeline' => '11-1111', 'utilization_report_date' => '11-11-1111']);
        $return    = $this->objUtilization->doValidate();
        $actual    = $this->objUtilization->errors()->all();
    
        // Verify return
        $this->assertTrue($return);
        // Verify content
        $this->assertEquals($expected, $actual);
    }
}