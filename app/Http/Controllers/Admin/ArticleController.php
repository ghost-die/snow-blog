<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Image;
use App\Models\Label;
use App\Traits\HasAdminResourceActions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
	use HasAdminResourceActions;
	
	public $model = Article::class;
	
	public $home = 'article';
	
	public function index()
	{
		
		$this->data = [
			'data'=>$this->data(),
			'categorys'=>ArticleCategory::where(['user_id'=>auth()->id()])->get(),
			'labels'=>Label::get(),
		];
		
		$this->setView('article.index');
		
		return $this->view();
	}
	
	
	public function edit(Article $article)
	{
		$this->data = [
			'article'=>$article,
			'categorys'=>ArticleCategory::where(['user_id'=>auth()->id()])->get(),
			'labels'=>Label::get(),
		];
		
		$this->setView('article.edit');
		
		return $this->view();
	}
	
	
	public function update(Article $article,Request $request,Label $label)
	{
		
		$this->validate = [
			'category_id' => 'required',
			'title' => 'required|min:2|max:30',
//			'content' => 'required|min:30',
			'label' => 'required|array',
		];
		
		$this->validateMessage = [
			'category_id.required' => '分类不能为空!',
			'title.required' => '标题不能为空!',
			'title.max' => '标题不超过:max个字符!',
			'title.min' => '标题不低于:min个字符!',
			'content.required' => '内容不能为空!',
//			'content.min' => '内容不低于:min个字符!',
			'label.required' => '标签不能为空!',
			'label.array' => '标签不合法!',
		];
		$this->validationMessages($request);
		
		$data = $request->all(['title','content','category_id','label']);
		
		if ($article->updateArticle($data,$article,$label))
		{
			return back()->with('success','编辑成功');
		}else{
			return back()->with('error',$article->getError());
		}
	}
	
	public function store(Request $request,Article $article,Label $label,ArticleCategory $articleCategory)
	{
		$this->validate = [
			'category_id' => 'required',
			'title' => 'required|min:2|max:30',
//			'content' => 'required|min:30',
			'label' => 'required|array',
		];
		
		$this->validateMessage = [
			'category_id.required' => '分类不能为空!',
			'title.required' => '标题不能为空!',
			'title.max' => '标题不超过:max个字符!',
			'title.min' => '标题不低于:min个字符!',
			'content.required' => '内容不能为空!',
//			'content.min' => '内容不低于:min个字符!',
			'label.required' => '标签不能为空!',
			'label.array' => '标签不合法!',
		];
		$this->validationMessages($request);
		
		
		
		$data = $request->all(['title','content','category_id','label']);
		
		
		$user = \auth()->user();
		
		if ($article->setArticle($data,$label,$articleCategory,$user))
		{
			return back()->with('success','创建成功');
		}else{
			
			return back()->with('error',$article->getError());
		}
		
		
		
	}
	
	
	public function upload(Request $request,Image $image)
	{
		
		$file = $request->file('file');
		
		$user = Auth::user();
		
		$hash = hash_file('sha256',$file);
		try {
			$res = $image->query()->where(['hash'=>$hash])->firstOrFail();
			
			$response['filename'] = route('imagecache',['template'=>'original','filename'=>$res->path]);
			return $response;
		}catch (\Exception $exception){
			
			$file_name =  randByMicrosecond().'.'.$file->getClientOriginalExtension();
			$path = $file->storeAs('file',$file_name,'public');
			
			$image->setOneData($user,$file,$path,$hash);
			
			$response['filename'] = route('imagecache',['template'=>'original','filename'=>$path]);
			return $response;
		}
		
	}
}