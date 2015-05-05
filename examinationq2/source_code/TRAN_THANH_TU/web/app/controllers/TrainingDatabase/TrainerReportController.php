<?php namespace TrainingDatabase;

/**
* TrainerReportController
*/
class TrainerReportController extends \BaseController {

    private $trainerReport;

    public function __construct()
    {
        $this->trainerReport = new \TrainerReport(\Input::all());
    }

    /**
     * @author tttu
     * @name getTrainerListForView
     * @todo prepare array of trainers for select box
     * @return array
     */
    private function getTrainerListForView()
    {
        $arrTrainerListTmp = \TrainerManagement::all();
        $arrTrainerList = [];
        $arrTrainerList['all'] = 'All trainers';
        foreach($arrTrainerListTmp as $item)
        {
            $arrTrainerList[$item->trainer_id] = $item->trainer_name;
        }
        return $arrTrainerList;
    }
    
    /**
     * @author Nguyen Trieu
     * @name index seach 
     * @return Response
     */
    public function index()
    {
        $arrTrainerList = $this->getTrainerListForView();
        return \View::make('training_database.report.trainer_report')->with(compact('arrTrainerList'));
    }

    /**
     * @author Nguyen Trieu
     * @name postIndex get list export
     * @return Response
     */
    public function postIndex()
    {
        // check validate
        $validate = $this->trainerReport->doValidate();
        if($validate === false)
        {
            return \Redirect::refresh()->withErrors($this->trainerReport->errors());
        }

        $date_from = \Input::get('date_from');
        $date_to = \Input::get('date_to');
        $arrTrainerList = $this->getTrainerListForView();
        $trainer_id = \Input::get('trainer_id');
        $arrData = [
            'report_date' => date('d-m-Y'),
            'date_from' => $date_from,
            'date_to' => $date_to,
            'reportLists' => $this->trainerReport->getList(date('Y-m-d', strtotime($date_from)), date('Y-m-d', strtotime($date_to)), trim(\Input::get('trainer_id'))),
            'arrTrainerList' => $arrTrainerList,
            'trainer_id' => $trainer_id
        ];

        return \View::make('training_database.report.trainer_report', $arrData);
    }

    /**
     * @author Nguyen Trieu
     * @name doExport export to excell file
     * @return Response
     */
    public function doExport()
    {
        // check validate
        $validate = $this->trainerReport->doValidate();
        if($validate === false)
        {
            return \Redirect::route('general-report')->withErrors($this->trainerReport->errors());
        }
        // export file
        $this->trainerReport->doExport();
    }
}