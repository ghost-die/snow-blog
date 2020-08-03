<?php


namespace App\Http\Controllers\Home;


use App\Http\Controllers\BaseController;
use App\Models\Article;
use Illuminate\Http\Request;


class IndexController extends BaseController
{
	public function index(Article $article)
	{
		
		
		$this->view = 'index';
		
		
		$assign = [
			'title' => '首页',
			'data' =>$article->getPaginateData()
		];
		$this->setAssign( $assign);
		
		return $this->response();
	}
	
	public function link(Request $request)
	{
		$assign = [
			'title' => '首页',
			'link' => urldecode($request->url),
		];
		
		$this->setView('pages.link');
		$this->setAssign( $assign);
		
		return $this->response();
	}
}