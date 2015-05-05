<?php

/**
 * @package Database Seeder
 * @author Dung Le
 *
 */
class MonthlyUtilizationTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('monthly_utilizations')->truncate();
        
        for ($i = 1; $i < 50; $i++) {
            $arrData = [
                    'engineer_id'       => $i,
                    'working_area_id'   => rand(1,3),
                    'month'             => date('Y-m-d'),
                    'utilization'       => rand(10, 100)
            ];
            DB::table('monthly_utilizations')->insert($arrData);
        }
    }

}