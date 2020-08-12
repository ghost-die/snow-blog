<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Lib\Layout\Content;

class BaseController extends Controller
{
	
	/**
	 * Title for current resource.
	 *
	 * @var string
	 */
	protected $title = 'Title';
	
	/**
	 * Set description for following 4 action pages.
	 *
	 * @var array
	 */
	protected $description = [
		//        'index'  => 'Index',
		//        'show'   => 'Show',
		//        'edit'   => 'Edit',
		//        'create' => 'Create',
	];
	
	/**
	 * Get content title.
	 *
	 * @return string
	 */
	protected function title()
	{
		return $this->title;
	}
	
	/**
	 * Index interface.
	 *
	 * @param Content $content
	 *
	 * @return Content
	 */
	public function index(Content $content)
	{
		return $content
			->title(__($this->title()))
			->description($this->description['index'] ?? __('List'))
			->body($this->grid());
	}
	
	
	public function create(Content $content)
	{
		return $content
			->title(__($this->title()))
			->description($this->description['index'] ?? __('List'))
			->body($this->form());
	}
	
}