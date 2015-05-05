<?php
/**
 * Course Controller
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-15          tttu       Create File
 * 2015-04-27..........tttu.......Modify
 */

namespace TrainingDatabase;

class CourseController extends \BaseController {

	protected $courseModel;

	public function __construct(\Course $course)
	{
		$this->courseModel = $course;
	}

	/**
	 * @author tttu
	 * @name getAreaListForView
	 * @todo prepare array of areas for select box
	 * @return array
	 */
	private function getAreaListForView()
	{
		$arrAreaListTmp = \Area::all();
		$arrAreaList = [];
		$arrAreaList[] = 'Please select area';
		foreach($arrAreaListTmp as $item)
		{
			$arrAreaList[$item->area_id] = $item->area_name;
		}
		return $arrAreaList;
	}

	/**
     * @author tttu
     * @name index
     * @todo Show list course
     * @return Response
     */
	public function index()
	{
	    return \View::make('training_database.course.index');
	}

	/**
	 * @author tttu
	 * @name getList
	 * @todo Get list ajax
	 * @return json
	 */
	public function getList()
	{
		$columns = ['course_name', 'area_name', 'description'];

		$params = \Datatable::request($columns, 'created_at', 'desc');
		// get data
		$courseList = $this->courseModel->getCourseList($params);
		$total = $courseList['count'];

		$courseOutputList = array();
		// create data for row on datatables
		foreach ($courseList['data'] as $rows)
		{
			$dataRow = array();
			$dataRow['course_name'] = $rows->course_name;
			$dataRow['area_name'] = $rows->area_name;
			$dataRow['description'] = $rows->description;
			$dataRow['action'] = '<a href="course/detail/'.$rows->course_id.'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a>';
			$courseOutputList[] = $dataRow;
		}

		return \Datatable::output($courseOutputList, $total);
	}

	/**
	 * @author tttu
	 * @name showCourseDetail
	 * @todo show detail of a specific course
	 * @return Response
	 */
	public function showCourseDetail($course_id)
	{
		//fetch from database
		$course = $this->courseModel->getCourseDetailById($course_id);

		//if no data found, return 404
		if(empty($course))
		{
			return \App::abort(404);
		}

		//else if have data, return view, with data
		$arrAreaList = $this->getAreaListForView();

		if(\Helper::checkExist($course_id, 'course_id', 'classes'))
		{
			return \View::make('training_database.course.edit')->with(compact('arrAreaList'))->with('course', $course[0])->with('has_class', true);
		}
		return \View::make('training_database.course.edit')->with(compact('arrAreaList'))->with('course', $course[0]);
	}

	/**
	 * @author tttu
	 * @name createCourse
	 * @todo create a new course
	 * @return Response
	 */
	public function createCourse()
	{
		//if request method is GET, make View
		if(\Request::isMethod('get'))
		{
			$arrAreaList = $this->getAreaListForView();
			return \View::make('training_database.course.create')->with(compact('arrAreaList'));
		}
		//check validate
		$validate = $this->courseModel->checkValidation(\Input::get('area_id'), trim(\Input::get('course_name')));

		if($validate !== true)
		{
			return \Redirect::refresh()->withErrors($validate)->withInput();
		}

		if(! $this->courseModel->saveCourse())
		{
			return \Redirect::refresh()->withErrors($this->courseModel->errors())->withInput();
		}

		return \Redirect::route('course-list')->withFlashMessage('New course has been created successfully!');
	}

	/**
	 * @author tttu
	 * @name editCourse
	 * @todo edit course
	 * @return Response
	 */
	public function editCourse($course_id)
	{
		//check validate
		$validate = $this->courseModel->checkValidation(trim(\Input::get('area_id')), trim(\Input::get('course_name')), $course_id);
		if($validate !== true)
		{
			return \Redirect::refresh()->withErrors($validate)->withInput();
		}

		$updateResult = $this->courseModel->updateCourse($course_id);
		if($updateResult !== true)
		{
			return \Redirect::refresh()->withErrors($updateResult->errors())->withInput();
		}

		return \Redirect::route('course-list')->withFlashMessage('Course updated successfully!');
	}
}
