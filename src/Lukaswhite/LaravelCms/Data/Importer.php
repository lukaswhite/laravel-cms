<?php namespace Lukaswhite\LaravelCms\Data;

use Cms,
		Lukaswhite\LaravelCms\Model\Page,
		Lukaswhite\LaravelCms\Model\Block,
		Illuminate\Filesystem\Filesystem,
		Alchemy\Zippy\Zippy;

class Importer {

	public function __construct()
	{
		
	}

	public function run($path, $overwrite = false)
	{
		$filesystem = new Filesystem();

		$cms = new LaravelCms($this->repository);

		$filepath = sprintf('%s/%s/', $cms->ensureExportDirectoryExists(), $path);

		$manifest = $filesystem->get(sprintf('%smanifest.json', $filepath));

		$import = json_decode($manifest, true);

		foreach ($import['pages'] as $page_info) {
			$page = new Page();
			$page->user = Auth::user();
			$page->title = $page_info['title'];
			$page->slug = $page_info['slug'];
			$page->status = $page_info['status'];
			$page->format = $page_info['format'];
			$page->body = $filesystem->get(sprintf('%scontent/pages/%s', $filepath, $page_info['path']));

			$page->save();
		}

		foreach ($import['blocks'] as $block_info) {
			$block = new Page();
			$block->user = Auth::user();
			$block->admin_title = $block_info['admin_title'];
			$block->title = $block_info['title'];
			$block->machine_name = $block_info['machine_name'];
			$block->status = $block_info['status'];
			$block->format = $block_info['format'];
			$block->body = $filesystem->get(sprintf('%scontent/blocks/%s', $filepath, $block_info['machine_name']));

			$page->save();
		}
	}

}