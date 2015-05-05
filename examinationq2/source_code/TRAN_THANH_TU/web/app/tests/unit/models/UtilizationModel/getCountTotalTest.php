<?php 
namespace models\UtilizationModel;
require_once 'TestBase.php';
/**
 * Class getCountTotalTest support test getCountTotal function
 *
 * @author Dung Le
 *
 * To do list
 * 1. testShouldReturnArrayNull_WhenMonthlyTableIsEmpty
 * 2. testShouldReturnArrayCountTotal_WhenInfomationCorrectButIncorrectDate
 * 3. testShouldReturnArrayCountTotal_WhenInfomationCorrect
 */
class getCountTotalTest extends TestBase {
	
	protected $number_engineer = 2;
	protected function _before()
	{
		parent::_before();
		$this->objUtilization->utilization_report_timeline = date('m-Y');
		// set up master table
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

	public function testShouldReturnArrayNull_WhenMonthlyTableIsEmpty()
	{
		// Give
		$expected = array();
		// When
		\DB::table('monthly_utilizations')->delete();
		\DB::table('working_areas')->delete();
		\DB::table('levels')->delete();
		$actual   = $this->objUtilization->getCountTotal();
		// Verify
		$this->assertEquals($expected, $actual);
	}
	public function testShouldReturnArrayCountTotal_WhenInfomationCorrectButIncorrectDate()
	{
		// Give
		$date     = date('m-Y', strtotime('02-02-2000'));

		$cols     = "F1.working_area_name AS Department, NULL AS 'Level', SUM(F2.total) AS 'Total person', ROUND(AVG(F2.Utilization)) AS Utilization";
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
		$group    = "F1.working_area_id";

		$expected = \DB::select("SELECT $cols FROM $table GROUP BY $group", array($date));

		// When
		$this->objUtilization->utilization_report_timeline = $date;
		$actual   = $this->objUtilization->getCountTotal();

		// Verify
		$this->assertEquals($expected, $actual);
	}

	public function testShouldReturnArrayCountTotal_WhenInfomationCorrect()
	{
		// Give
		$cols     = "F1.working_area_name AS Department, NULL AS 'Level', SUM(F2.total) AS 'Total person', ROUND(AVG(F2.Utilization)) AS Utilization";
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
		$group    = "F1.working_area_id";

		$expected = \DB::select("SELECT $cols FROM $table GROUP BY $group", array($this->objUtilization->utilization_report_timeline));
		// When
		$actual   = $this->objUtilization->getCountTotal();
		// Verify
		$this->assertEquals($expected, $actual);
	}
}