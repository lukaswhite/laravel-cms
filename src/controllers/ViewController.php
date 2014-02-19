<?php namespace Lukaswhite\LaravelCms;

use App,		
		Input, 
		Redirect, 
		Request,		
		View,
		Lukaswhite\LaravelCms\Model\Page,
		Lukaswhite\LaravelCms\Repository\PagesRepository,
		dflydev\markdown\MarkdownExtraParser;

class ViewController extends \Controller {

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
	 * View a page
	 */
	public function page($slug = null) 
	{
		if (!$slug) {
			$slug = Request::path();
		}

		if ($page = $this->repository->fetch($slug)) {
		
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

   		return View::make('laravel-cms::page.view', array('page' => $page, 'content' => $content));	 	

		} else {

			App::abort(404);

		}
	}

}