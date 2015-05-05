<?php
/**
 * Service for Helper
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015/03/17          NgocNguyen
 */

namespace Helper\Services;

use Illuminate\Support\ServiceProvider;

class ValidationExtensionServiceProvider extends ServiceProvider
{

    /**
     * @author 
     * @name register
     * @todo Register the service provider.
     *
     * @access public
     */
    public function register()
    {
        // TODO: Implement register() method.
    }

    public function boot()
    {
        $this->app->validator->resolver(function ($translator, $data, $rules, $messages = [], $customAttributes = []) {
            return new Validation\ValidatorExtended($translator, $data, $rules, $messages, $customAttributes);
        });
    }
}