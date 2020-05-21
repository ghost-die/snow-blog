<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Lib\Tree;
use App\Models\Comment;
use App\Traits\HasAdminResourceActions;
use Illuminate\Http\Request;

class CommentController extends Controller
{
	
	use HasAdminResourceActions;
	
	public $model = Comment::class;
	
	public $home = 'article';
	
	public function index()
	{
		
		$this->data = [
			'data'=>$this->data(),
		];
		
		$this->setView('comment.index');
		
		return $this->view();
	}
	
	
	public function edit(Comment $comment)
	{
		$this->data = [
			'comment'=>$comment
		];
		
		$this->setView('comment.edit');
		
		return $this->view();
	}
	
	
	public function update(Comment $comment,Request $request)
	{
		
		$data = $request->only(['content','name','email','web_site']);
		
		try {
			$comment->content= $data['content'];
			$comment->name= $data['name'];
			$comment->email= $data['email'];
			$comment->web_site= $data['web_site'];
			$comment->save();
			
			return back()->with('success','编辑成功');
		}catch (\Exception $exception){
			
			return back()->with('error',$exception->getMessage());
		}
		
		
		
	}
	
	
	public function destroy(Comment $comment)
	{
		
		try {
			
			$res = $comment->query()->get(['id','parent_id','name'])->toArray();
			
			$ids = Tree::instance()->init($res)->getChildren($comment->id,true);
			$ids = collect($ids)->pluck('id');
			
			$comment->destroy($ids);
			return response()->json([
				'success'=>true,
				'message'=>'删除成功',
			]);
		}catch (\Exception $exception){
			return response()->json([
				'success'=>false,
				'message'=>'删除失败---'.$exception->getMessage(),
			]);
		}
		
	}
}