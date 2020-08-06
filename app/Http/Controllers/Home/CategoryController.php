<?php


namespace App\Http\Controllers\Home;


use App\Http\Controllers\BaseController;
use App\Models\Article;
use App\Models\ArticleCategory;

class CategoryController extends BaseController
{
	
	
	
	public function index(ArticleCategory $articleCategory)
	{
		
		
		$this->view = 'index';
		
		$data = $articleCategory->article()->orderBy('created_at','DESC')->simplePaginate();
		
		$data = dataFormatting($data->items());
		
		
		$assign = [
			'title' => '分类',
			'data' =>$data,
			'category_id'=>$articleCategory->id,
		];
		$this->setAssign( $assign);
		
		return $this->response();
	}
}