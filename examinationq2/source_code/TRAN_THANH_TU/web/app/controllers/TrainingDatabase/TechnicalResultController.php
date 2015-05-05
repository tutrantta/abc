<?php namespace TrainingDatabase;

class TechnicalResultController extends \BaseController {

    protected $technicalResult;
    
    public function __construct(\TechnicalResult $technicalResult)
    {
        $this->technicalResult = $technicalResult;
    }

    /**
     * @author Nguyen Trieu
     * @name lists technical update result
     * @return Response
     */
    public function lists($class_id = '')
    {
        return \View::make('training_database.technical_result.index',['class_id'=>$class_id]);
    }

    /**
     * @author Nguyen Trieu
     * @name lists technical result ajax
     * @return Response
     */
    public function listAjax($class_id = '')
    {
        $technicalList = $this->technicalResult->getList($class_id);
        $total = $technicalList['count'];
        
        $arrData = array();
        foreach ($technicalList['data'] as $technical) {
            $col = array();
            $result = is_numeric($technical->examination_result) ? round($technical->examination_result, 2): '';
            // update input examination_result
            $examination_result = '<input type="text" value="'.$result.'" name="examination_result"';
            $examination_result .= ' class="table_edit" engineerid="'.$technical->engineer_id.'" classid="'.$technical->class_id.'"/>';
            // update checkbox pass_examination
            $checked = ($technical->pass_examination == 1) ? 'checked="checked"' : '';
            $pass_examination = '<input type="checkbox" id="check'. $technical->engineer_id.'" name="pass_examination" ' . $checked;
            $pass_examination .= ' class="table_edit" engineerid="'.$technical->engineer_id.'" classid="'.$technical->class_id.'"/>';

            $col['employee_code'] = $technical->employee_code;
            $col['fullname'] = $technical->fullname;
            $col['examination_result'] = $examination_result;
            $col['pass_examination'] = $pass_examination;

            $arrData[] = $col;
        }        
        return \Datatable::output($arrData, $total);
    }

     /**
     * @author Nguyen Trieu
     * @name update technical result
     * @return Response
     */
    public function updateResult()
    {
        // extract variable
        extract(\Input::all());
        // check checkbox true false
        if($edit_field == 'pass_examination')
        {
            if($edit_val === 'true' || $edit_val === true)
            {
                $edit_val = 1;
            }
            elseif($edit_val === 'false' || $edit_val === false) 
            {
                $edit_val = 0;
            }
        }

        // check validate
        $validate = $this->technicalResult->doValidate(array(
            'class_id' => $class_id,
            'engineer_id' => $engineer_id,
            $edit_field => $edit_val
        ));
        if ($validate !== true) {
            return json_encode(array('status' => 'error', 'msg' => $validate->errors()->all()));
        }
        // check examination_result
        if (trim($edit_val) == '') 
        {
            $edit_val =  NULL;
        }
        elseif($edit_field == 'examination_result'){
            $edit_val = (double) $edit_val;
        }
        // update to database
        if ($this->technicalResult->updateResult((int) $class_id, (int) $engineer_id, array($edit_field => $edit_val)))
        {
            return json_encode(array('status' => 'success', 'msg' => "Update success!"));
        }
        return json_encode(array('status' => 'error', 'msg' => 'Update error!'));
    }
}