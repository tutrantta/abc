<?php
/**
 * Helper for Internal System
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015/03/17		   NgocNguyen
 */

namespace Helper\Facades;

class Helper
{	
	public function __construct() 
    {

    }

    public static function ShowErrorsMessage($errors){
        if(\Session::has('errors')){
            $tags = '<div class="alert alert-danger alert-dismissible" role="alert">';
            $tags .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            $tags.= '<strong>Error!</strong><br/>';
            foreach ($errors->all() as $error){
                $tags.=$error.'<br />';
            }
            $tags.='</div>';
            return $tags;
        }
        return false;
    }

    public static function ShowSuccessMessage(){
        if(\Session::has('flash_message')){
            $tags = '<div class="alert alert-success">';
            $tags .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            $tags.= '<strong>Well done!</strong> ';
            $tags.=\Session::get('flash_message');
            $tags.='</div>';
            return $tags;
        }
        return null;
    }

    public static function globalXssClean()
    {
        $sanitized = static::arrayStripTags(\Input::get());
        \Input::merge($sanitized);
    }

    public static function arrayStripTags($array)
    {
        $result = array();
        foreach ($array as $key => $value) {
            $key = strip_tags($key);
            if (is_array($value)) {
                $result[$key] = static::arrayStripTags($value);
            } else {
                $result[$key] = trim(strip_tags($value));
            }
        }
        return $result;
    }
}