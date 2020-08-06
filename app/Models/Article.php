<?php

namespace App\Models;

use App\Models\traits\ModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Parsedown;

class Article extends Model
{
	
	use ModelTrait;
	
	protected $fillable = [
		'user_id',
		'category_id',
		'title',
		'content',
		'reads_num',
		'comments_num',
		'author',
		'original_content',
	];
	
	
	public function getLast()
	{
		return $this->query()->orderBy('created_at','DESC')->first();
	}
	
	public function getPaginateData()
	{
//		$page = request('page');
//
//		return Cache::remember('article'.$page, 60, function () {
//
//		});
//
		
		return $this->query()->orderBy('created_at','DESC')->simplePaginate(null,[
			'id',
			'category_id',
			'title',
			'content',
			'reads_num',
			'comments_num',
			'author',
			'created_at',
			'updated_at',
		]);
		
		
		
	}
	
	public function setArticle(array $data,Label $label,ArticleCategory $articleCategory,User $user)
	{
		
		
		
		DB::beginTransaction();
		
		try {
			
			$articles['title'] = $data['title'];
			$articles['original_content'] = $data['content'];
			$articles['content'] = (new Parsedown())->parse($data['content']);
			$articles['category_id'] = $data['category_id'];
			$articles['author'] = $user->name;
			$articles['user_id'] = $user->id;
			
			$thisModel = $this->set($articles);
			
			$thisModel->category()->increment('article_num',1);
			
			$this->belongsLabel($data['label'],$label,$thisModel);
			
			
			
			DB::commit();
			return true;
		}catch (\Exception $exception){
			DB::rollBack();
			
			$this->setError($exception->getMessage());
			return false;
		}
	}
	
	
	
	public function updateArticle(array $data ,Article $article,Label $label)
	{
		DB::beginTransaction();
		try {
			$article->category_id = $data['category_id'];
			$article->title = $data['title'];
			$article->original_content = $data['content'];
			$article->content = (new Parsedown())->parse($data['content']);
			
			
			$this->belongsLabel($data['label'],$label);
			
			$article->save();
			
			
			
			
			DB::commit();
			return true;
		}catch (\Exception $exception)
		{
			DB::rollBack();
			
			$this->setError($exception->getMessage());
			return false;
		}
	}

	
	public function belongsLabel($data,Label $label,$thisModel=null){
		
		
		if (null === $thisModel){
			$thisModel = $this;
		}
		$labelData = [];
		$time = Carbon::now();
		
		$thisModel->label()->decrement('num',1);
		
		collect($data)->each(function ($v) use (&$labelData,$label,$thisModel,$time){
			
			$label_data = $label->query()->firstOrCreate(['name'=>$v]);
			
			$labelData[] = [
				'article_id'=>$thisModel->id,
				'label_id'=>$label_data->id,
				'created_at'=>$time,
				'updated_at'=>$time,
			];
		});
		
		
		DB::table('article_to_label')->where(['article_id'=>$thisModel->id])->delete();
		DB::table('article_to_label')->insert($labelData);
		
		$thisModel->label()->increment('num',1);
	}
	
	public function getCreatedAtAttribute ( $created_at )
	{
		return Carbon::parse($created_at)->formatLocalized('%d %B %Y');
	}
	
	
	
	public function readAdd(string $ip,Article $article,Read $read)
	{
		if (! $read->checkout($ip,$article->id))
		{
			$data['ip']=$ip;
			$data['article_id']=$article->id;
			$read->set($data);
			
			$article->reads_num +=1;
			$article->save();
			
			return  true;
		}else{
			return false;
		}
	}
	
	
	
	
	
	
	public function label()
	{
		return $this->belongsToMany(Label::class, 'article_to_label','article_id','label_id');
	}
	
	public function category()
	{
		return $this->hasOne(ArticleCategory::class,'id','category_id');
	}
	
	
	public function comment()
	{
		return $this->hasMany(Comment::class);
	}
}
