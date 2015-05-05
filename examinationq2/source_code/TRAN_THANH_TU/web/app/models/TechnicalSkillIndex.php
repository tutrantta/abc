<?php

/**
 * TechnicalSkillIndex
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-03          Trieu Nguyen     Create File
 */
class TechnicalSkillIndex extends BaseModel {

    protected $table = 'techniques';
    protected $primaryKey = 'technique_id';
    protected $fillable = [
        'technique_id',
        'technique_name',
        'technique_description',
        'is_active'
    ];
    
    public static $rules = [
        'technique_name' => 'required|unique:techniques|max:100'
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
        self::$rules['technique_name'] = 'required|max:100|unique:techniques,technique_name,'.$id.',technique_id';
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
