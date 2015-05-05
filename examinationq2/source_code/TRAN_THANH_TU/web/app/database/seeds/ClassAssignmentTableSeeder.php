<?php

class ClassAssignmentTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('class_assignments')->truncate();

        for ($i = 1; $i < 30; $i ++) {
            $insertItems = [
                'engineer_id' => $i,
                'class_id' => rand(1, 3),
                'examination_result' => rand(60, 90),
                'pass_examination' => rand(0, 1)
            ];
            DB::table('class_assignments')->insert($insertItems);
        }
    }

}