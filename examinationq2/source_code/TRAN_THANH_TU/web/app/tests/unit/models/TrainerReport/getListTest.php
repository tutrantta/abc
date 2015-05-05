<?php namespace models\TrainerReport;
require_once __DIR__ . '/../TestBase.php';
/**
 * Class getListTest support test getList function
 *
 * @author Dung Le
 *
 * To do list
 * 1. testShouldReturnNullWhenClassTableIsEmpty
 * 2. testShouldReturnNullWhenDateOutRange
 * 3. testShouldReturnArrayDataWhenDateInRange
 * 4. testShouldReturnArrayDataWhenDateInRangeAndFilterByTrainer
 * 5. testShouldReturnNullWhenClassTableIsEmptyAndFilterByTrainer
 * 6. testShouldReturnNullWhenDateOutRangeAndFilterByTrainer
 * 7. testShouldReturnEmptyArrayWhenDateInRangeAndFilterByTrainerWithNoClassAssigned
 */
class getListTest extends \TestBase {
    
    protected $number_engineer = 6;
    protected $number = 5;
    protected function _before()
    {
        parent::_before();
        $this->objTrainerReport = new \TrainerReport();

        //set up master table
        $this->setUpCourse($this->number);
        $this->setUpTrainer($this->number);
        $this->setUpAreas($this->number);
        // set up class info
        $this->setUpClass($this->number_engineer);
    }

    protected function _after()
    {
        parent::_after();
    }

    public function testShouldReturnNullWhenClassTableIsEmpty()
    {
        // Give
        $expected   = array();
        // When
        $date_from  = '1000-01-01';
        $date_to    = '3000-01-01';

        \DB::table('classes')->delete();

        $actual     = $this->objTrainerReport->getList($date_from, $date_to);
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

        $actual     = $this->objTrainerReport->getList($date_from, $date_to);
        // Verify
        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnArrayDataWhenDateInRange()
    {
        // Give
        $course_name = '';
        $area_name   = '';
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

        $trainer_name = '';
        foreach ($this->arrTrainer as $value) {
            if ($value['trainer_id'] == $this->trainer_id) {
                $trainer_name = $value['trainer_name'];
                break;
            }
        }

        $expected   = [[
            'full_name' => $trainer_name,
            'course'    => $course_name,
            'area'      => $area_name,
            'duration'  => ''.$total_hours,
        ]];
        // When
        $date_from  = '1000-01-01';
        $date_to    = '5000-01-01';

        $result     = $this->objTrainerReport->getList($date_from, $date_to);
        foreach ($result as $key => $value) {
            $result[$key] = get_object_vars($value);
        }

        $actual = $result;

        // Verify
        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnArrayDataWhenDateInRangeAndFilterByTrainer()
    {
        // Give
        $course_name = '';
        $area_name   = '';
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

        $trainer_name = '';
        foreach ($this->arrTrainer as $value) {
            if ($value['trainer_id'] == $this->trainer_id) {
                $trainer_name = $value['trainer_name'];
                break;
            }
        }

        $expected   = [[
            'full_name' => $trainer_name,
            'course'    => $course_name,
            'area'      => $area_name,
            'duration'  => ''.$total_hours,
        ]];
        // When
        $date_from  = '1000-01-01';
        $date_to    = '5000-01-01';

        $result     = $this->objTrainerReport->getList($date_from, $date_to, $this->trainer_id);
        foreach ($result as $key => $value) {
            $result[$key] = get_object_vars($value);
        }

        $actual = $result;

        // Verify
        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnNullWhenClassTableIsEmptyAndFilterByTrainer()
    {
        // Give
        $expected   = array();
        // When
        $date_from  = '1000-01-01';
        $date_to    = '3000-01-01';

        \DB::table('classes')->delete();

        $actual     = $this->objTrainerReport->getList($date_from, $date_to, $this->trainer_id);
        // Verify
        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnNullWhenDateOutRangeAndFilterByTrainer()
    {
        // Give
        $expected   = array();

        // When
        $date_from  = '1000-01-01';
        $date_to    = '2000-01-01';

        $actual     = $this->objTrainerReport->getList($date_from, $date_to, $this->trainer_id);
        // Verify
        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnEmptyArrayWhenDateInRangeAndFilterByTrainerWithNoClassAssigned()
    {
        // Give
        $expected   = [];
        $trainer_id = 2;

        // When
        $date_from  = '1000-01-01';
        $date_to    = '5000-01-01';

        $result     = $this->objTrainerReport->getList($date_from, $date_to, $trainer_id);
        foreach ($result as $key => $value) {
            $result[$key] = get_object_vars($value);
        }

        $actual = $result;

        // Verify
        $this->assertEquals($expected, $actual);
    }
}