<?php

/**
 * @package Database Seeder
 * @author Dung Le
 *
 */
class EngineerPositionHistoryTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('engineer_position_history')->truncate();
        
        for ($i = 1; $i < 50; $i++) {
            $arrData = [
                    'engineer_id'       => $i,
                    'level_id'          => rand(1,8),
                    'updated_time'      => date('Y-m-d'),
                    'is_current'        => 1,
                    'is_first_update'   => 1
            ];
            DB::table('engineer_position_history')->insert($arrData);
        }
    }

}