<?php

class WorkingAreaTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('working_areas')->truncate();
        $working_areas = ['PHP', 'Java', 'Mobile'];

        foreach($working_areas as $key => $value) {
            DB::table('working_areas')->insert([
                'working_area_name' => $value
            ]);
        }
    }

}