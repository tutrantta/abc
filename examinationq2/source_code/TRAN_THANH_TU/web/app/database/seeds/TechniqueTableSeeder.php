<?php

/**
 * @package Database Seeder
 * @author tungly
 *
 */
class TechniqueTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('techniques')->truncate();
        $insertItems = array();
        $insertItems[] = [
            'technique_name' => 'Understanding Requirement',
            'is_active'=> 1
        ];
        $insertItems[] = [
            'technique_name' => 'OOP/MVC',
            'is_active'=> 1
        ];
        $insertItems[] = [
            'technique_name' => 'UML',
            'is_active'=> 1
        ];
        $insertItems[] = [
            'technique_name' => 'Coding',
            'is_active'=> 1
        ];
        $insertItems[] = [
            'technique_name' => 'Testing',
            'is_active'=> 1
        ];
        DB::table('techniques')->insert($insertItems);
        
    }

}