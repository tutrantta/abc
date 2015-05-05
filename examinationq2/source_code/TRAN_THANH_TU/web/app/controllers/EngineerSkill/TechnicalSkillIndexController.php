<?php

/**
 * TechnicalSkillIndexController
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-02          Trieu Nguyen     Create File
 */

namespace EngineerSkill;

class TechnicalSkillIndexController extends \BaseController {

    protected $technicalSkill;

    public function __construct(\TechnicalSkillIndex $technicalSkillIndex)
    {
        // load technicalSkillIndex model
        $this->technicalSkillIndex = $technicalSkillIndex;
    }

    /**
     * @author Trieu Nguyen
     * @name index
     * @return Response
     */
    public function index()
    {
        // get technical List
        $technicalList = $this->technicalSkillIndex->getList();
        return \View::make('engineer_skill.technical_skill_index.index')->with('technicalList', $technicalList);
    }

    /**
     * @author Trieu Nguyen
     * @name create
     * @return Response
     */
    public function create()
    {
        return \View::make('engineer_skill.technical_skill_index.create');
    }

    /**
     * @author Trieu Nguyen
     * @name doCreate
     * @return Response
     */
    public function doCreate()
    {
        // check insert success
        if ($this->technicalSkillIndex->doInsert())
        {
            return \Redirect::route('technical-skill-manager')->withFlashMessage('Technical Skill Index Created Successfully.');
        }
        // insert error
        $error = $this->technicalSkillIndex->errors();
        return \Redirect::refresh()->withErrors($error);
    }

    /**
     * @author Trieu Nguyen
     * @name edit
     * @return Response
     */
    public function edit($technicalId = '')
    {
        // get list technical skill
        $technicalSkill = $this->technicalSkillIndex->getId($technicalId);
        return \View::make('engineer_skill.technical_skill_index.edit')->with('technicalSkill', $technicalSkill);
    }

    /**
     * @author Trieu Nguyen
     * @name doEdit
     * @return Response
     */
    public function doEdit($technicalId = '')
    {
        // check update success
        $error = $this->technicalSkillIndex->doUpdate($technicalId);
        if (is_object($error) == false)
        {
            return \Redirect::route('technical-skill-manager')->withFlashMessage('Technical Skill Index Edit Successfully.');
        }
        // update error
        return \Redirect::refresh()->withErrors($error);
    }

    /**
     * @author Trieu Nguyen
     * @name doDelete
     * @return Response
     */
    /*
    public function doDelete($technicalId = '')
    {
        // check delete success
        if ($this->technicalSkillIndex->doDelete($technicalId))
        {
            return \Redirect::route('technical-skill-manager')->withFlashMessage('Technical Skill Index Deleted Successfully.');
        }
        // delete error
        $error = $this->technicalSkillIndex->errors();
        return \Redirect::refresh()->withErrors($error);
    }
    */

}
