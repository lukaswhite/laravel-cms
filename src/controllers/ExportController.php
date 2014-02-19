<?php namespace Lukaswhite\LaravelCms;

use App,
		Auth,
		Input, 
		Redirect, 
		Request,
		Response,
		Validator, 
		View,		
		Lukaswhite\LaravelCms\Data\Exporter,
		Lukaswhite\LaravelCms\Model\Page,
		Lukaswhite\LaravelCms\Repository\PagesRepository,
		dflydev\markdown\MarkdownExtraParser,
		Illuminate\Filesystem\Filesystem,
		Alchemy\Zippy\Zippy;

/**
 * Export Controller
 *
 * Allows admin to export the site content as a zipfile.
 */
class ExportController extends \Controller {

	/**
	 * @var Lukaswhite\LaravelCms\Repository\PagesRepository
	 */
	private $repository;

	/** 
	 * Constructor
	 *
	 * @param Lukaswhite\LaravelCms\Repository\PagesRepository $repository
	 */
	public function __construct(PagesRepository $repository) 
	{
		$this->repository = $repository;
	}

	public function getIndex()
	{				
		return View::make('laravel-cms::export.index');	
	}

	public function postIndex()
	{
		// Include unpublished?
		$include_unpublished = Input::get('unpublished');
		
		$exporter = new Exporter();

		$exporter->run($include_unpublished);

		return Redirect::to('/cms/export');
	}

}