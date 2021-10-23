<?php


namespace App\Http\Controllers\Admin;


use App\Http\Lib\Traits\ResponseServe;
use App\Traits\HasAdminResourceActions;
use Illuminate\Http\Request;

class ConfigController extends BaseController
{
	use HasAdminResourceActions,ResponseServe;
	
	public function grid()
	{
		
		
		$this->setView('setting.index');
		
		return view($this->view,$this->data);
	}
	
	public function store(Request $request)
	{
		dd($request->all());
	}
}