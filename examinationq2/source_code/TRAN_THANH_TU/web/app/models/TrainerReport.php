<?php
/**
* 
*/
class TrainerReport extends BaseModel
{
    /**
     * variable for mass assignment
     * @var array
     */
    public $fillable = [
        'date_from',
        'date_to',
        'report_by',
        'report_to',
        'report_date',
        'trainer_id'
    ];
    public static $rules = [
        'date_from'=>'required|date_format:d-m-Y|before:date_to',
        'date_to'=>'required|date_format:d-m-Y',
        'report_date' => 'date_format:d-m-Y'
    ];

    /**
    * getList
    * @param date $date_from
    * @param date $date_to
     *
    * @return object 
    */
    public function getList($date_from, $date_to, $trainer_id = 'all')
    {
        $sql = "
            SELECT trainers.trainer_name AS full_name, courses.course_name AS course, areas.area_name AS area,
                SUM(classes.duration) AS duration
            FROM courses 
                    JOIN areas ON courses.area_id = areas.area_id
                    right JOIN classes ON classes.course_id = courses.course_id
                    left JOIN trainers ON trainers.trainer_id = classes.trainer_id
            WHERE
                classes.date >= ? AND classes.date <= ? ";

        if($trainer_id != 'all')
        {
            $sql .= " AND trainers.trainer_id = ?";
            $arrInputData = [$date_from, $date_to, $trainer_id];
        }
        else
        {
            $arrInputData = [$date_from, $date_to];
        }

        $sql .= "
            GROUP BY
                courses.course_id,
                areas.area_id,
                trainers.trainer_id
        ";
        $query = \DB::select($sql, $arrInputData);
        return $query;
    }

    /**
     * convToOutput functoion support format for export to excel
     * @param array $arrData
     * @return array
     */
    private function convToOutput($data)
    {
        $arrRet = array();
        $course = 0;
        $area = 0;
        $duration = 0;
        $arrCourse = array();
        $arrArea = array();

        foreach ($data as $key => $value) {
            $arrRet[$key] = get_object_vars($value);
            $arrCourse[]  = $value->course;
            $arrArea[]    = $value->area;
            $duration    += $value->duration;
        }

        $course   = count(array_unique($arrCourse, SORT_STRING));
        $area     = count(array_unique($arrArea, SORT_STRING));
        $arrTotal = [['Total', strval($course), strval($area), strval($duration)]];
        $arrRet   = array_merge($arrRet, $arrTotal);
        return $arrRet;
    }

    /**
     * doExport function export to excel file
     * @return void
     */
    public function doExport()
    {
        // conv date
        $date_from = date('Y-m-d', strtotime($this->date_from));
        $date_to   = date('Y-m-d', strtotime($this->date_to));
        // get data
        $arrData  = $this->getList($date_from, $date_to, $this->trainer_id);
        $arrData  = $this->convToOutput($arrData);
        // array title
        $arrTitle = [['Trainer', 'Course', 'Area', 'Duration (hrs)']];
        // merge with array title
        $arrData  = array_merge($arrTitle, $arrData);
        // Model
        $model    = $this;
        $model->total_column = count($arrTitle[0]);
        /*Export section*/
        \Excel::create('TCTAV_Monthly_Trainer_' . $model->date_from.'_'.$model->date_to, function($excel) use ($arrData, $model) {
            // Set the title
            $excel->setTitle('TRANSCOSMOS TECHNOLOGIC ARTS');
            // Chain the setters
            $excel->setCreator('HR')
                  ->setCompany('TAV');
            // Call them separately
            $excel->setDescription('TRANSCOSMOS TECHNOLOGIC ARTS');

            $excel->sheet('Sheet 1', function($sheet) use ($arrData, $model) {
                // start row of  data
                $start_row = 7;
                $end_row   = $start_row + count($arrData);
                $start_col = 'A';
                $end_col   = chr(ord($start_col) + $model->total_column - 1);
                $end_cel   = $end_col.$end_row;

                // megre cells
                $sheet->mergeCells('A1:E1');
                $sheet->mergeCells('B3:D3');

                // set default value
                $sheet->row(1, array(
                    'TRANSCOSMOS TECHNOLOGIC ARTS')
                );
                $sheet->row(3, array(
                    '', 'MONTHLY COMPANY TRAINING PROGRAM REPORT')
                );
                $sheet->row(5, array(
                    \Lang::get('report.report_by'), $model->report_by, '', \Lang::get('report.report_to'), $model->report_to)
                );
                $sheet->row(6, array(
                    \Lang::get('report.report_timeline'), $model->date_from.' ~ '.$model->date_to, '', \Lang::get('report.submit_date'), $model->report_date)
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

                // style for sheet
                $sheet->cells('A1:E'.$end_row, function($cells) {
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
                $sheet->cells('A8:'.$end_col.'8', function($cells) {
                    $cells->setFont(array(
                        'size'       => '13',
                        'bold'       => true
                    ));
                });
                
                // set border
                $sheet->setBorder('A8:'.$end_cel, 'thin');

                // set data
                $sheet->fromArray($arrData, null, 'A8', false, false);
            });
        })->export('xls');
    }

   /**
     * doValidate function support check validate
     * @return boolean
     */
    public function doValidate()
    {
        return $this->validate(self::$rules);
    }
}