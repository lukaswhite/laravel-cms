<?php

use Lukaswhite\LaravelCms\Data\Exporter;
use Lukaswhite\LaravelCms\Model\Block;
use Lukaswhite\LaravelCms\Model\Page;

class ExportTest extends TestCase {

	/**
	 * Test page creation.
	 *
	 * @return void
	 */
	public function testRun()
	{
		$this->assertTrue(true);

		/***********************
		 * Create some test data
		 ***********************/

		// First, some pages...
		$pages = array(
			array(
				'title' 	=>	'Export Test Page One',
				'slug'		=>	'export-test-page-one',
				'format'	=>	'markdown',
				'body'  	=>	'##Export Test Page One Content',				
				'status'  =>	Page::PUBLISHED,
			),
			array(
				'title' 	=>	'Export Test Page Two',
				'slug'		=>	'export-test-page-two',
				'format'	=>	'markdown',
				'body'  	=>	'##Export Test Page Two Content',				
				'status'  =>	Page::UNPUBLISHED,
			),
			array(
				'title' 	=>	'Export Test Page Three',
				'slug'		=>	'export-test-page-three',
				'format'	=>	'html',
				'body'  	=>	'<h2>Export Test Page One Content</h2>',				
				'status'  =>	Page::PUBLISHED,
			),
		);

		foreach ($pages as $page_info) {
			$page = new Page();
			$page->title 		= $page_info['title'];
			$page->slug 		= $page_info['slug'];
			$page->user_id	=	1;
			$page->format 	= $page_info['format'];
			$page->body 		= $page_info['body'];
			$page->save();
		}

		// Now, some blocks...
		$blocks = array(
			array(
				'admin_title' 	=>	'Export Test Block One',
				'title' 				=>	'Export Test Block One Page Title',				
				'format'				=>	'markdown',
				'body'  				=>	'##Export Test Block One Content',				
				'status' 		 		=>	Block::PUBLISHED,
			),
			array(
				'admin_title' 	=>	'Export Test Block Two',
				'title' 				=>	'',				
				'format'				=>	'markdown',
				'body'  				=>	'##Export Test Block Two Content',				
				'status' 		 		=>	Block::UNPUBLISHED,
			),
			array(
				'admin_title' 	=>	'Export Test Block Three',
				'title' 				=>	'Export Test Block Three Page Title',				
				'format'				=>	'html',
				'body'  				=>	'<h2>Export Test Block Three Content</h2>',				
				'status' 		 		=>	Block::PUBLISHED,
			),
		);

		foreach ($blocks as $block_info) {
			$block = new Page();
			$block->admin_title 		= $block_info['admin_title'];
			$block->title 					= $block_info['title'];			
			$block->user_id					=	1;
			$block->format 					= $block_info['format'];
			$block->body 						= $block_info['body'];
			$block->save();
		}

	}

}