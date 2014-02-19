<?php namespace Lukaswhite\LaravelCms;

use Lukaswhite\LaravelCms\Model\Page;
use Lukaswhite\LaravelCms\Model\Block;
use Lukaswhite\LaravelCms\Repository\PagesRepository;
use Lukaswhite\LaravelCms\Repository\BlocksRepository;
use Illuminate\Filesystem\Filesystem;
use dflydev\markdown\MarkdownExtraParser;
use View;

class LaravelCms {

	/**
	 * @var Lukaswhite\LaravelCms\Repository\PagesRepository $repository
	 * 				The page repository
	 */
	private $pages;

	/**
	 * @var Lukaswhite\LaravelCms\Repository\PagesRepository $repository
	 * 				The block repository
	 */
	private $blocks;

	/**
	 * Constructor
	 *
	 * @param Lukaswhite\LaravelCms\Repository\PagesRepository $repository
	 */
	public function __construct(PagesRepository $pages, BlocksRepository $blocks)
	{
		$this->pages = $pages;
		$this->blocks = $blocks;
	}

	public function pages() {
		return $this->pages;
	}

	public function blocks() {
		return $this->blocks;
	}

	/**
	 * Generate routes to published pages.
	 */
	public function generateRoutes()
	{
		$lines = array();
		
		// Get all published pages
		$pages = $this->pages->get(array('status' => Page::PUBLISHED));		

		// Create an array of route declarations
		foreach ($pages as $page) {
			$lines[] = sprintf('Route::get("%s", "Lukaswhite\LaravelCms\ViewController@page", array("slug" => "%s"));', $page->slug, $page->slug);
		}

		// Build the file contents
		$contents = "<?php\n" . implode("\n", $lines);

		$filepath = storage_path().'/cms/';
		$filename = $filepath . 'routes.php';

		$filesystem = new Filesystem();

		// if the appropriate directory does not exist, create it
		if (!file_exists($filepath)) {
			$filesystem->makeDirectory($filepath, 0777, true);
		}

		// Now write the routes file.
		if ($fp = fopen($filename, 'w')) {
			fwrite($fp, $contents);
			fclose($fp);
		} else {
			throw new \Exception('CMS: could not write routes file.');
		}

	}

	public function ensureCmsDirectoryExists() 
	{
		$filepath = storage_path().'/cms/';		

		$filesystem = new Filesystem();

		// if the appropriate directory does not exist, create it
		if (!file_exists($filepath)) {
			$filesystem->makeDirectory($filepath, 0777, true);
		}

		return $filepath;
	}

	public function ensureExportDirectoryExists() {

		return $this->ensureCmsDirectoryExists() . 'export';

	}

	public function block($machine_name, $callback = FALSE) {
		
		if ($callback) {
			if (!call_user_func($callback)) {
				return '';
			}
		}

		$block = $this->blocks->byMachineName($machine_name);

		// If the block cannot be found, return nothing
		if (!$block) {
			return '';
		}

		// If the block isn't published, return nothing
		// @todo check access; admins should be able to edit an unpublished block
		if (!$block->status == Block::PUBLISHED) {
			return '';
		}
		
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

	public function region($machine_name) {
		//return $machine_name;
	}

}