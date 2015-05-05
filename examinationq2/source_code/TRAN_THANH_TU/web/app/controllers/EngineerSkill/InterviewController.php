<?php
/**
 * Interview Controller
 *
 * Date                Author             Content
 * ----------------------------------------------------
 * 2015-04-02          Bui Nguyen     Create File
 */

namespace EngineerSkill;
class InterviewController extends \BaseController {
    
    protected $interviewModel;
    
    public function __construct(\Interview $interview)
    {
        $this->interviewModel = $interview;
    }
    /**
     * @author Bui Nguyen
     * @todo load interview form
     * @return Response
     */
    public function interviewForm($engineer_id, $has)
    {
        // check exist id
        $exist = \DB::table('engineers')->where('engineer_id', '=', $engineer_id)->exists();
        if(empty($engineer_id) == true || !isset($has) || !in_array($has, array('0', '1')) || !$exist)
        {
            \App::abort(404);
        }
        
        $arrLevels = array();
        $arrPositions = array();
        // get all levels
        $levels = $this->interviewModel->getLevels();
        foreach($levels as $level)
        {
            $arrLevels[$level->level_id] = $level->level_name;
        }
        // have not interview form
        if($has == 0) 
        {
            $interview = $this->interviewModel->getEngineerName($engineer_id);
            // get list techniques
            $techniques = $this->interviewModel->getTechniques();
            // get all position
            $position = $this->interviewModel->getArea();
            foreach($position as $area)
            {
                $arrPositions[$area->working_area_id] = $area->working_area_name;
            }
            // get soft skill list
            $softs = $this->interviewModel->getSofts();
            $route = 'engineer_skill.engineers.interview-form';
        }
        // have interview form
        elseif($has == 1)
        {
            // get interview form
            $interview = $this->interviewModel->getInterviewForm($engineer_id)->toArray();
            // get list techniques
            $techniques = $this->interviewModel->getTechniquesUpdate($engineer_id);
            // get all position
            $position = $this->interviewModel->getArea();
            foreach($position as $area)
            {
                $arrPositions[$area->working_area_id] = $area->working_area_name;
            }
            // get soft skill list
            $softs = $this->interviewModel->getSoftsUpdate($engineer_id);
            $route = 'engineer_skill.engineers.interview-form-update';
        }
        $data = array(
            'arrLevels' => $arrLevels, 
            'arrPositions' => $arrPositions,            
            'arrTechniques' => $techniques,
            'arrSofts' => $softs,
            'data' => isset($interview[0]) ? $interview[0] : array(),
            'engineer_id' => $engineer_id,
            'has_form' => $has
        );
        return \View::make($route)->with($data);
    }
    /**
     * @author Bui Nguyen
     * @todo insert or update interview form
     * @return Response
     */
    public function submitInterviewForm()
	{
        $validate = $this->interviewModel->validation();
        if($validate === true)
        {
            if(\Request::isMethod('post'))
            {
                $query = $this->interviewModel->insertInterview(\Input::all());
            }
            if(\Request::isMethod('put'))
            {
                $query = $this->interviewModel->updateInterview(\Input::all());
            }
            // check update or insert success
            if($query === false)
            {
                return \Redirect::route('interview-form', array('engineer_id' => \Input::get('engineer_id'), 'has_form' => \Input::get('has_form')))->withErrors('Update Interview Form Fail.');
            }
            return \Redirect::route('engineer-detail', array('engineer_id' => \Input::get('engineer_id')))->withFlashMessage('Update Interview Form Successfully.');
        }        
        else
        {
            return \Redirect::route('interview-form', array('engineer_id' => \Input::get('engineer_id'), 'has_form' => \Input::get('has_form')))
                    ->withErrors($validate)->withInput();
        }
	}
}