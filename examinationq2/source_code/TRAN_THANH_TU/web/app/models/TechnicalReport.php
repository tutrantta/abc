<?php

class TechnicalReport extends \BaseModel {
    /**
     * variable for mass assignment
     * @var array
     */
    public $fillable = [
        'tech_report_timeline',
        'tech_report_by',
        'tech_report_to',
        'tech_report_date'
    ];
    
    /**
     * variable for validate
     * @var array
     */
    public static $rules = [
        'tech_report_timeline' => 'required|date_format:m-Y|between:7,7',
        'tech_report_date'     => 'date_format:d-m-Y'
    ];

    /**
     * getTechReportData function support get tech list
     * @param string $month
     * @return array
     */
    public static function getTechReportData($month)
    {
        $sql = "SELECT
                  t.technique_id, l.level_id, t.technique_name, l.level_name,
                  (SELECT COUNT(engineer_id) FROM engineers) AS eamount,
                  (SELECT ROUND(COUNT(engineer_id)/eamount*100,2) AS ratio
                   FROM engineer_technique_level_history AS etlh
                     WHERE
                       t.technique_id = etlh.technique_id AND l.level_id = etlh.level_id
                       AND DATE_FORMAT(etlh.updated_time, '%m-%Y') = ?
                       
                       GROUP BY t.technique_id, l.level_id
                   ) AS ratio
                FROM techniques AS t
                JOIN levels AS l ON 1=1 WHERE t.is_active = 1 AND l.is_active = 1
                ORDER BY level_name, technique_name";
        $result = \DB::select($sql, array($month));
        return $result;
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
     * doExport function support export to excel
     * @return void
     */
    public function doExport()
    {
        $result = \TechnicalReport::getTechReportData($this->tech_report_timeline);

        $dataResult = array();
        if (count($result)) {
            foreach ($result as $row) {
                $data[$row->technique_name]["Technique"] = $row->technique_name;
                $data[$row->technique_name][$row->level_name] = ($row->ratio == null) ? "0.00 %" : $row->ratio . " %";
                ;
            }
            $levels = \Level::getLevels();

            $i = 0;

            $dataResult[$i][] = \Lang::get('report.tech_level');
            
            foreach ($levels as $level) {
                $dataResult[$i][] = $level->level_name;
            }
            
            foreach ($data as $row) {
                $i ++;
                foreach ($row as $col) {
                    $dataResult[$i][] = $col;
                }
            }
        }
        $this->totalLevel = count($levels);
        $model = $this;

        \Excel::create('TCTAV_TechMatrixReport_' . $this->tech_report_timeline, function($excel) use ($dataResult, $model) {
            // Set the title
            $excel->setTitle(\Lang::get('report.title_techmatrix'));
            // Chain the setters
            $excel->setCreator('HR')
                  ->setCompany('TAV');

            // Call them separately
            $excel->setDescription(\Lang::get('report.title_techmatrix'));

            $excel->sheet('Sheet 1', function ($sheet) use($dataResult, $model) {
                // megre cells
                $sheet->mergeCells('A1:I1');
                $sheet->mergeCells('B3:H3');

                // set default value
                $sheet->row(1, array(
                    'TRANSCOSMOS TECHNOLOGIC ARTS')
                );
                $sheet->row(3, array(
                    '', \Lang::get('report.title_techmatrix'))
                );
                $sheet->row(5, array(
                    \Lang::get('report.report_by'), $model->tech_report_by, '', '', \Lang::get('report.report_to'), $model->tech_report_to)
                );
                $sheet->row(6, array(
                    \Lang::get('report.report_timeline'), $model->tech_report_timeline, '', '', \Lang::get('report.submit_date'), $model->tech_report_date)
                );

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
                // start row
                $start_row = 7;
                $start_col = 'A';
                $end_row   = $start_row + count($dataResult);
                $end_col   = chr(ord($start_col) + $model->totalLevel);
                $end_cel   = $end_col.$end_row;

                // style for sheet
                $sheet->cells('A1:'.$end_cel, function($cells) {
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
                $sheet->cells('E5:E6', function($cells) {
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
                $sheet->cells('A8:'.$end_col.'8', function($cells) {
                    $cells->setFont(array(
                        'size'       => '13',
                        'bold'       => true
                    ));
                });
                // set border
                $sheet->setBorder('A8:'.$end_cel, 'thin');

                $sheet->fromArray($dataResult, null, 'A8', false, false);
            });
        })->export('xls');
    }
}