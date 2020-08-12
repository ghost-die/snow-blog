<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Lib\Layout\Content;
use App\Http\Lib\Traits\ResponseServe;
use App\Http\Lib\Tree;
use App\Models\Comment;
use App\Traits\HasAdminResourceActions;
use Illuminate\Http\Request;

class CommentController extends BaseController
{
	
	use HasAdminResourceActions,ResponseServe;
	
	public $model = Comment::class;
	
	public $home = 'comment';
	
	
	protected  $title = 'Comment';
	
	public function grid()
	{
		$this->data = [
			'data'=>$this->data(),
		];
		
		
		
		$this->setView('comment.index');
		
		return view($this->view,$this->data);
	}
	
	
	public function edit(Comment $comment)
	{
		$this->data = [
			'comment'=>$comment
		];
		
		$this->setView('comment.edit');
		
		return view($this->view,$this->data);
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
			

			
			return notification('编辑成功','success',route('admin.comment.index'));
		}catch (\Exception $exception){
			
			return notification($exception->getMessage(),'error');

		}
		
		
		
	}
	
	
	public function destroy(Comment $comment)
	{
		
		try {
			
			$res = $comment->query()->get(['id','parent_id','name'])->toArray();
			
			$ids = Tree::instance()->init($res)->getChildren($comment->id,true);
			$ids = collect($ids)->pluck('id');
			
			$comment->destroy($ids);
			return $this->success([]);
		}catch (\Exception $exception){
			return $this->failed('删除失败');
		}
		
	}
}