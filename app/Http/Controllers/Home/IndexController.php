<?php


namespace App\Http\Controllers\Home;


use App\Http\Controllers\BaseController;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use function GuzzleHttp\Psr7\str;


class IndexController extends BaseController
{
	public function index(Article $article)
	{
		
		
		$this->view = 'index';
		
		$data = $article->getPaginateData();
		
		$data = dataFormatting($data->items());
		
		$assign = [
			'title' => '首页',
			'data' =>$data
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