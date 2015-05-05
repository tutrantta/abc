<?php

/**
 * SoftSkillIndexController
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-08          Trieu Nguyen     Create File
 */

namespace EngineerSkill;

class SoftSkillIndexController extends \BaseController {

    protected $softSkillIndex;

    public function __construct(\SoftSkillIndex $softSkillIndex)
    {
        // load softSkillIndex model
        $this->softSkillIndex = $softSkillIndex;
    }

    /**
     * @author Trieu Nguyen
     * @name index
     * @return Response
     */
    public function index()
    {
        // get soft skill List
        $softSkillList = $this->softSkillIndex->getList();
        return \View::make('engineer_skill.soft_skill_index.index')->with('softSkillList', $softSkillList);
    }

    /**
     * @author Trieu Nguyen
     * @name create
     * @return Response
     */
    public function create()
    {
        return \View::make('engineer_skill.soft_skill_index.create');
    }

    /**
     * @author Trieu Nguyen
     * @name doCreate
     * @return Response
     */
    public function doCreate()
    {
        // check insert success
        if ($this->softSkillIndex->doInsert())
        {
            return \Redirect::route('soft-skill-manager')->withFlashMessage('Soft Skill Index Created Successfully.');
        }
        // insert error
        $error = $this->softSkillIndex->errors();
        return \Redirect::refresh()->withErrors($error);
    }

    /**
     * @author Trieu Nguyen
     * @name edit
     * @return Response
     */
    public function edit($technicalId = '')
    {
        // get list soft skill
        $softSkill = $this->softSkillIndex->getId($technicalId);
        return \View::make('engineer_skill.soft_skill_index.edit')->with('softSkill', $softSkill);
    }

    /**
     * @author Trieu Nguyen
     * @name doEdit
     * @return Response
     */
    public function doEdit($technicalId = '')
    {
        // check update success
        $error = $this->softSkillIndex->doUpdate($technicalId);
        if (is_object($error) == false)
        {
            return \Redirect::route('soft-skill-manager')->withFlashMessage('Soft Skill Index Edit Successfully.');
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
        if ($this->softSkillIndex->doDelete($technicalId))
        {
            return \Redirect::route('soft-skill-manager')->withFlashMessage('Soft Skill Index Deleted Successfully.');
        }
        // delete error
        $error = $this->softSkillIndex->errors();
        return \Redirect::refresh()->withErrors($error);
    }
    */

}
