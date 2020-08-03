<?php


namespace App\Http\Controllers\Home;


use App\Http\Controllers\BaseController;
use App\Http\Lib\Tree;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Read;
use App\Traits\HasResourceActions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class ArticleController extends BaseController
{

	use HasResourceActions ;
	
	
	public function index(Article $article,Request $request,Read $read)
	{
		$comments = Tree::instance()->init($article->comment->toArray())->getTreeArray(0);
		
		$comment_data['name'] = session('name');
		$comment_data['email'] = session('email');
		$comment_data['web_site'] = session('web_site');
		
		
		$assign = [
			'title' =>$article->title,
			'description' =>Str::of(stripTags( $article->content ))->limit(250),
			'keywords'=>$article->label()->pluck('name')->implode(','),
			'data' => $article,
			'comments'=>$comments,
			'comment_data'=>$comment_data
		];
		
		$article->readAdd($request->getClientIp(),$article,$read);
		$this->setAssign($assign);
		$this->setView('article.index');
		return $this->response();
	}
	
	
	
	public function comment(Article $article,Comment $comment,Request $request)
	{
		
	
		
		$request_data = $request->all([
			'content',
			'name',
			'email',
			'web_site',
			'is_remember',
		]);
		
		if ($request_data['is_remember'])
		{
			session($request_data);
		}
		
		$comment_data = [
			'article_id' =>(int) $article->id,
			'parent_id' =>(int) $comment->id,
			'content'=>$request_data['content'],
			'name'=>$request_data['name'],
			'email'=>$request_data['email'],
			'avatar'=>make_gravatar($request_data['email']),
			'web_site'=>$request_data['web_site'] ?? '#',
		];
		
		
		$article->comments_num +=1;
		
		$article->save();
		$res = $comment->create($comment_data);
		
		if ($res)
		{
			return back()->with('success','提交成功');
		}else{
			
			return back()->with('error',$article->getError());
		}
		
	}
	
	
}