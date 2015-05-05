<?php
/**
 * Interview Model
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-02          Bui Nguyen     Create File
 */
class Interview extends BaseModel {
    protected $fillable = [
        'id',
        'working_area_id',
        'engineer_id',
        'technique_skill_feedback',
        'management_skill_feedback',
        'other_feedback',
        'interview_date',
        'interviewer',
        'interviewer_department',
        'is_approve'
        ];
	protected $table = 'interview_forms';
    public static $rules = [
			'working_area_id' => 'required',
            'engineer_id' => 'required',
            'interviewer' => 'required|max:50',
            'technique_skill_feedback' => 'required',
            'management_skill_feedback' => 'required',
            'interview_date' => 'required',
            'interviewer_department' => 'required|max:100'
		];
    /**
     * 
     * validation form input
     */
    public function validation()
    {
        $customRule = self::$rules;
        $customRule['applied_position'] = 'required';
        $validator = \Validator::make(\Input::all(), $customRule);
        if ( $validator->fails() ) {
            return $validator->messages();
        }
        return true;
    }
    /**
     * get list levels
     * @author Bui Nguyen
     * @return array
     */
    public function getLevels()
    {
        return DB::table('levels')->get();
    }
    /**
     * get list techniques
     * @author Bui Nguyen
     * @return array
     */
    public function getTechniques()
    {
        return DB::table('techniques')->where('is_active', 1)->get();
    }
    /**
     * get first techniques history
     * @author Bui Nguyen
     * @return array
     */
    public function getTechniquesUpdate($engineer_id)
    {
        return DB::table('engineer_technique_level_history')
                ->leftJoin('techniques', 'engineer_technique_level_history.technique_id', '=', 'techniques.technique_id')
                ->where('engineer_id', $engineer_id)
                ->where('is_first_update', 1)
                ->get();
    }
    /**
     * get list softs
     * @author Bui Nguyen
     * @return array
     */
    public function getSofts()
    {
        return DB::table('soft_skills')->where('is_active', 1)->get();
    }
    /**
     * get first softs history 
     * @author Bui Nguyen
     * @return array
     */
    public function getSoftsUpdate($engineer_id)
    {
        return DB::table('engineer_soft_skill_level_history')
                ->leftJoin('soft_skills', 'engineer_soft_skill_level_history.soft_skill_id', '=' , 'soft_skills.soft_skill_id')
                ->where('engineer_id', $engineer_id)
                ->where('is_first_update', 1)
                ->get();
    }
    /**
     * get info interview form
     * @author Bui Nguyen
     * @return array
     */
    public function getInterviewForm($engineer_id)
    {
        return $this->leftJoin('engineers', 'engineers.engineer_id', '=', 'interview_forms.engineer_id')
                ->leftJoin('engineer_position_history', 'engineer_position_history.engineer_id', '=', 'interview_forms.engineer_id')
                ->select('interview_forms.*', 'engineers.fullname', 'engineer_position_history.level_id as position')
                ->where('interview_forms.engineer_id', $engineer_id)
                ->get();
    }
    /**
     * get engineer name
     * @author Bui Nguyen
     * @return array
     */
    public function getEngineerName($engineer_id)
    {
        return DB::table('engineers')->select('engineers.fullname')
                ->where('engineers.engineer_id', $engineer_id)
                ->get();
    }
    /**
     * get areas list
     * @author Bui Nguyen
     * @return array
     */
    public function getArea()
    {
        return DB::table('working_areas')->where('is_active', 1)->get();
    }
    /**
     * Insert interview form
     * @author Bui Nguyen
     * @return bolean
     */
    public function insertInterview($data)
    {
        DB::beginTransaction();
        $date = date('Y-m-d');
        $data['current_date'] = $date;
        try
        {
            // insert basic info interview form
            $form = $this->insertInterviewForm();

            // set array for insert techs
            $countTech = DB::table('techniques')->where('is_active', 1)->count();
            $arrTech = $this->repareArrayTech($countTech, $data);
            // set array for insert softs
            $countSoft = DB::table('soft_skills')->where('is_active', 1)->count();
            $arrSoft = $this->repareArraySoft($countSoft, $data);

            // update engineer has interview form
            $this->updateEngineerForm($data['engineer_id']);
            // insert first position engineer
            $this->insertPositionEngineer($data);

            // insert techs and softs        
            $this->insertTechs($arrTech);
            $this->insertSofts($arrSoft);
            if(!$form)
            {
                DB::rollback();
                return false;
            }
            DB::commit();
            return true;
        }
        catch (\Exception $e) 
        {
            DB::rollback();
            return false;
        }
    }
    /**
     * update interview form
     * @author Bui Nguyen
     * @return bolean
     */
    public function updateInterview($data)
    {
        DB::beginTransaction();
        $date = date('Y-m-d');
        $data['current_date'] = $date;
        try 
        {
            // update interview form
            $getForm = $this->find($data['interview_form_id']);
            $form = $getForm->save();

            // update posistion
            $this->updatePosition($data['applied_position']);
            // update techniques skill
            $countTech = count($this->getTechniquesUpdate($data['engineer_id']));
            for ($i = 0; $i < $countTech; $i++)
            {
                $arrTech = array(
                    'level_id' => $data['level'.$i],
                );
                DB::table('engineer_technique_level_history')
                    ->where('engineer_id', $data['engineer_id'])
                    ->where('technique_id', $data['tech'.$i])
                    ->where('is_first_update', 1)
                    ->update($arrTech);
            }
            // update softs skill
            $countSoft= count($this->getSoftsUpdate($data['engineer_id']));
            for ($j = 0; $j < $countSoft; $j++)
            {
                $arrSoft = array(
                    'soft_skill_level' => $data['soft_lv'.$j],
                );
                DB::table('engineer_soft_skill_level_history')
                    ->where('engineer_id', $data['engineer_id'])
                    ->where('soft_skill_id', $data['soft'.$j])
                    ->where('is_first_update', 1)
                    ->update($arrSoft);
            }
            
            if(!$form)
            {
                DB::rollback();
                return false;
            } 
            DB::commit();
            return true;
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            return false;
        }
    }
    /**
     * update position history
     * @author Bui Nguyen
     * @param int $level
     */
    public function updatePosition($level)
    {
        return DB::table('engineer_position_history')
                ->where('is_first_update', 1)
                ->update(array('level_id' => $level));
    }
    /**
     * repare arrat techs for insert
     * @author Bui Nguyen
     * @param int $count
     * @param array $data 
     * @return array
     */
    private function repareArrayTech($count, $data)
    {
        $arrTech = array();
        for ($i = 0; $i < $count; $i++)
        {
            $arrTech[] = array(
                'engineer_id' => $data['engineer_id'],
                'technique_id' => $data['tech'.$i],
                'level_id' => $data['level'.$i],
                'updated_time' => $data['current_date'],
                'is_first_update' => 1,
                'is_current' => 1
            );
        }
        return $arrTech;
    }
    /**
     * repare arrat softs for insert
     * @author Bui Nguyen
     * @param int $count
     * @param array $data 
     * @return array
     */
    private function repareArraySoft($count, $data)
    {
        $arrSoft = array();
        for ($j = 0; $j < $count; $j++)
        {
            $arrSoft[] = array(
                'engineer_id' => $data['engineer_id'],
                'soft_skill_id' => $data['soft'.$j],
                'soft_skill_level' => $data['soft_lv'.$j],
                'updated_time' => $data['current_date'],
                'is_first_update' => 1,
                'is_current' => 1
            );
        }
        return $arrSoft;
    }
    /**
     * insert multi techs skill of engineer
     * @author Bui Nguyen
     * @param array $arrTech 
     * @return int
     */
    public function insertTechs($arrTech)
    {
        return DB::table('engineer_technique_level_history')->insert($arrTech);
    }
    /**
     * insert multi softs skill of engineer
     * @author Bui Nguyen
     * @param array $arrSoft 
     * @return int
     */
    public function insertSofts($arrSoft)
    {
        return DB::table('engineer_soft_skill_level_history')->insert($arrSoft);
    }
    /**
     * update exist interview form of engineer
     * @author Bui Nguyen
     * @param int $engineer_id 
     * @return int
     */
    public function updateEngineerForm($engineer_id)
    {
        return DB::table('engineers')
                    ->where('engineer_id', $engineer_id)
                    ->update(array('has_interview_form' => 1));
    }
    /**
     * insert first position of engineer
     * @author Bui Nguyen
     * @param array $data 
     * @return int
     */
    public function insertPositionEngineer($data)
    {
        return DB::table('engineer_position_history')->insert(
                array(
                    'engineer_id' => $data['engineer_id'], 
                    'level_id' => $data['applied_position'],
                    'updated_time' => $data['current_date'],
                    'is_current' => 1,
                    'is_first_update' => 1
                )
                );
    }
    /**
     * insert basic info on interview form of engineer
     * @author Bui Nguyen 
     * @return bolean
     */
    public function insertInterviewForm()
    {
        return $this->save();
    }
}