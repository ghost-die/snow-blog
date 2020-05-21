<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;

use App\Traits\HasAdminResourceActions;

class CategoryController extends Controller
{
	use HasAdminResourceActions;
	
	
	public $model = ArticleCategory::class;
	
	public $input = [
		'name',
	];
	
	public $home = 'category';
	
	
	public function index()
	{
		
		$this->data = [
			'data'=>$this->data()
		];
		
		$this->setView('category.index');
		
		return $this->view();
	}
	
	
	public function store()
	{
		$data = request($this->input);
		
		
		try {
			$this->model::create([
				'name'=>$data['name'],
				'user_id'=>auth()->id(),
			]);
			
			return redirect(admin_url($this->home))->with('success','操作成功');
		}catch (\Exception $exception)
		{
			return back()->with('error',$exception->getMessage());
		}
		
	}
}