<?php


namespace App\Http\Controllers\Admin;





use App\Http\Lib\Layout\Content;
use Illuminate\Support\Arr;

class DemoController extends BaseController
{
	public function index(Content $content)
	{
		
		
		
		
		return $content->title('DEMO')->description('demo')->view('admin.article.index');
	}
	
	
	
	public  function title()
	{
		return view('admin.demo.index');
	}
}