<?php


namespace App\Http\Controllers\Home;


use App\Http\Controllers\BaseController;
use App\Models\Article;
use Illuminate\Support\Facades\Cache;

class GeneratedController extends BaseController
{
	public function feed(Article $article)
	{
		

		
		$data = Cache::remember('Article.feed',3600,function (){
			
			return Article::all();
			
		});
		
		
		
		
		return response()->view('generated.feed',compact('data'))->header('Content-Type', 'text/xml');
	}
}