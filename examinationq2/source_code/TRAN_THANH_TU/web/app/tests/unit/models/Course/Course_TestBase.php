<?php
/**
 * Course_TestBase
 * set up data for test
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-16          tttu               Create File
 * 2015-04-27          tttu               Modify
 */
namespace models;

class Course_TestBase extends \Codeception\TestCase\Test {

    public $arrCourse 				= array();
    public $arrArea 				= array();
    public $arrClass                = array();

    protected function _before()
    {
        parent::_before();
        //define constant
        if(!defined('COURSE_NOT_EXIST_ERROR'))
        {
            define('COURSE_NOT_EXIST_ERROR', 'Course does not exist');
        }
        if(!defined('COURSE_HAD_CLASS_ERROR'))
        {
            define('COURSE_HAD_CLASS_ERROR', 'There have been classes belonging to this course. Only description could be changed.');
        }
        if(!defined('AREA_NOT_EXIST_ERROR'))
        {
            define('AREA_NOT_EXIST_ERROR', 'Area does not exist');
        }
        if(!defined('UNIQUE_AREA_COURSE_ERROR'))
        {
                define('UNIQUE_AREA_COURSE_ERROR', 'The course name in this area already exists');
        }

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->course = new \Course();
    }

    protected function _after()
    {
        parent::_after();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function setUpArea($number)
    {
        \DB::table('areas')->delete();

        for ($i = 1; $i < $number; $i++) {
            $this->arrArea[] = [
                'area_id'	=> $i,
                'area_name' => 'Technical Area '.$i,
                'is_active'		=> 1
            ];
        }
        foreach ($this->arrArea as $value) {
            \DB::table('areas')->insert($value);
        }
    }

    public function setUpCourse()
    {
        \DB::table('courses')->delete();
        $this->arrCourse = [
            'course_id'     => 1,
            'area_id'       => 1,
            'course_name'   => 'Course 1',
            'description'   => 'This is the description'
        ];
        \DB::table('courses')->insert($this->arrCourse);
    }

    public function setUpClass()
    {
        \DB::table('classes')->delete();
        $this->arrClass = [
            'class_id'  => 1,
            'course_id' => 1,
            'class_name'=> 'Class Name 1',
            'date'      => '2015-04-16',
        ];
        \DB::table('classes')->insert($this->arrClass);
    }

    public function setUpCourseWithOutClass()
    {
        $courseData = [
            'course_id'   => 2,
            'area_id'     => 2,
            'description' => '1234567891',
            'course_name' => 'Course 3',
        ];
        \DB::table('courses')->insert($courseData);
    }
}

