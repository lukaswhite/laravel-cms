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
		Lukaswhite\LaravelCms\Repository\RegionsRepository,
		dflydev\markdown\MarkdownExtraParser;

class BlockController extends \Controller {

	/**
	 * @var Lukaswhite\LaravelCms\Repository\BlocksRepository
	 */
	private $blocks;

	/**
	 * @var Lukaswhite\LaravelCms\Repository\RegionsRepository
	 */
	private $regions;

	/** 
	 * Constructor
	 *
	 * @param Lukaswhite\LaravelCms\Repository\BlocksRepository $blocks
	 */
	public function __construct(BlocksRepository $blocks, RegionsRepository $regions) 
	{
		$this->blocks = $blocks;
		$this->regions = $regions;
	}

	public function getIndex()
	{		
		$blocks = $this->blocks->get();		
		return View::make('laravel-cms::block.index', array('blocks' => $blocks));	
	}

	public function getAdd()
	{
		return View::make('laravel-cms::block.add');
	}

	public function postAdd()
	{
		$rules = array(
			'admin_title' => array('required', 'max:255'),
			'title' => array('max:255'),
			'machine_name' => array('required', 'unique:blocks'),			
			'body' => 'required',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->passes()) {

			$block = new Block();
			$block->admin_title = Input::get('admin_title');
			$block->title = Input::get('title');
			$block->machine_name = Input::get('machine_name');
			$block->body = Input::get('body');
			$block->classes = Input::get('classes');
			//$block->user = Auth::user();
			$block->user_id = 1;
			$block->format = 'markdown';
			$block->status = Input::get('status');			

			$block->save();

			return Redirect::to('/cms/block')->with('message', 'Block Added');

		} else {

			return Redirect::to('/cms/block/add')->withInput()->withErrors($validator);

		}

	}

	public function getEdit($id)
	{
		$block = $this->blocks->find($id);

		return View::make('laravel-cms::block.edit', array('block' => $block, 'return_url' => Input::get('return_url', '')));	
	}

	public function postEdit($id)
	{
		$block = $this->blocks->find($id);

		$rules = array(
			'admin_title' => array('required', 'max:255'),
			'title' => array('max:255'),
			//'machine_name' => array('required', 'unique:blocks'),			
			'body' => 'required',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->passes()) {
		
			$block->admin_title = Input::get('admin_title');
			$block->title = Input::get('title');
			//$block->machine_name = Input::get('machine_name');
			$block->body = Input::get('body');
			$block->classes = Input::get('classes');
			$block->status = Input::get('status');			

			$block->save();

			if (strlen(Input::get('return_url', ''))) {
				return Redirect::to(Input::get('return_url'))->with('message', 'Block Saved');				
			}

			return Redirect::to('/cms/block')->with('message', 'Block Saved');

		} else {

			return Redirect::to('/cms/block/edit/' . $id)->withInput()->withErrors($validator);

		}
	}

	

	public function getDelete($id)
	{
		$region = $this->blocks->find($id);

		return View::make('laravel-cms::block.delete', array('region' => $region));	
	}

	public function postDelete($id)
	{
		$block = $this->blocks->find($id);

		$block->delete();

		return Redirect::to('/cms/block')->with('message', 'Block Deleted');
	}

	public function getPreview($id)
	{
		$block = $this->blocks->find($id);

		switch ($block->format) {
			case 'markdown':
				// Get the markdown parser...
				$markdownParser = new MarkdownExtraParser();

				// ...and generate the HTML markup
    		$block->content = $markdownParser->transformMarkdown($block->body);
    		break;

    	case 'html':
				$block->content = $block->body;
				break;

    	default:
				$block->content = $block->body;
		}

		return View::make('laravel-cms::block.view', array('block' => $block));	
	}

	public function getPlace()
	{
		$blocks = $this->blocks->get();		
		$regions = $this->regions->get();		
		return View::make('laravel-cms::block.place', array('blocks' => $blocks, 'regions' => $regions));		
	}
	

}