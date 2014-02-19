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
		Lukaswhite\LaravelCms\Model\Region,
		Lukaswhite\LaravelCms\Repository\PagesRepository,
		Lukaswhite\LaravelCms\Repository\BlocksRepository,
		Lukaswhite\LaravelCms\Repository\RegionsRepository,
		dflydev\markdown\MarkdownExtraParser;

class RegionController extends \Controller {

	/**
	 * @var Lukaswhite\LaravelCms\Repository\RegionsRepository
	 */
	private $repository;

	/** 
	 * Constructor
	 *
	 * @param Lukaswhite\LaravelCms\Repository\RegionsRepository $repository
	 */
	public function __construct(RegionsRepository $repository) 
	{
		$this->repository = $repository;
	}

	public function getIndex()
	{		
		$regions = $this->repository->get();		
		return View::make('laravel-cms::region.index', array('regions' => $regions));	
	}

	public function getAdd()
	{
		return View::make('laravel-cms::region.add');
	}

	public function postAdd()
	{
		$rules = array(			
			'title' => array('max:255'),
			'machine_name' => array('required', 'unique:regions'),						
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->passes()) {

			$region = new Region();			
			$region->title = Input::get('title');
			$region->machine_name = Input::get('machine_name');
			
			$region->save();

			return Redirect::to('/cms/region')->with('message', 'Region Added');

		} else {

			return Redirect::to('/cms/region/add')->withInput()->withErrors($validator);

		}

	}

	public function getEdit($id)
	{
		$region = $this->repository->find($id);

		return View::make('laravel-cms::region.edit', array('region' => $region));	
	}

	public function postEdit($id)
	{
		$region = $this->repository->find($id);

		$rules = array(			
			'title' => array('max:255'),			
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->passes()) {
					
			$region->title = Input::get('title');
		
			$region->save();

			return Redirect::to('/cms/region')->with('message', 'Region Saved');

		} else {

			return Redirect::to('/cms/region/edit/' . $id)->withInput()->withErrors($validator);

		}
	}

	

	public function getDelete($id)
	{
		$page = $this->repository->find($id);

		return View::make('laravel-cms::region.delete', array('page' => $page));	
	}

	public function postDelete($id)
	{
		$region = $this->repository->find($id);

		$region->delete();

		return Redirect::to('/cms/region')->with('message', 'region Deleted');
	}

	public function getPreview($id)
	{
		$region = $this->repository->find($id);

		switch ($region->format) {
			case 'markdown':
				// Get the markdown parser...
				$markdownParser = new MarkdownExtraParser();

				// ...and generate the HTML markup
    		$region->content = $markdownParser->transformMarkdown($region->body);
    		break;

    	case 'html':
				$region->content = $region->body;
				break;

    	default:
				$region->content = $region->body;
		}

		return View::make('laravel-cms::region.view', array('region' => $region));	
	}

}