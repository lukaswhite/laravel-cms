<?php namespace Lukaswhite\LaravelCms;

use Illuminate\Support\Facades\Facade;

/**
 * ImagecacheFacade
 *
 */ 
class LaravelCmsFacade extends Facade {
 
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'laravel-cms'; }
 
}