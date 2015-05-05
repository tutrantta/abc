<?php

/**
 * @package Database Seeder
 * @author Dung Le
 *
 */
class SoftSkillTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('soft_skills')->truncate();
        $insertItems = array();
        $insertItems[] = [
            'soft_skill_name' => 'Communication',
            'is_active'=> 1
        ];
        $insertItems[] = [
            'soft_skill_name' => 'Leadership',
            'is_active'=> 1
        ];
        $insertItems[] = [
            'soft_skill_name' => 'Teamwork',
            'is_active'=> 1
        ];
        DB::table('soft_skills')->insert($insertItems);
        
    }

}