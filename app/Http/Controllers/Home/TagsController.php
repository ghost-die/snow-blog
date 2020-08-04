<?php


namespace App\Http\Controllers\Home;


use App\Http\Controllers\BaseController;
use App\Models\Label;

class TagsController extends BaseController
{
	public function index(Label $label)
	{
		
		
		$this->view = 'index';
		
		$data = $label->article()->orderBy('created_at','DESC')->simplePaginate();
		
		$data = dataFormatting($data);
		
		$assign = [
			'title' => '分类',
			'data' =>$data
		];
		$this->setAssign( $assign);
		
		return $this->response();
	}
}