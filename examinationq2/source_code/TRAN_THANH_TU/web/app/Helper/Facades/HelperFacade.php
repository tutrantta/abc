<?php
/**
 * Facade for Helper
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015/03/17          NgocNguyen
 */

namespace Helper\Facades;

use Illuminate\Support\Facades\Facade;

class HelperFacade extends Facade
{

    /**
     * @author 
     * @name getFacadeAccessor
     * @todo Get the registered name of the component.
     *
     * @return string
     * @access protected
     */
    protected static function getFacadeAccessor()
    {
        return 'helper';
    }
}