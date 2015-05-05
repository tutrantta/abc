<?php namespace models\TechnicalReport;
require_once 'TestBase.php';
/**
 * Class getTechReportDataTest support test doValidate function
 *
 * @author Dung Le
 *
 * To do list
 * 1. testgetTechReportDataTest_ShouldReturnArray_WhenInputMonthIsCorrect
 */
class getTechReportDataTest extends TestBase {

	protected $number_engineer = 5;
	
	protected function _before()
	{
		parent::_before();
		// set up master table
		$this->setUpTechnique();
		$this->setUpLevels();
		// set up engineer info
		$this->setUpEngineer($this->number_engineer);
		$this->setUpTechticalLevelHistory();
	}

	protected function _after()
	{
		parent::_after();
	}

	public function testShouldReturnArray_WhenInputMonthIsCorrect()
	{
		// Give
		$month 		= date("m-Y");
		// When
		$ret    	= \TechnicalReport::getTechReportData($month);
		// first row
        $actual 	= get_object_vars($ret[0]);
        unset($actual['ratio']);

		$this->sortArrayByColum($this->arrTechniques, 'technique_name', SORT_ASC);
		$expected 	= array(
			'technique_id' 		=> $this->arrTechniques[0]['technique_id'],
	        'level_id' 			=> $this->arrLevel[0]['level_id'],
	        'technique_name' 	=> $this->arrTechniques[0]['technique_name'],
	        'level_name' 		=> $this->arrLevel[0]['level_name'],
	        'eamount' 			=> count($this->arrEngineer)
		);
		// Verify content
		$this->assertEquals($expected, $actual);
	}
}