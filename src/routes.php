<?php

//Route::controller('cms', 'HomeController');

/**
 * Admin routes
 */
Route::get('cms', 'Lukaswhite\LaravelCms\HomeController@getIndex');
Route::controller('cms/page', 'Lukaswhite\LaravelCms\PageController');
Route::controller('cms/block', 'Lukaswhite\LaravelCms\BlockController');
Route::controller('cms/config', 'Lukaswhite\LaravelCms\ConfigController');
Route::controller('cms/region', 'Lukaswhite\LaravelCms\RegionController');
Route::controller('cms/import', 'Lukaswhite\LaravelCms\ImportController');
Route::controller('cms/export', 'Lukaswhite\LaravelCms\ExportController');

/**
 * Now include the routes to the actual pages.
 */
$routes_filename = storage_path().'/cms/routes.php';

if (file_exists($routes_filename)) {
	include $routes_filename;
}