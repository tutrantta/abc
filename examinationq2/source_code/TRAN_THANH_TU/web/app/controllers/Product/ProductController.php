<?php
/**
 * Product Controller
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-05-06          tttu               Create File
 */

namespace Product;

class ProductController extends \BaseController {

    protected $productModel;

    public function __construct(\ProductModel $product)
    {
        $this->productModel = $product;
    }
    /**
     * @author tttu
     * @name index
     * @return Response
     */
    public function getList()
    {
        return \View::make('product.index');
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