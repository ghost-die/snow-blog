<?php


namespace App\Http\Controllers\Home;


use App\Http\Controllers\BaseController;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends BaseController
{
	
	
	public function store(Request $request,Link $link)
	{
		

		$request->validate(
			[
				'name' => 'required',
				'uri' => 'required|url',
				'email' => 'required|email',
			]
		);
		
		
		$data = $request->all(['name','uri','introduction','email']);
		try {
			$data['is_top'] = 0;
			$data['status'] = 0;
			$link->query()->create($data);
			
			return back()->with('success','提交成功');
			
		}catch (\Exception $exception){
			return back()->with('error',$exception->getMessage());
			
		}
	}
}