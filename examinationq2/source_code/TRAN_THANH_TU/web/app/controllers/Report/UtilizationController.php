<?php namespace Report;
/**
 * class UtilizationController support monthly utilization report control
 * 
 * @author lqdung
 *
 */
class UtilizationController extends \BaseController {
	/**
	 * Utilization report model
	 * @var object
	 */
	protected $utilizationModel;
	
	/**
	 * _contruct function
	 */
	public function __construct()
	{
		$this->utilizationModel = new \UtilizationModel(\Input::all());
	}
	/**
	 * render view : index page
	 * @return HTML
	 */
	public function index()
	{
		return \View::make('report.utilization.utilization');
	}
	/**
	 * check month for report and load preview
	 * @return HTML
	 */
	public function postIndex()
	{
		if ($this->utilizationModel->doValidate()) {
			$arrData = $this->utilizationModel->megreArrayOutput();

			$utilization_report_date = date('d-m-Y');

			return \View::make('report.utilization.utilization')->with('arrData', $arrData)->with('utilization_report_date', $utilization_report_date);
		}
		return \Redirect::refresh()->withErrors($this->utilizationModel->validationErrors);
	}
	/**
	 * do export
	 * @return file download
	 */
	public function postExport()
	{
		if ($this->utilizationModel->doValidate()) {
			$this->utilizationModel->doExport();
		}
		return \Redirect::route('utilization-post')->withErrors($this->utilizationModel->validationErrors);
	}
}