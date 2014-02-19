<?php namespace Lukaswhite\LaravelCms;

use App,
		Auth,
		Input, 
		Redirect, 
		Request,
		Response,
		Validator, 
		View,
		User,
		Lukaswhite\LaravelCms\Model\Page,
		Lukaswhite\LaravelCms\Repository\PagesRepository,
		dflydev\markdown\MarkdownExtraParser,
		Illuminate\Filesystem\Filesystem;

/**
 * Import Controller
 *
 * Allows admin to import the site content as a zipfile.
 */
class ImportController extends \Controller {

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
		return View::make('laravel-cms::import.index');	
	}

	public function postIndex()
	{
		$path = Input::get('path');

		$filesystem = new Filesystem();

		$cms = new LaravelCms($this->repository);

		$filepath = sprintf('%s/%s/', $cms->ensureExportDirectoryExists(), $path);

		$manifest = $filesystem->get(sprintf('%smanifest.json', $filepath));

		foreach (json_decode($manifest, true) as $page_info) {
			$page = new Page();
			$page->user = User::find(1);
			$page->title = $page_info['title'];
			$page->slug = $page_info['slug'];
			$page->status = $page_info['status'];
			$page->body = $filesystem->get(sprintf('%scontent/%s', $filepath, $page_info['path']));

			$page->save();
		}

		return Redirect::to('/cms');
	}

}