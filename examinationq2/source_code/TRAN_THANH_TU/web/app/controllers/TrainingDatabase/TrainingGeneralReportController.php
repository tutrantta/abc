<?php namespace TrainingDatabase;

/**
* TrainingGeneralReportController
*/
class TrainingGeneralReportController extends \BaseController {

    private $trainingGeneralReport;

    public function __construct()
    {
        $this->trainingGeneralReport = new \TrainingGeneralReport(\Input::all());
    }
    
    /**
     * @author Nguyen Trieu
     * @name index seach 
     * @return Response
     */
    public function index()
    {
        return \View::make('training_database.report.general_report');
    }

    /**
     * @author Nguyen Trieu
     * @name postIndex get list export
     * @return Response
     */
    public function postIndex()
    {
        // check validate
        $validate = $this->trainingGeneralReport->doValidate();
        if($validate === false)
        {
            return \Redirect::refresh()->withErrors($this->trainingGeneralReport->errors());
        }

        $date_from = \Input::get('date_from');
        $date_to = \Input::get('date_to');
        $arrData = [
            'report_date' => date('d-m-Y'),
            'date_from' => $date_from,
            'date_to' => $date_to,
            'reportLists' => $this->trainingGeneralReport->getList(date('Y-m-d', strtotime($date_from)), date('Y-m-d', strtotime($date_to)))
        ];
        return \View::make('training_database.report.general_report', $arrData);
    }

    /**
     * @author Nguyen Trieu
     * @name doExport export to excell file
     * @return Response
     */
    public function doExport()
    {
        // check validate
        $validate = $this->trainingGeneralReport->doValidate();
        if($validate === false)
        {
            return \Redirect::route('general-report')->withErrors($this->trainingGeneralReport->errors());
        }
        // export file
        $this->trainingGeneralReport->doExport();
    }
}