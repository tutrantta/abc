<?php 
namespace models\UtilizationModel;
require_once 'TestBase.php';
/**
 * Class getDataForUtilizationReportTest support test getDataForUtilizationReport function
 *
 * @author Dung Le
 *
 * To do list
 * 1. testShouldReturnNull_WhenMonthlyTableIsEmpty
 * 2. testShouldReturnArray_WhenInfomationCorrectButIncorrectDate
 * 3. testShouldReturnArray_WhenInfomationCorrect
 */
class getDataForUtilizationReportTest extends TestBase {
	
	protected $number_engineer = 2;
	protected function _before()
	{
		parent::_before();
		$this->objUtilization->utilization_report_timeline = date('m-Y');
		//set up master table
		$this->setUpDepartment();
		$this->setUpLevels();
		$this->setUpWorkingArea();
		// set up engineer info
		$this->setUpEngineer($this->number_engineer);
		$this->setUpEngineerPositionHistory($this->number_engineer);
		$this->setUpMonthlyUtilization($this->number_engineer);
	}

	protected function _after()
	{
		parent::_after();
	}

	public function testShouldReturnNull_WhenMonthlyTableIsEmpty()
	{
		// Give
		$expected 	= array();
		// When
		\DB::table('monthly_utilizations')->delete();
		\DB::table('working_areas')->delete();
		\DB::table('levels')->delete();
		$actual 	= $this->objUtilization->getDataForUtilizationReport();
		// Verify
		$this->assertEquals($expected, $actual);
	}
	public function testShouldReturnArray_WhenInfomationCorrectButIncorrectDate()
	{
		// Give
		$date     = date('m-Y', strtotime('02-02-2000'));

		$cols     = "F1.working_area_name as Department, F1.level_name as 'Level', F2.total as 'Total person', ROUND(F2.Utilization) AS Utilization";
		$table    = "(SELECT w.working_area_id, w.working_area_name, l.level_id, l.level_name
			FROM working_areas w, levels l
			WHERE w.is_active = 1 AND l.is_active = 1) F1
			LEFT JOIN
				(SELECT T1.level_id, T3.working_area_name, T2.month, COUNT(T1.engineer_id) AS 'total', AVG(T2.utilization) AS Utilization, T3.working_area_id
				FROM engineer_position_history T1
					JOIN engineers E1
					ON T1.engineer_id = E1.engineer_id
					JOIN monthly_utilizations T2
					ON E1.engineer_id = T2.engineer_id
					JOIN working_areas T3
					ON T2.working_area_id = T3.working_area_id
				WHERE T1.is_current = 1
					AND DATE_FORMAT(T2.month, '%m-%Y') = ?
					AND E1.is_active = 1
				GROUP BY T2.working_area_id, T1.level_id) F2
			ON F2.working_area_id = F1.working_area_id
				AND F2.level_id = F1.level_id";
		$order    = "F1.working_area_id, F1.level_id";

		$expected = \DB::select("SELECT $cols FROM $table ORDER BY $order", array($date));

		// When
		$this->objUtilization->utilization_report_timeline = $date;
		$actual   = $this->objUtilization->getDataForUtilizationReport();

		// Verify
		$this->assertEquals($expected, $actual);
	}
	public function testShouldReturnArray_WhenInfomationCorrect()
	{
		// Give
		$cols     = "F1.working_area_name as Department, F1.level_name as 'Level', F2.total as 'Total person', ROUND(F2.Utilization) AS Utilization";
		$table    = "(SELECT w.working_area_id, w.working_area_name, l.level_id, l.level_name
			FROM working_areas w, levels l
			WHERE w.is_active = 1 AND l.is_active = 1) F1
			LEFT JOIN
				(SELECT T1.level_id, T3.working_area_name, T2.month, COUNT(T1.engineer_id) AS 'total', AVG(T2.utilization) AS Utilization, T3.working_area_id
				FROM engineer_position_history T1
					JOIN engineers E1
					ON T1.engineer_id = E1.engineer_id
					JOIN monthly_utilizations T2
					ON E1.engineer_id = T2.engineer_id
					JOIN working_areas T3
					ON T2.working_area_id = T3.working_area_id
				WHERE T1.is_current = 1
					AND DATE_FORMAT(T2.month, '%m-%Y') = ?
					AND E1.is_active = 1
				GROUP BY T2.working_area_id, T1.level_id) F2
			ON F2.working_area_id = F1.working_area_id
				AND F2.level_id = F1.level_id";
		$order    = "F1.working_area_id, F1.level_id";

		$expected = \DB::select("SELECT $cols FROM $table ORDER BY $order", array($this->objUtilization->utilization_report_timeline));
		// When
		$actual   = $this->objUtilization->getDataForUtilizationReport();
		// Verify
		$this->assertEquals($expected, $actual);
	}
}