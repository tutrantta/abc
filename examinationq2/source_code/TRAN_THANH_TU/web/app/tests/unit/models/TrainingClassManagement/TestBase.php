<?php namespace models\TrainingClassManagement;
/**
 * TestBase support setup data before test
 * 
 * @author lqdung
 *
 */
class TestBase extends \Codeception\TestCase\Test {

	public $arrClass 			= array();
	public $arrClassAssignment	= array();
	public $objTraining;
	public $arrCourse 			= array();
	public $arrTrainer 			= array();
	public $arrAreas 			= array();

	protected function _before()
	{
		parent::_before();
		\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		$this->objTraining = new \TrainingClassManagement();
	}

	protected function _after()
	{
		parent::_after();
	}

	// setup data for classes table
	public function setUpClass($number)
	{
		\DB::table('classes')->delete();
		
		for ($i = 1; $i <= $number; $i++) {
			$this->arrClass[] = [
				'class_id'			=> "$i",
				'class_name' 		=> 'class '.$i,
				'course_id'			=> '1',
				'trainer_id' 		=> '1',
				'duration' 			=> rand(1,8).'.00',
				'has_examination' 	=> rand(0,1).'',
				'date' 				=> date("Y-m-d"),
				'created_at' 		=> '0000-00-00 00:00:00',
				'updated_at' 		=> '0000-00-00 00:00:00'
			];
		}
		\DB::table('classes')->insert($this->arrClass);
	}

	// setup data for class_assignments table
	// setup class before
	public function setUpClassAssignment($number)
	{
		\DB::table('class_assignments')->delete();
		
		for ($i = 1; $i <= $number; $i++) {
			$this->arrClassAssignment[] = [
				'engineer_id' 			=> $i,
				'class_id' 				=> rand(1, count($this->arrClass)),
				'examination_result' 	=> rand(60, 90),
				'pass_examination' 		=> rand(0, 1)
			];
		}
		\DB::table('class_assignments')->insert($this->arrClassAssignment);
	}

	// setup data for courses table
	// setup areas before run this function
	public function setUpCourse($number)
	{
		\DB::table('courses')->delete();
		
		for ($i = 1; $i <= $number; $i++) {
			$this->arrCourse[] = [
				'course_id'		=> "$i",
				'course_name' 	=> 'test '.$i,
	            'area_id'		=> rand(1, count($this->arrAreas)),
	            'description' 	=> 'Decription '.$i
			];
		}
		\DB::table('courses')->insert($this->arrCourse);
	}

	// setup data for trainer table
	public function setUpTrainer($number)
	{
		\DB::table('trainers')->delete();
		
		for ($i = 1; $i <= $number; $i++) {
			$this->arrTrainer[] = [
				'trainer_id'	=> "$i",
				'trainer_name' 	=> 'Engineer '.$i,
                'employee_code' => 'code'.$i,
			];
		}
		\DB::table('trainers')->insert($this->arrTrainer);
	}
	// setup data for areas table
	public function setUpAreas($number)
	{
		\DB::table('areas')->delete();
		$areas = ['Technical', 'Soft Skill', 'Language'];

        foreach($areas as $key => $value) {
        	$this->arrAreas[] = [
        		'area_id'	=> "". $key + 1,
        		'is_active'	=> '1',
                'area_name' => $value
            ];
        }
        \DB::table('areas')->insert($this->arrAreas);
	}
}