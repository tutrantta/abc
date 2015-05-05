<?php
/**
 * Test Course Model
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-16          tttu               Create File
 * 2015-04-27          tttu               Modify
 *
 *
 * To Do List
 * 1. function getCourseList should return all items in database
 * 2. function getCourseList should return empty if there is no item in database
 * 3. function getCourseDetailById should return detail when course_id is found
 * 4. function getCourseDetailById should return empty when course_id is not found
 * 5. function checkValidation should return error message when course_id does not exist and method is update
 * 6. function checkValidation should return error message when course already had classes and course_name is changed
 * 7. function checkValidation should return error message when area_id does not exist
 * 8. function checkValidation should return error message when pair of area_id and course_name already exist in database
 *    and course_id is different to update course_id
 * 9. function checkValidation should return true when pair of area_id and course_name already exist in database
 *    and course_id is equal to update course_id
 * 10. function checkValidation should return true when pair of area_id and course_name does not exist in database and method is update
 * 11. function checkValidation should return true when pair of area_id and course_name does not exist in database and method is insert
 * 12. function checkValidation should return error message when pair of area_id and course_name already exist in database and method is insert
 * 13. function saveCourse should return false when course_name is empty
 * 14. function saveCourse should return false when course_name has more than 100 characters
 * 15. function saveCourse should return false when area_id is empty
 * 16. function saveCourse should return true when course insert successfully
 * 17. function updateCourse should return object with error when course_name is empty
 * 18. function updateCourse should return object with error when course_name has more than 100 characters
 * 19. function updateCourse should return object with error when area_id is empty
 * 20. function updateCourse should return true when course (without class) update successfully
 * 21. function checkValidation should return error message when course already had classes and area_id is changed
 * 22. function checkValidation should return true when course already had classes and area_id and course_name is not changed
 * 23. function updateCourse should return true when course (with class) update successfully
 */
namespace models;

require_once 'Course_TestBase.php';

class CourseTest extends Course_TestBase
{
    protected $number = 10;
    protected $course;
    protected $courseData = [
        'course_id'   => 1,
        'area_id'     => 1,
        'description' => '1234567891',
        'course_name' => 'Course 2',
    ];
    protected $expectedData = [
        'course_id'   => 1,
        'area_id'     => 1,
        'description' => '1234567891',
        'course_name' => 'Course 2',
        'area_name'   => 'Technical Area 1',
        'created_at'  => '0000-00-00 00:00:00',
        'updated_at'  => '0000-00-00 00:00:00'
    ];

    protected $params = array(
    'offset'        => 0,
    'limit'         => 10,
    'order'         => 'course_id',
    'sort'          => 'ASC',
    'search'        => null
    );

    protected function _before()
    {
        parent::_before();
        //Delete data
        \DB::table('courses')->delete();

        //Insert data
        $this->setUpArea($this->number);
        \DB::table('courses')->insert($this->courseData);
        $this->setUpClass();
        $this->course = new \Course();
    }

    protected function _after()
    {
        parent::_after();
    }

    // 1. function getCourseList should return all items in database
    public function testGetCourseListShouldReturnAllItems()
    {
        //GIVEN
        $expected = [
            'data'  => $this->expectedData,
            'count' => 1
        ];

        //WHEN
        $result = $this->course->getCourseList($this->params);
        $actual['data'] = get_object_vars($result['data'][0]);
        $actual['count'] = $result['count'];

        //THEN
        $this->assertEquals($expected, $actual);
    }

    // 2. function getCourseList should return empty if there is no item in database
    public function testGetCourseListShouldReturnEmptyWhenNoItemInDatabase()
    {
        //GIVEN
        \DB::table('courses')->delete();
        $expected = [
            'data'  => [],
            'count' => 0
        ];

        //WHEN
        $actual = $this->course->getCourseList($this->params);

        //THEN
        $this->assertEquals($expected, $actual);
    }

    // 3. function getCourseDetailById should return detail when course_id is found
    public function testGetCourseDetailByIdShouldReturnDetailWhenIdIsFound()
    {
        //GIVEN

        //WHEN
        $result = $this->course->getCourseDetailById(1);
        $actual = get_object_vars($result[0]);

        //THEN
        $this->assertEquals($this->expectedData, $actual);
    }

    // 4. function getCourseDetailById should return empty when course_id is not found
    public function testGetCourseDetailByIdShouldReturnEmptyWhenIdIsNotFound()
    {
        //GIVEN

        //WHEN
        $actual = $this->course->getCourseDetailById(1000);

        //THEN
        $this->assertEmpty($actual);
    }

    // 5. function checkValidation should return error message when course_id does not exist and method is update
    public function testCheckValidationShouldReturnErrorMessageWhenCourseIdNotExistMethodUpdate()
    {
        //GIVEN
        $course_id = 1000;
        $area_id = 1;
        $course_name = 'Course name';

        //WHEN
        $actual = $this->course->checkValidation($area_id, $course_name, $course_id);

        //THEN
        $this->assertEquals(COURSE_NOT_EXIST_ERROR, $actual);
    }

    // 6. function checkValidation should return error message when course already had classes and course_name is changed
    public function testCheckValidationShouldReturnErrorMessageWhenCourseHadClassesAndCourseNameIsChanged()
    {
        //GIVEN
        $course_id = 1;
        $area_id = 1;
        $course_name = 'Course Changed';

        //WHEN
        $actual = $this->course->checkValidation($area_id, $course_name, $course_id);

        //THEN
        $this->assertEquals(COURSE_HAD_CLASS_ERROR, $actual);
    }

    // 7. function checkValidation should return error message when area_id does not exist
    public function testCheckValidationShouldReturnErrorMessageWhenAreaNotExist()
    {
        //GIVEN
        $course_id = null;
        $area_id = 1000;
        $course_name = 'Course name';

        //WHEN
        $actual = $this->course->checkValidation($area_id, $course_name, $course_id);

        //THEN
        $this->assertEquals(AREA_NOT_EXIST_ERROR, $actual);
    }

    // 8. function checkValidation should return error message when pair of area_id and course_name already exist in database
    //    and course_id is different to update course_id
    public function testCheckValidationShouldReturnErrorMessageWhenPairAreaAndCourseExistAndCourseIdDifferentToUpdateId()
    {
        //GIVEN
        $this->setUpCourseWithOutClass();
        $course_id = 2;
        $area_id = 1;
        $course_name = 'Course 2';

        //WHEN
        $actual = $this->course->checkValidation($area_id, $course_name, $course_id);

        //THEN
        $this->assertEquals(UNIQUE_AREA_COURSE_ERROR, $actual);
    }

    //9. function checkValidation should return true when pair of area_id and course_name already exist in database
    //   and course_id is equal to update course_id
    public function testCheckValidationShouldReturnTrueWhenPairAreaAndCourseExistAndCourseIdEqualToUpdateId()
    {
        //GIVEN
        $this->setUpCourseWithOutClass();
        $course_id = 2;
        $area_id = 2;
        $course_name = 'Course 3';

        //WHEN
        $actual = $this->course->checkValidation($area_id, $course_name, $course_id);

        //THEN
        $this->assertTrue($actual);
    }

    // 10. function checkValidation should return true when pair of area_id and course_name does not exist in database and method is update
    public function testCheckValidationShouldReturnTrueWhenPairAreaAndCourseNotExistMethodUpdate()
    {
        //GIVEN
        $this->setUpCourseWithOutClass();
        $course_id = 2;
        $area_id = 1;
        $course_name = 'Course Not Exist';

        //WHEN
        $actual = $this->course->checkValidation($area_id, $course_name, $course_id);

        //THEN
        $this->assertTrue($actual);
    }

    // 11. function checkValidation should return true when pair of area_id and course_name does not exist in database and method is insert
    public function testCheckValidationShouldReturnTrueWhenPairAreaAndCourseNotExistMethodInsert()
    {
        //GIVEN
        $course_id = null;
        $area_id = 1;
        $course_name = 'Course Not Exist';

        //WHEN
        $actual = $this->course->checkValidation($area_id, $course_name, $course_id);

        //THEN
        $this->assertTrue($actual);
    }

    // 12. function checkValidation should return error message when pair of area_id and course_name already exist in database and method is insert
    public function testCheckValidationShouldReturnErrorMessageWhenPairAreaAndCourseExistMethodInsert()
    {
        //GIVEN
        $course_id = null;
        $area_id = 1;
        $course_name = 'Course 2';

        //WHEN
        $actual = $this->course->checkValidation($area_id, $course_name, $course_id);

        //THEN
        $this->assertEquals(UNIQUE_AREA_COURSE_ERROR, $actual);
    }

    // 13. function saveCourse should return false when course_name is empty
    public function testSaveCourseShouldReturnFalseWhenCourseNameIsEmpty()
    {
        // GIVEN
        $expected = array('The course name field is required.');
        $arrData = [
            'course_name'     => '',
            'area_id'         => '1',
        ];
        \Input::merge($arrData);

        // WHEN
        $return = $this->course->saveCourse();
        $actual = $this->course->errors()->get('course_name');

        // THEN
        $this->assertFalse($return);
        $this->assertEquals($actual, $expected);
    }

    // 14. function saveCourse should return false when course_name has more than 100 characters
    public function testSaveCourseShouldReturnFalseWhenCourseNameMoreThan100Characters()
    {
        // GIVEN
        $expected = array('The course name may not be greater than 100 characters.');
        $strCourseName = '';
        for($i = 0; $i < 101; $i++) $strCourseName .= 'a';
        $arrData = [
            'course_name'     => $strCourseName,
            'area_id'         => '1',
        ];
        \Input::merge($arrData);

        // WHEN
        $return = $this->course->saveCourse();
        $actual = $this->course->errors()->get('course_name');

        // THEN
        $this->assertFalse($return);
        $this->assertEquals($actual, $expected);
    }

    // 15. function saveCourse should return false when area_id is empty
    public function testSaveCourseShouldReturnFalseWhenAreaIdIsEmpty()
    {
        // GIVEN
        $expected = array('The area id field is required.');
        $arrData = [
            'course_name'     => 'Course OK',
            'area_id'         => '',
        ];
        \Input::merge($arrData);

        // WHEN
        $return = $this->course->saveCourse();
        $actual = $this->course->errors()->get('area_id');

        // THEN
        $this->assertFalse($return);
        $this->assertEquals($actual, $expected);
    }

    // 16. function saveCourse should return true when course insert successfully
    public function testSaveCourseShouldReturnTrueWhenInsertSuccessfully()
    {
        // GIVEN
        $expected = array();
        $arrData = [
            'course_name'     => 'Course OK',
            'area_id'         => '1',
        ];
        \Input::merge($arrData);

        // WHEN
        $return = $this->course->saveCourse();
        $actual = $this->course->errors()->all();

        // THEN
        $this->assertTrue($return);
        $this->assertEquals($actual, $expected);
    }

    // 17. function updateCourse should return object with error when course_name is empty
    public function testUpdateCourseShouldReturnObjectWithErrorWhenCourseNameIsEmpty()
    {
        // GIVEN
        $this->setUpCourseWithOutClass();

        $expected = array('The course name field is required.');
        $arrData = [
            'course_name'     => '',
            'area_id'         => '1',
        ];
        \Input::merge($arrData);

        // WHEN
        $objCourse = $this->course->updateCourse(2);
        $actual = $objCourse->errors()->all();

        // THEN
        $this->assertEquals($actual, $expected);
    }

    // 18. function updateCourse should return object with error when course_name has more than 100 characters
    public function testUpdateCourseShouldReturnObjectWithErrorWhenCourseNameMoreThan100Characters()
    {
        // GIVEN
        $this->setUpCourseWithOutClass();

        $expected = array('The course name may not be greater than 100 characters.');
        $strCourseName = '';
        for($i = 0; $i < 101; $i++) $strCourseName .= 'a';
        $arrData = [
            'course_name'     => $strCourseName,
            'area_id'         => '1',
        ];
        \Input::merge($arrData);

        // WHEN
        $objCourse = $this->course->updateCourse(2);
        $actual = $objCourse->errors()->all();

        // THEN
        $this->assertEquals($actual, $expected);
    }

    // 19. function updateCourse should return object with error when area_id is empty
    public function testUpdateCourseShouldReturnObjectWithErrorWhenAreaIdIsEmpty()
    {
        // GIVEN
        $this->setUpCourseWithOutClass();

        $expected = array('The area id field is required.');
        $arrData = [
            'course_name'     => 'Course OK',
            'area_id'         => '',
        ];
        \Input::merge($arrData);

        // WHEN
        $objCourse = $this->course->updateCourse(2);
        $actual = $objCourse->errors()->all();

        // THEN
        $this->assertEquals($actual, $expected);
    }

    // 20. function updateCourse should return true when course (without class) update successfully
    public function testUpdateCourseShouldReturnTrueWhenCourseWithoutClassUpdateSuccessfully()
    {
        // GIVEN
        $this->setUpCourseWithOutClass();

        $expected = array();
        $course_id = 2;
        $arrData = [
            'course_name'     => 'Course OK',
            'area_id'         => '2',
            'description'     => 'Description'
        ];
        \Input::merge($arrData);

        // WHEN
        $return = $this->course->updateCourse($course_id);
        $actual = $this->course->errors()->all();

        // THEN
        $this->assertTrue($return);
        $this->assertEquals($actual, $expected);
    }

    // 21. function checkValidation should return error message when course already had classes and area_id is changed
    public function testCheckValidationShouldReturnErrorMessageWhenCourseHadClassesAndAreaIdIsChanged()
    {
        //GIVEN
        $course_id = 1;
        $area_id = 2;
        $course_name = 'Course 2';

        //WHEN
        $actual = $this->course->checkValidation($area_id, $course_name, $course_id);

        //THEN
        $this->assertEquals(COURSE_HAD_CLASS_ERROR, $actual);
    }

    // 22. function checkValidation should return true when course already had classes and area_id and course_name is not changed
    public function testCheckValidationShouldReturnTrueWhenCourseHadClassesAndAreaIdAndCourseNameIsNotChanged()
    {
        //GIVEN
        $course_id = 1;
        $area_id = 1;
        $course_name = 'Course 2';

        //WHEN
        $actual = $this->course->checkValidation($area_id, $course_name, $course_id);

        //THEN
        $this->assertTrue($actual);
    }

    // 23. function updateCourse should return true when course (with class) update successfully
    public function testUpdateCourseShouldReturnTrueWhenCourseWithClassUpdateSuccessfully()
    {
        // GIVEN
        $expected = array();
        $course_id = 1;
        $arrData = [
            'course_name'     => 'Course 2',
            'area_id'         => '1',
            'description'     => 'Description changed'
        ];
        \Input::merge($arrData);

        // WHEN
        $return = $this->course->updateCourse($course_id);
        $actual = $this->course->errors()->all();

        // THEN
        $this->assertTrue($return);
        $this->assertEquals($actual, $expected);
    }
}