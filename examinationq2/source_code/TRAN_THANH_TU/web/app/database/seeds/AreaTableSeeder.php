<?php

class AreaTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('areas')->truncate();
        $areas = ['Technical', 'Soft Skill', 'Language'];

        foreach($areas as $key => $value) {
            DB::table('areas')->insert([
                'area_name' => $value
            ]);
        }
    }

}