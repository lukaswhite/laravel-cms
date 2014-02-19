<?php namespace Lukaswhite\LaravelCms\Data;

use Cms,
		Lukaswhite\LaravelCms\Model\Page,
		Lukaswhite\LaravelCms\Model\Block,
		Illuminate\Filesystem\Filesystem,
		Alchemy\Zippy\Zippy;

/**
 * The CMS backup class.
 *
 * Reponsible for creating backups (using the Exporter) and restoring them (import), as well as 
 * running scheduled backups.
 */
class Backup {

	public function __construct()
	{
		
	}

	/**
	 * Cron function
	 *  This is designed to be run as a cron job, and takes care of scheduled backups.
	 */
	public function cron()
	{

	}

	public function doBackup()
	{
		$exporter = new Exporter();

		$exporter->run(true, 'backup');
	}

}