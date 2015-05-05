<?php
/**
 * TrainingClassManagement function
 *
 * Date                Author       Content
 * ----------------------------------------------------
 * 2015-04-13          LamKy       Create File
 * 2015-04-15          Dung Le     Modify|Refactor
 * 2015-04-16          Dung Le     Add new function
 * 2015-04-20          Dung Le     Modify|Refactor
 * 2015-04-29          tttu        Modify
 */

class TrainingClassManagement extends BaseModel {
    protected $table = 'classes';
    protected $primaryKey = 'class_id';
    protected $fillable = [
            'class_id',
            'course_id',
            'trainer_id',
            'class_name',
            'date',
            'duration',
            'has_examination'
    ];
    
    public static $rules = [
            'class_name'        => 'required|unique:classes|max:50',
            'course_id'         => 'required|numeric',
            'date'              => 'required|date:YYYY-MM-DD',
            'duration'          => 'numeric|between:0,8',
            'has_examination'   => 'boolean'
    ];
    
    /**
     * @param
     * @method insert new training class to data
     * @return Ambigous <boolean, NULL>
     * @author LamKy | Dung Le
     */
    public function doInsert()
    {
        if (!array_key_exists('has_examination', Input::all()))
        {
            Input::merge(array('has_examination' => 0));
        }
        if (Input::get('trainer_id') == '')
        {
            Input::merge(array('trainer_id' => NULL));
        }
        $query = $this->save();
        return $query;
    }
    
    /**
     * 
     * @param int $class_id
     * @return boolean
     * @method update detail of training class
     * @author LamKy | Dung Le
     */
    public function doUpdate($class_id)
    {
        $class = $this->find($class_id);
        
        if (!array_key_exists('has_examination', Input::all())) 
        {
            Input::merge(array('has_examination' => 0));
        }
        if (Input::get('trainer_id') == '')
        {
            Input::merge(array('trainer_id' => NULL));
        }
        self::$rules['class_name'] = 'required|max:50|unique:classes,class_name,'.$class_id.',class_id';

        $ret = $class->save();
        if ($ret === true) {
            return $ret;
        }
        return $class->errors();
    }
    
    /**
     * 
     * @param int $class_id
     * @return 
     * @method get detail of training class
     * @author LamKy | Dung Le
     */
    public function getClass($class_id)
    {
        $arrDetail = \DB::table('classes')
            ->where('class_id', '=', $class_id)
            ->first();
        return $arrDetail;
    }
    
    /**
     * @method create ajax, support show list on datatables.
     * @author LamKy
     */
    public function ajax_()
    {
        $col = ['class_name', 'course_name', 'date', 'trainer_name',
                'duration', 'has_examination'];
    
        $datatableRequest = \Datatable::request($col, 'updated_at', 'desc');
        
        // Query: get all table "classes"
        $query = \DB::table('classes')
            ->leftJoin('courses', 'classes.course_id', '=', 'courses.course_id')
            ->leftJoin('trainers', 'classes.trainer_id', '=', 'trainers.trainer_id')
            ->select("classes.*", 'courses.course_name', 'trainers.trainer_name');
        
        // buid seach
        $query->where('classes.class_name', 'like', '%'.$datatableRequest['search'].'%');
        $query->orWhere('courses.course_name', 'like', '%'.$datatableRequest['search'].'%');
        $query->orWhere('trainers.trainer_name', 'like', '%'.$datatableRequest['search'].'%');
    
        // get total
        $classesTotal = $query->count();
        
        // buid pagination
        $query->skip($datatableRequest['offset']);
        $query->take($datatableRequest['limit']);
        $query->orderBy($datatableRequest['order'], $datatableRequest['sort']);
    
        // get data
        $classesList = $query->get();
        
        // create ajax data
        $datatableData = array();
        foreach ($classesList as $class)
        {
            $row = array();
            $tmp = ($class->has_examination == 1) ? 'checked' : '';
            $class_id = $class->class_id;
            $href = "../training-class/edit/" . $class_id;
            
            $row['class_name'] = $class->class_name;
            $row['course_name'] = $class->course_name;
            $row['date'] = $class->date;
            $row['trainer_name'] = $class->trainer_name;
            $row['duration'] = $class->duration;
            $row['has_examination'] = "<input type='checkbox' $tmp disabled>";
            $row['action'] = '<a href="'.$href.'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></a>';
            $datatableData[] = $row;
        }
        return \Datatable::output($datatableData, $classesTotal);
    }
    
    /**
     * @param
     * @method get all courses exist on database
     * @return array all courses
     * @author LamKy | Dung Le
     */
    public function getAllCourses()
    {
        $arrCourse = \Course::all();

        $arrResult = Helper::getArrayIdValue($arrCourse, 'course_id', 'course_name');

        return $arrResult;
    }
    
    /**
     * @param
     * @method get all trainers exist on database
     * @return array all trainer
     * @author LamKy | Dung Le
     */
    public function getAllTrainer()
    {
        $arrTrainer = \TrainerManagement::all();

        $arrResult = Helper::getArrayIdValue($arrTrainer, 'trainer_id', 'trainer_name');

        return $arrResult;
    }

    /**
     * getAllAreas function support get all areas
     * @author Dung Le
     * @return Array
     */
    public function getAllAreas()
    {
        $arrAreaListTmp = \Area::all();
        
        $arrAreaList = \Helper::getArrayIdValue($arrAreaListTmp, 'area_id', 'area_name');
        
        return $arrAreaList;
    }
}
