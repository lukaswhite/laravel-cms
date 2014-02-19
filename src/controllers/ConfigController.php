<?php namespace Lukaswhite\LaravelCms;

use App,
		Auth,
		Input, 
		Redirect, 
		Request,
		Validator, 
		View,
		Lukaswhite\LaravelCms\Model\Page,
		Lukaswhite\LaravelCms\Model\Block,
		Lukaswhite\LaravelCms\Repository\PagesRepository,
		Lukaswhite\LaravelCms\Repository\BlocksRepository,
		dflydev\markdown\MarkdownExtraParser;

class ConfigController extends \Controller {

	public function getIndex()
	{		
		return View::make('laravel-cms::config.index');	
	}

}