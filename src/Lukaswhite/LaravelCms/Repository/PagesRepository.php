<?php namespace Lukaswhite\LaravelCms\Repository;

use Lukaswhite\LaravelCms\Model\Page;

class PagesRepository {

	public function fetch($slug) 
	{
		return Page::where('slug', '=', $slug)->first();
	}

	public function find($id) 
	{
		return Page::find($id);
	}

	public function get($conditions = array())
	{	
		$query = Page::orderBy('created_at', 'desc');

		if ((is_array($conditions)) && (count($conditions))) {
			foreach ($conditions as $field => $value) {
				$query->where($field, '=', $value);
			}
		}

		return $query->paginate(20);
	}

	public function delete(Page $page) {
		$page->delete();
	}

}