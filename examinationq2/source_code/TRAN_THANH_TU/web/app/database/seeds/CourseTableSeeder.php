<?php

class CourseTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('courses')->truncate();
        $insertItems = array();
        $insertItems[] = [
            'course_name' => 'UML',
            'area_id'=> 1,
            'description' => 'UML is Undefined Modeling Language'
        ];
        $insertItems[] = [
            'course_name' => 'How to lead small team',
            'area_id'=> 2,
            'description' => 'This course is about management a team with less than 10 members'
        ];
        $insertItems[] = [
            'course_name' => 'Everyday English',
            'area_id'=> 3,
            'description' => 'English for daily usage'
        ];
        $insertItems[] = [
            'course_name' => 'OOP/MVC',
            'area_id'=> 1,
            'description' => 'Everything about OOP and MVC'
        ];
        $insertItems[] = [
            'course_name' => 'Code Quality',
            'area_id'=> 1,
            'description' => 'The Art of Readable Code'
        ];
        DB::table('courses')->insert($insertItems);

    }

}