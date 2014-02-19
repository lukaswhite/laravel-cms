<?php namespace Lukaswhite\LaravelCms\Data;

use Cms,
		Lukaswhite\LaravelCms\Model\Page,
		Lukaswhite\LaravelCms\Model\Block,
		Illuminate\Filesystem\Filesystem,
		Alchemy\Zippy\Zippy;

class Exporter {

	public function __construct()
	{
		
	}

	public function run($include_unpublished = false, $prefix = 'export')
	{
		// Get the pages
		if (!$include_unpublished) {
			$pages = Cms::pages()->get(array('status' => Page::PUBLISHED));
			$blocks = Cms::blocks()->get(array('status' => Block::PUBLISHED));
		} else {
			$pages = Cms::pages()->get();
			$blocks = Cms::blocks()->get();
		}
		
		$export_filepath = Cms::ensureExportDirectoryExists();

		$filesystem = new Filesystem();

		$export_id = sprintf('/%s_%s', $prefix, date('YmdHis'));

		$export_filepath .= '/' . $export_id;

		$content_filepath = sprintf('%s/content/', $export_filepath);
		$pages_filepath = sprintf('%spages/', $content_filepath);
		$blocks_filepath = sprintf('%sblocks/', $content_filepath);
		
		$filesystem->makeDirectory($pages_filepath, 0777, true);
		$filesystem->makeDirectory($blocks_filepath, 0777, true);

		$export = array(
			'pages' => array(),
			'blocks' => array(),
		);

		foreach ($pages as $page) {

			$filename = sprintf('%s.md', $page->slug);

			$export['pages'][] = array(
				'title'				=>	$page->title,
				'slug'				=>	$page->slug,
				'status'			=>	$page->status,				
				'format'			=>	$page->format,
				'path'				=>	$filename,
			);			

			if ($pos = strripos($filename, '/')) {				
				$filesystem->makeDirectory($pages_filepath . substr($filename, 0, $pos), 0777, true);
			}

			$filesystem->put(sprintf('%s%s', $pages_filepath, $filename), $page->body);

		}

		foreach ($blocks as $block) {

			$filename = sprintf('%s.md', $block->machine_name);

			$export['blocks'][] = array(
				'admin_title'		=>	$block->admin_title,
				'title'					=>	$block->title,
				'machine_name'	=>	$block->machine_name,
				'status'				=>	$block->status,
				'format'				=>	$block->format,
				'path'					=>	$filename,
			);			

			$filesystem->put(sprintf('%s%s', $blocks_filepath, $filename), $block->body);

		}

		$filesystem->put(sprintf('%s/manifest.json', $export_filepath), json_encode($export));

		$zippy = Zippy::load();
		
		$zip_filepath = sprintf('%s%s.zip', Cms::ensureExportDirectoryExists(), $export_id);

		$archive = $zippy->create($zip_filepath, array(
		    'folder' => $export_filepath), true);


	}

}