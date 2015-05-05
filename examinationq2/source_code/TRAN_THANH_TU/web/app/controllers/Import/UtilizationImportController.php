<?php
/**
 * Utilization Import Controller
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-06          Tran Thanh Tu      Create File
 */

namespace Import;
use Maatwebsite\Excel\Facades\Excel;

class UtilizationImportController extends \BaseController {

    protected $utilizationImportModel;

    public function __construct(\UtilizationImport $utilizationImport)
    {
        $this->utilizationImportModel = $utilizationImport;
    }
    /**
     * @author Tran Thanh Tu
     * @name index
     * @todo
     * @return Response
     */
    public function index()
    {
        return \View::make('import.utilization.index');
    }

    /**
     * @author Tran Thanh Tu
     * @name import
     * @todo
     * @return Response
     */
    public function import()
    {
        //validate file and import date
        $validator = $this->utilizationImportModel->validateFileAndImportDate(\Input::all());
        if($validator !== true) {
            return \Redirect::route('import-utilization')->withErrors($validator)->withInput();
        }

        //if user choose not to overwrite and have existing value
        if(! \Input::has('overwrite') && $this->utilizationImportModel->hasExistingImport(\Input::get('import_date'))) {
            return \Redirect::route('import-utilization')->withErrors('This month has already been imported before!')->withInput();
        }

        //convert xls into array
        $file = \Input::file('file');
        $filePath = $file->getRealPath();
        $data = \Excel::load($filePath, function($reader) {
        })->toArray();

        //and pass to model
        $arrResult = $this->utilizationImportModel->insert($data, \Input::get('import_date'));
//        dd($arrResult);

        //handle error and success message
        $arrErrorMessage = ['There are ' . $arrResult['numberOfError'] . ' rows failed to import!'];
        $arrErrorMessage[] = "These rows are: " . implode(', ', $arrResult['arrErrorRows']);

        //if both success and failed
        if($arrResult['numberOfSuccess'] && $arrResult['numberOfError']) {
            return \Redirect::route('import-utilization')->withErrors($arrErrorMessage)
                ->withFlashMessage($arrResult['numberOfSuccess'] .  " rows successfully imported!")->withInput();
        }

        //if all failed
        else if($arrResult['numberOfError']) {
            return \Redirect::route('import-utilization')->withErrors($arrErrorMessage)->withInput();
        }

        //if all success
        else {
            return \Redirect::route('import-utilization')->withFlashMessage('Successfully Imported!');
        }
    }
}