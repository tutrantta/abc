<?php

/**
 * @package Database Seeder
 * @author tungly
 *
 */
class LevelTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('levels')->truncate();

        for ($i = 1; $i < 5; $i ++) {
            $insertItems = [
                'level_name' => 'PG'.$i,
                'is_active'=> 1
            ];
            DB::table('levels')->insert($insertItems);
        }
        
        for ($i = 5; $i < 9; $i ++) {
            $insertItems = [
                    'level_name' => 'SE'.$i,
                    'is_active'=> 1
            ];
            DB::table('levels')->insert($insertItems);
        }
    }

}