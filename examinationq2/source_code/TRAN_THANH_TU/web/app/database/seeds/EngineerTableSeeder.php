<?php

/**
 * @package Database Seeder
 * @author tungly
 *
 */
class EngineerTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('engineers')->truncate();
        
        $insertItems = [
                'department_name' => 'department 1',
                'is_active'=> 1
        ];
        
        $departmentId = DB::table('departments')->first()->department_id;
        
        for ($i = 1; $i < 50; $i ++) {
            $insertItems = [
                    'fullname' => 'Engineer '.$i,
                    'employee_code' => 'TA0'.$i,
                    'gender' => 'male',
                    'email' => 'engineer'.$i . '@tctav.com',
                    'is_active'=> 1,
                    'department_id' => $departmentId
            ];
            DB::table('engineers')->insert($insertItems);
        }
    }

}