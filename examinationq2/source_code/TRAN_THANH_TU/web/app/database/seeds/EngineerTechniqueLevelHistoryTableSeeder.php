<?php

/**
 * @package Database Seeder
 * @author tungly
 *
 */
class EngineerTechniqueLevelHistoryTableSeeder extends Seeder
{

    public function run ()
    {
        DB::table('engineer_technique_level_history')->truncate();
        $eids = DB::table('engineers')->lists('engineer_id');
        $tids = DB::table('techniques')->lists('technique_id');
        $lids = DB::table('levels')->lists('level_id');
        
        
        foreach($eids as $eid){
            foreach($tids as $tid){
                $insertItems[] = [
                    'engineer_id' => $eid,
                    'technique_id' => $tid,
                    'updated_time' => date("Y-m-d"),
                    'level_id' => $lids[array_rand($lids,1)],
                    'is_current' => 1,
                    'is_first_update' => 1
                ];
            }
            
        }
        DB::table('engineer_technique_level_history')->insert($insertItems);
    }

}