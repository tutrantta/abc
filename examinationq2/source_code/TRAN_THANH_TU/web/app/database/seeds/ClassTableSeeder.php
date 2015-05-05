<?php

class ClassTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('classes')->truncate();
        $insertItems = array();
        $insertItems[] = [
            'class_name' => 'UML 1',
            'course_id'=> 1,
            'trainer_id' => 8,
            'duration' => 4,
            'has_examination' => 1,
            'date' => date("Y-m-d"),
        ];
        $insertItems[] = [
            'class_name' => 'How to lead small team 1',
            'course_id'=> 2,
            'trainer_id' => 9,
            'duration' => 4,
            'has_examination' => 1,
            'date' => date("Y-m-d"),
        ];
        $insertItems[] = [
            'class_name' => 'Everyday English 1',
            'course_id'=> 3,
            'trainer_id' => 10,
            'duration' => 4,
            'has_examination' => 1,
            'date' => date("Y-m-d"),
        ];
        $insertItems[] = [
            'class_name' => 'OOP/MVC 1',
            'course_id'=> 4,
            'trainer_id' => 11,
            'duration' => 4,
            'has_examination' => 0,
            'date' => date("Y-m-d"),
        ];
        $insertItems[] = [
            'class_name' => 'Code Quality 1',
            'course_id'=> 5,
            'trainer_id' => 12,
            'duration' => 4,
            'has_examination' => 1,
            'date' => date("Y-m-d"),
        ];
        DB::table('classes')->insert($insertItems);

    }

}