<?php
/**
 * class UtilizationModel support get data from database
 * and caculator for export
 * 
 * @author lqdung
 *
 */
class UtilizationModel extends \BaseModel {
    /**
     * variable for mass assignment
     * @var array
     */
	public $fillable = [
		'utilization_report_timeline',
		'utilization_report_by',
		'utilization_report_to',
		'utilization_report_date'
	];
	
    /**
     * variable for validate
     * @var array
     */
	public static $rules = [
		'utilization_report_timeline' => 'required|date_format:m-Y|between:7,7',
        'utilization_report_date'     => 'date_format:d-m-Y'
	];
	
    /**
     * getDataForUtilizationReport function support get data from database
     * @return array
     */
	public function getDataForUtilizationReport()
	{
		$cols   = "F1.working_area_name as Department, F1.level_name as 'Level', F2.total as 'Total person', ROUND(F2.Utilization) AS Utilization";
		$table  = $this->buildTableForUtilizationReport();
		$order  = "F1.working_area_id, F1.level_id";

		$return = \DB::select("SELECT $cols FROM $table ORDER BY $order", array($this->utilization_report_timeline));
		return $return;
	}
	
    /**
     * buildTableForUtilizationReport function build table for query
     * @return string
     */
	private function buildTableForUtilizationReport()
	{
		$table =
			"(SELECT w.working_area_id, w.working_area_name, l.level_id, l.level_name
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
		return $table;
	}

	/**
	 * getCountTotal function support count total engineer for each department
	 * @return array
	 */
	public function getCountTotal()
	{
		$cols   = "F1.working_area_name AS Department, NULL AS 'Level', SUM(F2.total) AS 'Total person', ROUND(AVG(F2.Utilization)) AS Utilization";
		$table  = $this->buildTableForUtilizationReport();
		$group  = "F1.working_area_id";

		$return = \DB::select("SELECT $cols FROM $table GROUP BY $group", array($this->utilization_report_timeline));
		return $return;
	}

	/**
	 * megreArrayOutput function mix to output preview
	 * @return array
	 */
	public function megreArrayOutput()
	{
	    // array data
		$arrData       = $this->getDataForUtilizationReport();
		// array total engineer for each department
		$arrCountTotal = $this->getCountTotal();
		// mix array
		$arrOutput     = array_merge($arrData, $arrCountTotal);

		// sort order
		$this->sortArrayByColum($arrOutput, 'Department');

		return $arrOutput;
	}

	/**
	 * sortArrayByColum function support sort array output
	 * @param array $arr
	 * @param string $col
	 * @param string $order
	 * @return void
	 */
	private function sortArrayByColum(array &$arr, $col, $order = SORT_DESC)
	{
		$arrSortColumn = array();
		foreach ($arr as $key => $row) {
			$arrSortColumn[$key] = $row->{$col};
		}
		array_multisort($arrSortColumn, $order, $arr);
	}

	/**
	 * convForExport functoion support format for export to excel
	 * @param array $arrOutput
	 * @return array
	 */
	public function convForExport(array $arrOutput)
	{
		$arrReturn = array();
		foreach ($arrOutput as $key => $value) {
			$value->{'Total person'} = ($value->{'Total person'} > 0) ? $value->{'Total person'} : '0';
			$value->Utilization 	 = ($value->Utilization > 0) ? $value->Utilization.'%' : null;
			$arrReturn[$key] 		 = get_object_vars($value);
		}
		return $arrReturn;
	}

	/**
	 * doValidate function support check validate
	 * @return boolean
	 */
	public function doValidate()
	{
		$validate_flag = $this->validate(self::$rules);
		return $validate_flag;
	}

	/**
	 * doExport function export to excel file
	 * @return void
	 */
	public function doExport()
	{
		// get data
		$arrData  = $this->megreArrayOutput();
		// convert to export
		$arrData  = $this->convForExport($arrData);
		// array title
		$arrTitle = [array(\Lang::get('report.department'), \Lang::get('report.level'), \Lang::get('report.total'), \Lang::get('report.utilization'))];
		// merge with array title
		$arrData  = array_merge($arrTitle, $arrData);
		// Model
		$this->totalLevel = count(\Level::getLevels());
		$this->totalWorkingSkill = count(\WorkingSkill::getWorkingAreas());
		$model = $this;
		/*Export section*/
		\Excel::create('TCTAV_Utilization_Monthly_' . $model->utilization_report_timeline, function($excel) use ($arrData, $model) {
			// Set the title
			$excel->setTitle(\Lang::get('report.title_utilization'));
			// Chain the setters
			$excel->setCreator('HR')
				  ->setCompany('TAV');
			// Call them separately
			$excel->setDescription(\Lang::get('report.title_utilization'));

			$excel->sheet('Sheet 1', function($sheet) use ($arrData, $model) {
				// start row of  data
                $start_row = 7;
                $end_row   = $start_row + count($arrData);
				// megre cells
				$sheet->mergeCells('A1:F1');
				$sheet->mergeCells('B3:E3');

				// calculator for merge
				$start_megre = 9;
				$arrRowMerge = array();
				for ($i = 1; $i <= $model->totalWorkingSkill; $i++) {
					$arrRowMerge[] = array($start_megre, $start_megre + $model->totalLevel);
					$start_megre = $start_megre + $model->totalLevel + 1;
				}
				$sheet->setMergeColumn(array(
					'columns' 	=> array('A'),
					'rows'		=> $arrRowMerge
				));

				// set default value
				$sheet->row(1, array(
					'TRANSCOSMOS TECHNOLOGIC ARTS')
				);
				$sheet->row(3, array(
					'', \Lang::get('report.title_utilization'))
				);
				$sheet->row(5, array(
					\Lang::get('report.report_by'), $model->utilization_report_by, '', \Lang::get('report.report_to'), $model->utilization_report_to)
				);
				$sheet->row(6, array(
					\Lang::get('report.report_timeline'), $model->utilization_report_timeline, '', \Lang::get('report.submit_date'), $model->utilization_report_date)
				);

				// set width and heigth for sheet
				// points to inch
				// 1 inch = 13 pt
				$sheet->setWidth(array(
					'A' => 15,
					'C' => 14,
					'D' => 12,
					'E' => 13
				));
				// 1 inch = 64.2 pt
				$sheet->setHeight(array(
					1 => 18,
					3 => 17.85,
					5 => 17.85,
					6 => 17.85,
					8 => 17.85
					));
				
				// set freeze
				$sheet->setFreeze('A9');

				// style for sheet
				$sheet->cells('A1:F'.$end_row, function($cells) {
					$cells->setAlignment('center');
					$cells->setValignment('center');
					$cells->setFont(array(
						'family'     => 'Calibri',
						'size'       => '12',
					));
				});

				// style for details
				$sheet->cells('A5:A6', function($cells) {
					$cells->setAlignment('right');
				});
				$sheet->cells('D5:D6', function($cells) {
					$cells->setAlignment('right');
				});

				// style for header
				$sheet->cell('A1', function($cell) {
					$cell->setFont(array(
						'size'       => '16',
						'bold'       => true
					));
				});
				// style for sub header
				$sheet->cell('B3', function($cell) {
					$cell->setFont(array(
						'size'       => '14',
						'bold'       => true
					));
				});
				// style for header in table
				$sheet->cells('A8:D8', function($cells) {
					$cells->setFont(array(
						'size'       => '13',
						'bold'       => true
					));
				});
				
				// style for contents in table
				$sheet->cells('A9:A'.$end_row, function($cells) {
					$cells->setFont(array(
						'bold'       => true
					));
				});

				// set border
				$sheet->setBorder('A8:D'.$end_row, 'thin');

				// set data
				$sheet->fromArray($arrData, null, 'A8', false, false);
			});
		})->export('xls');
	}
}