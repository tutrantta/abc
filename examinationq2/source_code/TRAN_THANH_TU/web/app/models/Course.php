<?php

/**
 * Course Model
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-15          tvhieu     Create File
 * 2015-04-15          tttu       Modify
 * 2015-04-27          tttu       Modify
 */
class Course extends BaseModel {

    protected $courseTable = 'courses';
    protected $areaTable = 'areas';
    protected $primaryKey = 'course_id';
    protected $table = 'courses';

    protected $fillable = [
        'course_id',
        'course_name',
        'area_id',
        'description',
    ];
    public static $rules = [
        'course_name' => 'required|max:100',
        'area_id' => 'required',
    ];


    /**
     * @author tttu
     * @name getCourseIdByCourseNameAndAreaId
     * @todo get course_id from database by course_name and area_id
     * @return array
     */
    private function getCourseIdByCourseNameAndAreaId($area_id, $course_name)
    {
        $query = \DB::table($this->courseTable)->select('course_id')->where('course_name', $course_name)
            ->where('area_id', $area_id);
        $data = $query->get();
        if(empty($data)) return false;
        return $data[0]->course_id;
    }

    /**
     * @author tttu
     * @name getCourseList
     * @todo get list of courses from database
     * @return array
     */
    public function getCourseList($params = [])
    {
        $query = \DB::table($this->courseTable)->leftJoin($this->areaTable, function($join)
        {
            $join->on('courses.area_id', '=', 'areas.area_id');

        })
            ->select('courses.*', 'areas.area_name');
        // search
        $query->where('courses.course_name', 'like', '%' . $params['search'] . '%');
        $query->orWhere('courses.description', 'like', '%' . $params['search'] . '%');
        $query->orWhere('areas.area_name', 'like', '%' . $params['search'] . '%');
        // count all
        $count = $query->count();
        // build query limit
        $query->skip($params['offset']);
        $query->take($params['limit']);
        // build query orderby
        $query->orderBy($params['order'], $params['sort']);
        // get all data
        $data = $query->get();
        // return data
        return ['data' => $data, 'count' => $count];
    }

    /**
     * @author tttu
     * @name getCourseDetailById
     * @todo get course detail by course_id
     * @return array
     */
    public function getCourseDetailById($course_id)
    {
        $query = \DB::table($this->courseTable)->leftJoin($this->areaTable, function($join) {
            $join->on('courses.area_id', '=', 'areas.area_id');
        })->select('courses.*', 'areas.area_name')->where('courses.course_id', $course_id);
        $data = $query->get();
        return $data;
    }

    /**
     * @author tttu
     * @name checkValidation
     * @todo validate if area_id exists, pair of area_id and course_name is unique
     * @return mixed
     */
    public function checkValidation($area_id, $course_name, $course_id = null)
    {
        //if course does not exist when updating
        if($course_id !== null && !\Helper::checkExist($course_id, 'course_id', $this->courseTable))
        {
            return 'Course does not exist';
        }

        //if area_id does not exist
        if(!\Helper::checkExist($area_id, 'area_id', $this->areaTable))
        {
            return 'Area does not exist';
        }

        if($course_id !== null)
        {
            $courseDetail = $this->getCourseDetailById($course_id);
            $currentCourseName = $courseDetail[0]->course_name;
            $currentAreaId = $courseDetail[0]->area_id;
        }

        //if course already had classes and users try to edit course_name or area_id
        if($course_id !== null && \Helper::checkExist($course_id, 'course_id', 'classes') && ($course_name != $currentCourseName || $area_id != $currentAreaId))
        {
            return 'There have been classes belonging to this course. Only description could be changed.';
        }

        //if area_id and course_name already exist in database
        $tmpCourseId = $this->getCourseIdByCourseNameAndAreaId($area_id, $course_name);
        if($tmpCourseId && ($course_id === null || $tmpCourseId != $course_id))
        {
            return 'The course name in this area already exists';
        }

        return true;
    }

    /**
     * @author tttu
     * @name saveCourse
     * @todo insert new course into database using Ardent
     * @return boolean
     */
    public function saveCourse()
    {
        return $this->save();
    }

    /**
     * @author tttu
     * @name updateCourse
     * @todo update a course
     * @return boolean
     */
    public function updateCourse($course_id)
    {
        $tmpCourse = $this->find($course_id);

        if($tmpCourse->save()) return true;
        return $tmpCourse;
    }
}
