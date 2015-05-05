<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	/**
     * @author NgocNguyen
     * @name getErrors
     * @todo Show custom error
     * @return Response
     */
	public function getErrors($code,$message){
		$data = $message->getMessage();
		switch ($code) {
			case 404:
				return View::make('errors.404');
				break;
			case 403:
				return View::make('errors.403');
				break;
			case 500:
				return View::make('errors.500');
				break;
			case 'errors_common':
				return View::make('errors.default',compact('data'));
				break;		
			default:
				break;
		}
	}

}
