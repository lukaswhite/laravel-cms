<?php namespace Lukaswhite\LaravelCms;

class BaseController extends \Controller {

	public function __construct() {
		/**
		if (!Authority::can('access', 'admin')) {
			App::abort(401);
		}
		**/
	}

}