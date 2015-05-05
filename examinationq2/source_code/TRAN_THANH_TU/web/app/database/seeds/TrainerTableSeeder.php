<?php

class TrainerTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('trainers')->truncate();

        for ($i = 1; $i < 10; $i++) {
            $insertItems = [
                'trainer_name' => 'Engineer '.$i,
                'employee_code' => 'TA0'.$i,
            ];
            DB::table('trainers')->insert($insertItems);
        }

        for ($i = 1; $i < 10; $i++) {
            $insertItems = [
                'trainer_name' => 'External Trainer '.$i,
                'employee_code' => 'External',
            ];
            DB::table('trainers')->insert($insertItems);
        }
    }

}