<?php


namespace App\Http\Controllers\Home;


use App\Http\Controllers\BaseController;
use App\Models\Article;
use App\Models\Label;
use Illuminate\Http\Request;

class SearchController extends BaseController
{
	public function index(Request $request,Article $article)
	{
		
		
		$search = $request->get('search');
		
		
		$data = $article
			->query()
			->where('title','like','%'.$search.'%')
			->orderBy('created_at','DESC')
			->simplePaginate();
		
		
		$data = dataFormatting($data);
		
		
		
		$this->view = 'index.index';
		
		$assign = [
			'title' => '分类',
			'data' =>$data
		];
		$this->setAssign( $assign);
		
		return $this->response();
	}
}