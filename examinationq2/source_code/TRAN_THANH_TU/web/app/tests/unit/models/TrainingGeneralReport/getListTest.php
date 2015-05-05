<?php namespace models\TrainingGeneralReport;
require_once __DIR__ . '/../TestBase.php';
/**
 * Class getListTest support test getList function
 *
 * @author Dung Le
 *
 * To do list
 * 1. testShouldReturnNullWhenCourseTableIsEmpty
 * 2. testShouldReturnNullWhenDateOutRange
 * 3. testShouldReturnArrayDataWhenDateInRange
 */
class getListTest extends \TestBase {
    
    protected $number_engineer = 6;
    protected $number = 5;
    protected function _before()
    {
        parent::_before();
        $this->objGenaral = new \TrainingGeneralReport();
        //set up master table
        $this->setUpCourse($this->number);
        $this->setUpTrainer($this->number);
        $this->setUpAreas($this->number);
        // set up class info
        $this->setUpClass($this->number_engineer);
        $this->setUpClassAssignment($this->number_engineer);
    }

    protected function _after()
    {
        parent::_after();
    }

    public function testShouldReturnNullWhenCourseTableIsEmpty()
    {
        // Give
        $expected   = array();
        // When
        $date_from  = '1000-01-01';
        $date_to    = '3000-01-01';

        \DB::table('courses')->delete();

        $actual     = $this->objGenaral->getList($date_from, $date_to);
        // Verify
        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnNullWhenDateOutRange()
    {
        // Give
        $expected   = array();

        // When
        $date_from  = '1000-01-01';
        $date_to    = '2000-01-01';

        $actual     = $this->objGenaral->getList($date_from, $date_to);
        // Verify
        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnNullWhenDateInRange()
    {
        // Give
        foreach ($this->arrCourse as $value) {
            if ($value['course_id'] == $this->course_id) {
                $course_name = $value['course_name'];
                foreach ($this->arrAreas as $v) {
                    if ($value['area_id'] == $v['area_id']) {
                        $area_name = $v['area_name'];
                        break;
                    }
                }
                break;
            }
        }
        $total_hours = 0.00;
        foreach ($this->arrClass as $value) {
            if ($value['course_id'] == $this->course_id)
            {
                $total_hours += $value['duration'];
            }
        }
        $total_hours = number_format((float)$total_hours, 2, '.', '');

        $total_pass = 0;
        foreach ($this->arrClassAssignment as $value) {
            $total_pass += $value['pass_examination'];
        }

        $pass_rating = $total_pass/$this->number_engineer * 100;

        $pass_rating = number_format((float)$pass_rating, 2, '.', '');

        $average_training_hours = $total_hours/$this->number_engineer;

        $average_training_hours = round($average_training_hours, 2, PHP_ROUND_HALF_DOWN);

        $expected   = [[
            'course_name'            => $course_name,
            'area_name'              => $area_name,
            'total_class'            => ''.count($this->arrClass),
            'total_hours'            => ''.$total_hours,
            'total_participant'      => "$this->number_engineer",
            'total_trainer'          => '1',
            'pass_rating'            => $pass_rating,
            'average_training_hours' => ''.$average_training_hours
        ]];
        // When
        $date_from  = '1000-01-01';
        $date_to    = '5000-01-01';

        $result     = $this->objGenaral->getList($date_from, $date_to);
        foreach ($result as $key => $value) {
            $result[$key] = get_object_vars($value);
        }

        $actual = $result;

        // Verify
        $this->assertEquals($expected, $actual);
    }
}