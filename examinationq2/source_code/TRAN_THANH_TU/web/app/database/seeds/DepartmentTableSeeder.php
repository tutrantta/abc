<?php

/**
 * @package Database Seeder
 * @author tungly
 *
 */
class DepartmentTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('departments')->truncate();

        for ($i = 1; $i < 9; $i ++) {
            $insertItems = [
                    'department_name' => 'department '.$i,
                    'is_active'=> 1
            ];
            DB::table('departments')->insert($insertItems);
        }
    }

}