<?php namespace Lukaswhite\LaravelCms;

use App,
		Auth,
		Input, 
		Redirect, 
		Request,
		Validator, 
		View,
		Cms,
		Lukaswhite\LaravelCms\Model\Page,
		Lukaswhite\LaravelCms\Repository\PagesRepository,
		dflydev\markdown\MarkdownExtraParser;

class PageController extends \Controller {

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

	/**
	 * The Page index.
	 *  Lists the pages in the CMS.
	 */
	public function getIndex()
	{		
		$pages = $this->repository->get();		
		return View::make('laravel-cms::page.index', array('pages' => $pages));	
	}

	/**
	 * Add Page.
	 *  Displays the add page form.
	 */
	public function getAdd()
	{
		return View::make('laravel-cms::page.add');
	}

	/**
	 * Add Page POST callback.
	 *  Responsible for creating new pages.
	 */
	public function postAdd()
	{
		$rules = array(
			'title' => array('required', 'max:255'),
			'slug' => array('required', 'unique:pages'),			
			'body' => 'required',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->passes()) {

			$page = new Page();
			$page->title = Input::get('title');
			$page->slug = Input::get('slug');
			$page->body = Input::get('body');
			//$page->user = Auth::user();
			$page->user_id = 1;
			$page->format = 'markdown';
			$page->status = Input::get('status');
			$page->status = 1;

			$page->save();
			
			// Regenerate the routes
			Cms::generateRoutes();

			return Redirect::to('/cms/page')->with('message', 'Page Created');

		} else {

			return Redirect::to('/cms/page/add')->withInput()->withErrors($validator);

		}

	}

	/**
	 * Edit Page.
	 *  Displays the edit page form.
	 *
	 * @param int $id
	 */
	public function getEdit($id)
	{
		$page = $this->repository->find($id);

		if (!$page) {
			App::abort(404);
		}

		return View::make('laravel-cms::page.edit', array('page' => $page));	
	}

	/**
	 * Edit Page POST callback.
	 *  Saves changes to the appropriate page.
	 *
	 * @param int $id
	 */
	public function postEdit($id)
	{
		$page = $this->repository->find($id);

		if (!$page) {
			App::abort(404);
		}

		$rules = array(
			'title' => array('required', 'max:255'),
			'slug' => array('required', 'unique:pages'),			
			'body' => 'required',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->passes()) {
		
			$page->title = Input::get('title');
			$page->slug = Input::get('slug');
			$page->body = Input::get('body');
			
			$page->status = Input::get('status');			

			$page->save();

			// Regenerate the routes
			Cms::generateRoutes();

			return Redirect::to('/cms/page')->with('message', 'Page Saved');

		} else {

			return Redirect::to('/cms/page/edit/' . $id)->withInput()->withErrors($validator);

		}
	}

	/**
	 * Delete Page.
	 *  Displays a confirmation form for deleting the given page.
	 *
	 * @param int $id
	 */
	public function getDelete($id)
	{
		$page = $this->repository->find($id);

		if (!$page) {
			App::abort(404);
		}

		return View::make('laravel-cms::page.delete', array('page' => $page));	
	}

	/**
	 * Delete Page POST callback.
	 *  Deletes the appropriate page.
	 *
	 * @param int $id
	 */
	public function postDelete($id)
	{
		$page = $this->repository->find($id);

		if (!$page) {
			App::abort(404);
		}

		$page->delete();

		// Regenerate the routes
		Cms::generateRoutes();

		return Redirect::to('/cms/page')->with('message', 'Page Deleted');
	}

	/**
	 * Preview Page.
	 *  Preview a given page.
	 *
	 * @param int $id
	 */
	public function getPreview($id)
	{
		$page = $this->repository->find($id);

		// Get the page content, as HTML
		switch ($page->format) {
			case 'markdown':
				$markdownParser = new MarkdownExtraParser();
    		$content = $markdownParser->transformMarkdown($page->body);
    		break;

  		case 'html':
    		$content = $page->body;
    		break;

   		default:
   			$content = $page->body;
		}

		return View::make('laravel-cms::page.preview', array('page' => $page, 'content' => $content));	
	}

}