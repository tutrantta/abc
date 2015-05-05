<?php

/**
 * SoftSkillIndex
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-08          Trieu Nguyen     Create File
 */
class SoftSkillIndex extends BaseModel {

    protected $table = 'soft_skills';
    protected $primaryKey = 'soft_skill_id';
    protected $fillable = [
        'soft_skill_id',
        'soft_skill_name',
        'soft_skill_description',
        'is_active'
    ];
    
    public static $rules = [
        'soft_skill_name' => 'required|unique:soft_skills|max:100'
    ];
    /**
     * @author Trieu Nguyen
     * @name getList
     * @return object $technical_list
     */
    public function getList()
    {
        return $this->get();
    }

    /**
     * @author Trieu Nguyen
     * @name doInsert
     * @return bool
     */
    public function doInsert()
    {
        return $this->save();
    }

    /**
     * @author Trieu Nguyen
     * @name doUpdate
     * @return bool
     */
    public function doUpdate($id = '')
    {
        self::$rules['soft_skill_name'] = 'required|max:100|unique:soft_skills,soft_skill_name,'.$id.',soft_skill_id';
        $query = $this->find($id);
        if ($query->save())
        {
            return true;
        }
        return $query->errors();
    }

    /**
     * @author Trieu Nguyen
     * @name getId
     * @return object
     */
    public function getId($id = '')
    {
        return $this->find($id);
    }

    /**
     * @author Trieu Nguyen
     * @name doDelete
     * @return bool
     */
    public function doDelete($id = '')
    {
        return $this->find($id)->delete();
    }

}
