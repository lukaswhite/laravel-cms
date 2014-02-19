<?php namespace Lukaswhite\LaravelCms;

use View;

class HomeController extends \Controller {

	public function getIndex()
	{
		return View::make('laravel-cms::home.index');
	}

}