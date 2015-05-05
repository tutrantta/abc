<?php

/**
 * TechReport Controller
 * @author Tung Ly
 */
namespace Report;

class TechReportController extends \BaseController {
    /**
     * TechMatrixModel report model
     * @var object
     */
    protected $TechMatrixModel;
    
    /**
     * _contruct function
     */
    public function __construct()
    {
        $this->TechMatrixModel = new \TechnicalReport(\Input::all());
    }
    /**
     *
     * @author Tung Ly
     */
    public function getIndex()
    {
        return \View::make('report.tech.index');
    }

    /**
    * 
    * @author Dung Le
    */
    public function postIndex()
    {
        if ($this->TechMatrixModel->doValidate()) {
            $export_month   = \Input::get('tech_report_timeline');
            $levels         = \Level::getLevels();
            $result         = \TechnicalReport::getTechReportData($export_month);
            $arrData        = array();
            if (count($result)) {
                foreach ($result as $row) {
                    $arrData[$row->technique_id]["Technique"] = $row->technique_name;
                    $arrData[$row->technique_id][$row->level_id] = ($row->ratio == null) ? "0.00 %" : $row->ratio ." %";
                }
            }
            $tech_report_date = date('d-m-Y');
            return \View::make('report.tech.index')->with('levels', $levels)->with('arrData', $arrData)->with('tech_report_date', $tech_report_date);
        }
        return \Redirect::refresh()->withErrors($this->TechMatrixModel->validationErrors);
        
    }
    /**
     *
     * @author Tung Ly
     * @update Dung Le
     */
    public function postExportExcel()
    {
        if ($this->TechMatrixModel->doValidate()) {
            $this->TechMatrixModel->doExport();
        }
        return \Redirect::route('techtical-matrix-index')->withErrors($this->TechMatrixModel->validationErrors);
    }

}
