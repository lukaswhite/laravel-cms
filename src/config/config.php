<?php
/**
 * Laravel CMS configuration.
 */
return array(

	/**
	 * The title appears in the back-end
	 */
	'title' => 'Laravel CMS',

	/**
	 * Customise the layouts here.
	 */
	'layouts' => array(
		'public' => 'layouts.default',
		'admin' => 'laravel-cms::layouts.default',
	),

	/**
	 * Customise the page and block templates here.
	 */
	'templates' => array(
		'page' => 'laravel-cms::page.view',
		'block' => 'laravel-cms::block.view',
	),

	/**
	 * Add filters which will be fired before viewing a page (public) or accessing the back-end (admin).
	 * You'll probably want to control access to the back-end; we've defaulted to to "auth" but it might
	 * be more appropriate to check permissions as well.
	 */
	'filters' => array(
		'public' => array(),
		'admin' => array(
			'auth',
		),
	),
);