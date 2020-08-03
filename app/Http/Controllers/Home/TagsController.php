<?php


namespace App\Http\Controllers\Home;


use App\Http\Controllers\BaseController;
use App\Models\Label;

class TagsController extends BaseController
{
	public function index(Label $label)
	{
		
		
		$this->view = 'index';
		
		$assign = [
			'title' => '分类',
			'data' =>$label->article()->orderBy('created_at','DESC')->simplePaginate()
		];
		$this->setAssign( $assign);
		
		return $this->response();
	}
}