<?php
/**
 * Service for Helper
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015/03/17          NgocNguyen
 */

namespace Helper\Services;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
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
        $this->app['helper'] = $this->app->share(function ($app) {
            return new \Helper\Facades\Helper();
        });
    }
}