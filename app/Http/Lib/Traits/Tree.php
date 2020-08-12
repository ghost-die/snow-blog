<?php


namespace App\Http\Lib\Traits;


use Illuminate\Support\Facades\DB;

trait Tree
{
	
	protected $menu = [];
	/**
	 * @var string
	 */
	protected $parent = 'parent_id';
	
	/**
	 * @var string
	 */
	protected $key = 'id';
	
	/**
	 * @var string
	 */
	protected $title = 'title';
	
	/**
	 * @var string
	 */
	protected $order = 'order';
	
	
	/**
	 * Format data to tree like array.
	 *
	 * @return array
	 */
	public function toTree()
	{
		return $this->buildNestedArray();
	}
	
	/**
	 * Build Nested array.
	 *
	 * @param array $nodes
	 * @param int   $parentId
	 *
	 * @return array
	 */
	protected function buildNestedArray(array $nodes = [], $parentId = 0)
	{
		$branch = [];
		
		if (empty($nodes)) {
			$nodes = $this->getMenu();
		}
		
		foreach ($nodes as $node) {
			if ($node[$this->parent] == $parentId) {
				$children = $this->buildNestedArray($nodes, $node[$this->key]);
				
				if ($children) {
					$node['children'] = $children;
				}
				
				$branch[] = $node;
			}
		}
		
		return $branch;
	}
	
	
	
	public function setMenu($menu)
	{
		$this->menu = $menu;
		return $this;
	}
	public function getMenu()
	{
		return $this->menu;
	}
	
}