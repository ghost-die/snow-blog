<?php


namespace App\Http\Controllers\Admin;


use App\Http\Lib\ResponseServe;

use App\Models\Article;
use App\Models\Link;
use App\Traits\HasAdminResourceActions;
use Illuminate\Http\Request;

class LinkController extends BaseController
{
	use HasAdminResourceActions,ResponseServe;
	
	public $model = Link::class;
	
	public $home = 'link';
	
	
	public function index()
	{
		
		$this->data = [
			'data'=>$this->data(),
		];
		
		$this->setView('link.index');
		
		return $this->view();
	}
	
	public function create()
	{
		
		$this->setView('link.create');
		
		return $this->view();
	}
	
	
	public function store(Request $request,Link $link)
	{
		$this->validate = [
			'name' => 'required',
			'uri' => 'required|url',
//			'introduction' => 'required',
//			'email' => 'required|email',
			'is_top' => 'required',
			'status' => 'required',
		];
		
//		$this->validateMessage = [];
		$this->validationMessages($request);
		$data = $request->all(['name','uri','introduction','email','is_top','status']);
		try {
			$link->query()->create($data);
			return notification('创建成功','success',route('admin.link.index'));
		}catch (\Exception $exception){
			return notification($exception->getMessage(),'error');
		}
	}
	
	public function edit(Link $link)
	{
		$this->data = [
			'link'=>$link,
		];
		
		$this->setView('link.edit');
		
		return $this->view();
	}
	
	public function update(Request $request,Link $link)
	{
		$this->validate = [
			'name' => 'required',
			'uri' => 'required|url',
			
			'is_top' => 'required',
			'status' => 'required',
		];
		
		$this->validationMessages($request);
		$data = $request->all(['name','uri','introduction','email','is_top','status']);
		
		try {
			$link->name = $data['name'];
			$link->uri = $data['uri'];
			$link->introduction = $data['introduction'];
			$link->email = $data['email'];
			$link->is_top = $data['is_top'];
			$link->status = $data['status'];
			
			$link->save();
			
			return notification('更新成功','success',route('admin.link.index'));
		}catch (\Exception $exception){
			return notification($exception->getMessage(),'error');
		}
	}
	
	public function destroy(Link $link)
	{
		
		if ($link->delete())
		{
			return $this->success([]);
		}else{
			return $this->failed('删除失败');
			
		}
		
	}
	
}