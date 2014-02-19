<?php namespace Lukaswhite\LaravelCms\Repository;

use Lukaswhite\LaravelCms\Model\Region;

class RegionsRepository {

	public function find($id) 
	{
		return Region::find($id);
	}

	public function byMachineName($machine_name)
	{
		return Region::where('machine_name', '=', $machine_name)->first();
	}

	public function get()
	{	
		return Region::get();
	}

	public function delete(Region $region) {
		$region->delete();
	}

}