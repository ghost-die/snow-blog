<?php


namespace App\Http\Controllers;




use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Label;
use App\Models\Link;

class BaseController extends Controller
{
	public $assign = [
		'title' => '用户中心'
	];
	
	protected $view = '';
	
	
	
	
	/**
	 * 输出视图文件
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function response()
	{
		return view($this->getView(),$this->assign);
	}
	
	public function setAssign( $data )
	{
		
		$nav['nav'] = ArticleCategory::all()->toArray();
		$nav['toplink'] = Link::query()->where(['is_top'=>1])->get(['name','uri'])->toArray();
		$nav['rightlink'] = Link::query()->where(['is_top'=>0,'status'=>1])->get(['name','uri'])->toArray();
		
		
		$top['top'] = Article::query()->limit(5)->orderBy('created_at','DESC')->get(['id','title'])->toArray();
		
		$labels['labels'] = Label::query()->where('num','>',0)->get()->toArray();
		$assign = array_merge($nav,$data,$top,$labels);
		
		$this->assign = $assign;
	}
	
	/**
	 * @return string
	 */
	public function getView () : string
	{
		return $this->view;
	}
	
	/**
	 * @param string $view
	 */
	public function setView ( string $view ) : void
	{
		$this->view = $view;
	}
}