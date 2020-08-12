<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Lib\Layout\Content;
use App\Models\ArticleCategory;

use App\Traits\HasAdminResourceActions;
use DebugBar\DebugBar;

class CategoryController extends BaseController
{
	use HasAdminResourceActions;
	
	protected $title = 'Category';
	
	public $model = ArticleCategory::class;
	
	public $input = [
		'name',
	];
	
	public $home = 'category';
	
	
	public function grid()
	{
		
		$this->data = [
			'data'=>$this->data()
		];
		
		$this->setView('category.index');
		
		
		return view($this->view,$this->data);
		
	}
	
	
	public function store()
	{
		$data = request($this->input);
		
		
		try {
			$this->model::create([
				'name'=>$data['name'],
				'user_id'=>auth()->id(),
			]);
			
			return notification('操作成功','success');
		}catch (\Exception $exception)
		{
			return notification($exception->getMessage(),'error');
			
		}
		
	}
}