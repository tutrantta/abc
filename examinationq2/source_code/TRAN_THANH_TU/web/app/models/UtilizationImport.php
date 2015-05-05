<?php
/**
 * Utilization Import Model
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-06          tttu               Create File
 */

class UtilizationImport extends BaseModel {
    protected $fillable = [
        'engineer_id',
        'working_area_id',
        'month',
        'utilization',
    ];
    protected $table = 'monthly_utilizations';
    public static $rules = [
        'engineer_id' => 'required',
        'working_area_id' => 'required',
        'month' => 'required',
        'utilization' => 'required',
    ];

    /**
     * delete existing utilization if a month has been imported utilization before
     * @author tttu
     * @return bool
     */
    private function deleteExistingImport($import_date)
    {
        $query = "date_format(month, '%m/%Y') = '$import_date'";
        $result = \DB::table($this->table)->whereRaw(DB::raw($query))->delete();
        return $result;
    }

    /**
     * insert single utilization
     * @author tttu
     * @return bool
     */
    private function doInsert($insertData)
    {
        try{
            $result = \DB::table($this->table)->insert($insertData);
        }
        catch(\Illuminate\Database\QueryException $e) {
            return false;
        }
        return $result;
    }

    /**
     * get engineer_id by engineer name
     * @author tttu
     * @return bool
     */
    private function getEngineerId($engineer_name)
    {
        $result = \DB::table('engineers')->where('fullname', '=', $engineer_name)->select('engineer_id')->get();
        if(empty($result)) return false;
        return $result[0]->engineer_id;
    }

    /**
     * get working_are_id by working skill
     * @author tttu
     * @return bool
     */
    private function getWorkingSkillId($working_skill)
    {
        $result = \DB::table('working_areas')->where('working_area_name', '=', $working_skill)->select('working_area_id')->get();
        if(empty($result)) return false;
        return $result[0]->working_area_id;
    }

    /**
     * validate File and Import date
     * @author tttu
     * @return bool
     */
    public function validateFileAndImportDate($data)
    {
        //TODO: insert more rule (file size, file extension, file type)
        $rules = [
            'import_date' => 'required',
            'file' => 'required'
        ];

        $validator = Validator::make($data, $rules);
        if($validator->fails()) {
            return $validator;
        }
        return true;
    }

    /**
     * check if a month has been imported utilization before
     * @author tttu
     * @return bool
     */
    public function hasExistingImport($import_date)
    {
        $query = "date_format(month, '%m/%Y') = '$import_date'";
        $result = \DB::table($this->table)->whereRaw(DB::raw($query))->count();
        return $result;
    }

    /**
     * insert data
     * @author tttu
     * @return array
     */
    public function insert($data, $import_date)
    {
        $numberOfSuccess = 0;
        $arrErrorRows = [];

        //delete all exist import;
        $this->deleteExistingImport($import_date);

        //convert date
        $tmp1 = explode('/', $import_date);
        $import_date = implode('-', array_reverse($tmp1));

        foreach ($data as $item) {
            //get engineer_id
            $engineer_id = $this->getEngineerId(trim($item['engineer']));
            if($engineer_id === false) {
                $arrErrorRows[] = trim($item['no']);
                continue;
            }

            //get working_skill_id
            $working_skill_id = $this->getWorkingSkillId(trim($item['working_skill']));
            if($working_skill_id === false) {
                $arrErrorRows[] = trim($item['no']);
                continue;
            }

            //insert
            $arrInsertData = [
                'engineer_id' => $engineer_id,
                'working_area_id' => $working_skill_id,
                'month' => date('Y-m-01', strtotime($import_date)),
                'utilization' => trim($item['utilization'])
            ];

            //do insert
            $result = $this->doInsert($arrInsertData);
            if($result) {
                $numberOfSuccess++;
            }
            else $arrErrorRows[] = trim($item['no']);
        }

        $numberOfError = count($arrErrorRows);
        return compact('numberOfSuccess', 'numberOfError', 'arrErrorRows');
    }
}