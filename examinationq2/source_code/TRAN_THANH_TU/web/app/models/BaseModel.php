<?php

/**
 * Create Base Model
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015/03/17          NgocNguyen
 */

use \LaravelBook\Ardent\Ardent;

class BaseModel extends Ardent
{

    // hydrates on new entries' validation
    public $autoHydrateEntityFromInput = true;

    // hydrates whenever validation is called
    public $forceEntityHydrationFromInput = true;

    // not save confirm fields
    public $autoPurgeRedundantAttributes = true;

    /**
     * Create a new Ardent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->setPerPage(10);
    }
}   