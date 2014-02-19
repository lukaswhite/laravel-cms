<?php namespace Lukaswhite\LaravelCms\Repository;

use Lukaswhite\LaravelCms\Model\Block;

class BlocksRepository {

	public function fetch($slug) 
	{
		return Block::where('slug', '=', $slug)->first();
	}

	public function find($id) 
	{
		return Block::find($id);
	}

	public function byMachineName($machine_name)
	{
		return Block::where('machine_name', '=', $machine_name)->first();
	}

	public function get($conditions = array())
	{	
		$query = Block::orderBy('created_at', 'desc');

		if ((is_array($conditions)) && (count($conditions))) {
			foreach ($conditions as $field => $value) {
				$query->where($field, '=', $value);
			}
		}

		return $query->paginate(20);
	}

	public function delete(Block $block) {
		$block->delete();
	}

}