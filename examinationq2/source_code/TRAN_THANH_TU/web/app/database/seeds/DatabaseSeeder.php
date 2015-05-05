<?php

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        $this->call('UserTableSeeder');
        $this->call('WorkingAreaTableSeeder');

        $this->call('DepartmentTableSeeder');
        $this->call('EngineerTableSeeder');
        $this->call('TechniqueTableSeeder');
        $this->call('LevelTableSeeder');
//         $this->call('EngineerTechniqueLevelHistoryTableSeeder');
        /* Update 2015.02.04 Dung Le start */
//         $this->call('EngineerPositionHistoryTableSeeder');
        //$this->call('MonthlyUtilizationTableSeeder');
        $this->call('SoftSkillTableSeeder');
        /* Update 2015.02.04 Dung Le End */

        //2015/04/13 tttu add
        $this->call('AreaTableSeeder');
        $this->call('CourseTableSeeder');
        $this->call('TrainerTableSeeder');
        $this->call('ClassTableSeeder');
        $this->call('ClassAssignmentTableSeeder');
        //2015/04/13 tttu end
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
