<?php namespace Lukaswhite\LaravelCms;

use Illuminate\Support\ServiceProvider;
use Lukaswhite\LaravelCms\Repository\PagesRepository;
use Lukaswhite\LaravelCms\Repository\BlocksRepository;

class LaravelCmsServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('lukaswhite/laravel-cms');

		include __DIR__ . '/../../routes.php';
		include __DIR__ . '/../../filters.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//$this->app['config']->package('lukaswhite/imagecache', __DIR__.'/../config');

		$pages = new PagesRepository();
		$blocks = new BlocksRepository();

		$this->app['laravel-cms'] = $this->app->share(function($app) use ($pages, $blocks) 
		{
			return new LaravelCms($pages, $blocks);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('LaravelCms');
	}

}